<?php

namespace Nimbusoft\Parrot\Plugin;

use Nimbusoft\Parrot\Parrot;
use League\Event\EventInterface;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class MysqlPlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function run(EventInterface $event)
    {
        if ( ! isset($config['mysql'])) return;
    }
}
