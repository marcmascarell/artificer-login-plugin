<?php namespace Mascame\Artificer;


use Mascame\Artificer\Assets\AssetsManagerInterface;
use Mascame\Artificer\Extension\ResourceCollector;
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

    public function resources(ResourceCollector $collector) {
        $collector->loadMigrationsFrom(__DIR__.'/../database/migrations/');

//        $collector->publishes([
//            __DIR__.'/../resources/views' =>  public_path('packages/mascame/test')
//        ]);
//
//        $collector->publishes([
//            __DIR__.'/../resources/views1' =>  public_path('packages/mascame/test2')
//        ]);

        return $collector;
    }

    public function assets(AssetsManagerInterface $manager)
    {
        $manager->add([
            'font-awesome-cdn',
            'bootstrap-css-cdn'
        ]);
    }

    /**
     * This will be called if the plugin is installed
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'artificer-login');

        \App::make('router')->middlewareGroup('artificer-auth', [LoginPlugin::class]);

        Artificer::assetManager()->add([
            'font-awesome-cdn',
            'bootstrap-css-cdn',
//            'packages/mascame/artificer-default-theme/css/app.css',
//            'packages/mascame/artificer-default-theme/css/style.css',
        ]);

        $this->addAuthConfig();
    }

    /**
     * This will be called when plugin is installed
     */
    public function install() {
        // Seed
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
        // todo: look into migrations table and find tables given the migration path
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
            }

            return redirect()->guest(\URL::route('admin.login.show'));
        }

        return $next($request);
    }

    protected function addAuthConfig() {
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

        $passwords = config('auth.passwords');
        config([
            'auth.passwords' => array_merge($passwords, [
                'admin' => [
                    'provider' => 'admin',
                    'email' => 'artificer-login::emails.password',
                    'table' => 'artificer_password_resets',
                    'expire' => 60,
                ],
            ])
        ]);
    }
}