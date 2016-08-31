<?php

namespace Nimbusoft\Parrot\Plugin;

use RuntimeException;
use League\Event\EventInterface;

class DestinationPlugin extends FilesPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], -2500);
    }

    public function run(EventInterface $event)
    {
        $config = $event->getConfig();

        if ( ! isset($config['destination'])) {
            throw new RuntimeException("'destination' section not found in parrot.yml file");
        }

        $config['files'] = $config['destination'];

        $newEvent = clone $event;
        $newEvent->setConfig($config);

        return parent::run($newEvent);
    }
}
