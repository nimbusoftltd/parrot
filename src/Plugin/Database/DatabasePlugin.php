<?php

namespace Nimbusoft\Parrot\Plugin\Database;

use Nimbusoft\Parrot\Parrot;
use League\Event\EventInterface;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class DatabasePlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function run(EventInterface $event)
    {

    }
}
