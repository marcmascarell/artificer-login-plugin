<?php

namespace Mascame\Artificer;

use Auth;
use Closure;
use Mascame\Artificer\Plugin\AbstractPlugin;
use Mascame\Artificer\Extension\ResourceCollector;
use Mascame\Artificer\Assets\AssetsManagerInterface;
use Mascame\Artificer\Controllers\LoginController as LoginController;
use Mascame\Artificer\Controllers\RegisterController as RegisterController;
use Mascame\Artificer\Controllers\ResetPasswordController as ResetPasswordController;
use Mascame\Artificer\Controllers\ForgotPasswordController as ForgotPasswordController;

class LoginPlugin extends AbstractPlugin
{
    /**
     * @var string
     */
    public $name = 'Login plugin';

    /**
     * @var string
     */
    public $thumbnail = ''; // url

    /**
     * @var string
     */
    public $slug = 'artificer-login';

    public function getRoutes()
    {
        \Route::group(['prefix' => 'user'], function () {
            // Authentication Routes...
            \Route::get('login', LoginController::class.'@showLoginForm')->name('admin.login.show');
            \Route::post('login', LoginController::class.'@login')->name('admin.login');
            \Route::get('logout', LoginController::class.'@logout')->name('admin.logout');

            // Registration Routes...
            \Route::get('register', RegisterController::class.'@showRegistrationForm')->name('admin.register.show');
            \Route::post('register', RegisterController::class.'@register')->name('admin.register');

            // Password Reset Routes...
            \Route::get('password/reset', ForgotPasswordController::class.'@showLinkRequestForm')->name('admin.password.reset.show');
            \Route::post('password/email', ForgotPasswordController::class.'@sendResetLinkEmail')->name('admin.password.reset.email');
            \Route::get('password/reset/{token}', ResetPasswordController::class.'@showResetForm')->name('admin.password.reset.recover');
            \Route::post('password/reset', ResetPasswordController::class.'@reset')->name('admin.password.reset');
        });
    }

    /**
     * This extension config is not available until boot.
     *
     * @param ResourceCollector $collector
     * @return ResourceCollector
     */
    public function resources(ResourceCollector $collector)
    {
        $collector->loadMigrationsFrom(__DIR__.'/../database/migrations/');

        $collector->loadViewsFrom(__DIR__.'/../resources/views', $this->slug);

        $collector->publishes([__DIR__.'/../config/' => $this->getConfigPath()]);

        $collector->mergeRecursiveConfigFrom(__DIR__.'/../config/', $this->getConfigKey());

        return $collector;
    }

    /**
     * @param AssetsManagerInterface $manager
     */
    public function assets(AssetsManagerInterface $manager)
    {
        $manager->add([
            'font-awesome-cdn',
            'bootstrap-css-cdn',
        ]);
    }

    /**
     * This will be called if the plugin is installed.
     */
    public function boot()
    {
        // Special case, we want it to be merged with Laravel's auth
        Config::mergeConfig('auth', $this->getConfig('auth'));

        \App::make('router')->pushMiddlewareToGroup('artificer-auth', self::class);
    }

    /**
     * We don't have the config available as usual for this extension,
     * as it is an special case.
     *
     * This will be called when plugin is installed
     */
    public function install()
    {
        $config = $this->getConfig('auth');

        // Seed
        $model = $config['providers']['admin']['model'];
        $result = $model::find(1);

        if (! $result) {
            $model::create([
                'name' => 'Demo User',
                'email' => 'artificer@artificer.at', // fake email
                'username' => 'artificer',
                'password' => \Hash::make('artificer'),
            ]);
        }
    }

    /**
     * Middleware 'artificer-auth'. Handles an incoming request.
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
                return response('Unauthorized.', 401, [
                    'X-Missing-Auth' => true,
                ]);
            }

            return redirect()->guest(\URL::route('admin.login.show'));
        }

        return $next($request);
    }
}
