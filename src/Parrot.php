<?php

namespace Nimbusoft\Parrot;

use Nimbusoft\Parrot\Console\Application;

class Parrot
{
    const VERSION = '1.0.0';

    public static function console()
    {
        $console = new Application;

        $console->findPlugins();
        $console->run();
    }
}
