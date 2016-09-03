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
        $this->addPlugin(LoginPlugin::class);
    }

//    public function register()
//    {
//
//    }

}
