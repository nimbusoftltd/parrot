<?php

namespace Nimbusoft\Parrot\Console\Command;

class RunCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Run Parrot using a parrot.yml file');
    }
}
