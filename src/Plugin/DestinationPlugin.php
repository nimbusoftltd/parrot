<?php

namespace Nimbusoft\Parrot\Plugin;

use RuntimeException;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class DestinationPlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], -2500);
    }

    public function run(array $config)
    {
        if ( ! isset($config['destination'])) {
            throw new RuntimeException("'destination' section not found in parrot.yml file");
        }
    }
}
