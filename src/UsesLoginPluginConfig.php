<?php namespace Mascame\Artificer;


trait UsesLoginPluginConfig {

    private function getConfig($key = null) {
        return Artificer::pluginManager()->get(LoginPlugin::class)->getConfig($key);
    }

    protected function getGuard() {
        return $this->getConfig('login.guard');
    }

    protected function getBroker() {
        return $this->getConfig('login.broker');
    }

}