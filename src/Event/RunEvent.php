<?php

namespace Nimbusoft\Parrot\Event;

use Nimbusoft\Parrot\Parrot;
use League\Event\AbstractEvent;
use Symfony\Component\Console\Command\Command;

class RunEvent extends AbstractEvent
{
    public function __construct(Parrot $parrot, array $config, Command $command = null)
    {
        $this->parrot = $parrot;
        $this->config = $config;
        $this->command = $command;
    }

    public function getName()
    {
        return 'run';
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function output($line)
    {
        if ( ! $this->command) return;

        return $this->command->output->writeln($line);
    }
}
