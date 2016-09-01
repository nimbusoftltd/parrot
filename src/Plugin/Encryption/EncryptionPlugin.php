<?php

namespace Nimbusoft\Parrot\Plugin\Encryption;

use League\Event\EventInterface;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class EncryptionPlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], -2000);
    }

    public function run(EventInterface $event)
    {
        if ( ! isset($config['encryption'])) return;
    }
}
