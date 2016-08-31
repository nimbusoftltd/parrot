<?php

namespace Nimbusoft\Parrot\Command;

use Nimbusoft\Parrot\Extension\AbstractCommand;

class RunCommand extends AbstractCommand
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Run Parrot using a parrot.yml file');
    }

    public function handle()
    {
        $this->parrot->run();
    }
}
