<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;
use Symfony\Component\Console\Command\Command;

trait CommandAwareTrait
{
    public function setCommand(Command $command)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function info($line)
    {
        if ( ! $command = $this->getCommand()) return;

        $command->output->writeln($line);
    }

    public function error($line)
    {
        $this->info("<error>{$line}</error>");
    }

    public function warning($line)
    {
        $this->info("<comment>{$line}</comment>");
    }

    public function success($line)
    {
        $this->info("<info>{$line}</info>");
    }
}
