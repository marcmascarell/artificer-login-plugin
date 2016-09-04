<?php namespace Mascame\Artificer;


class LoginPluginServiceProvider extends ArtificerExtensionServiceProvider {

    protected $package = 'mascame/login';

    public function register()
    {
        $this->addPlugin(LoginPlugin::class);
    }

}
