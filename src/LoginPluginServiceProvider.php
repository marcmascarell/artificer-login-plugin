<?php namespace Mascame\Artificer;


class LoginPluginServiceProvider extends ArtificerExtensionServiceProvider {

    protected $package = 'mascame/login';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        Artificer::pluginManager()->add($this->package, LoginPlugin::class);
    }

}
