<?php

namespace Nimbusoft\Parrot\Console;

use Nimbusoft\Parrot\Parrot;
use Nimbusoft\Parrot\Console\Command;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    public function __construct()
    {
        parent::__construct('Parrot', Parrot::VERSION);
    }

    public function findPlugins()
    {

    }

    protected function getDefaultCommands()
    {
        return array_merge(parent::getDefaultCommands(), [
            new Command\RunCommand
        ]);
    }
}
