<?php namespace Mascame\Artificer;


use Illuminate\Database\Schema\Blueprint;
use Mascame\Artificer\Plugin\AbstractPlugin;

use Closure;
use Auth;

class LoginPlugin extends AbstractPlugin {

    public $version = '1.0';
    public $name = 'Login plugin';
    public $thumbnail = ''; // url

    /**
     * Artificer does not know about your constructor so you
     * can inject any dependency you need
     */
    public function __construct() {

    }

    public function getRoutes() {

    }

    public function getMenu() {

    }

    /**
     * This will be called if the plugin is installed
     */
    public function boot()
    {
        \App::make('router')->middlewareGroup('artificer-auth', [LoginPlugin::class]);

        $guards = config('auth.guards');
        config([
            'auth.guards' => array_merge($guards, [
                'admin' => [
                    'driver' => 'session',
                    'provider' => 'admin',
                ],
            ])
        ]);

        $providers = config('auth.providers');
        config([
            'auth.providers' => array_merge($providers, [
                'admin' => [
                    'driver' => 'eloquent',
                    'model' => ArtificerUser::class,
                ],
            ])
        ]);

        $providers = config('auth.providers');
        config([
            'auth.providers' => array_merge($providers, [
                'admin' => [
                    'driver' => 'eloquent',
                    'model' => ArtificerUser::class,
                ],
            ])
        ]);

        $passwords = config('auth.passwords');
        config([
            'auth.passwords' => array_merge($passwords, [
                'admins' => [
                    'provider' => 'admin',
                    'email' => 'admin.auth.emails.password',
                    'table' => 'password_resets', // Todo? specific table
                    'expire' => 60,
                ],
            ])
        ]);
    }

    /**
     * This will be called when plugin is installed
     */
    public function install() {
        if (\Schema::hasTable('artificer_users')) return;

        \Schema::create('artificer_users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('role');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        ArtificerUser::create([
            'name' => 'Demo User',
            'email' => 'artificer@artificer.at', // fake email
            'username' => 'artificer',
            'password' => \Hash::make('artificer'),
            'role' => 'admin',
        ]);
    }

    /**
     * This will be called when plugin is uninstalled
     */
    public function uninstall() {
        \Schema::dropIfExists('artificer_users');
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest(\URL::route('admin.showlogin'));
            }
        }

        return $next($request);
    }

}