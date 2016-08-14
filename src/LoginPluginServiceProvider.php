<?php namespace Mascame\Artificer;

use Illuminate\Support\ServiceProvider;

class LoginPluginServiceProvider extends ServiceProvider {

    public $package = 'mascame/login';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'artificer-login');

        Artificer::assetManager()->add([
            'font-awesome-cdn',
            'bootstrap-css-cdn',
//            'packages/mascame/artificer-default-theme/css/app.css',
//            'packages/mascame/artificer-default-theme/css/style.css',
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        \App::bind(LoginPlugin::class);

        \Mascame\Artificer\Artificer::pluginManager()->add($this->package, LoginPlugin::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
