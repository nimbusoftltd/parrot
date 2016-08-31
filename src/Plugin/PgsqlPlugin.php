<?php

namespace Nimbusoft\Parrot\Plugin;

use RuntimeException;
use Nimbusoft\Parrot\Parrot;
use Nimbusoft\Parrot\Extension\AbstractPlugin;

class PgsqlPlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function run(array $config)
    {
        if ( ! isset($config['pgsql'])) return;
    }
}
