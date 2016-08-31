<?php

namespace Nimbusoft\Parrot\Plugin;

use RuntimeException;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class EncryptionPlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], -2000);
    }

    public function run(array $config)
    {
        if ( ! isset($config['encryption'])) return;
    }
}
