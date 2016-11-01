<?php

namespace Mascame\Artificer;

class LoginPluginServiceProvider extends ArtificerExtensionServiceProvider
{
    protected $package = 'mascame/artificer-login-plugin';

    public function register()
    {
        $this->addPlugin(LoginPlugin::class);
    }
}
