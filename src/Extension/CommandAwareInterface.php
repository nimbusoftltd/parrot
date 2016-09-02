<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;
use Symfony\Component\Console\Command\Command;

interface CommandAwareInterface extends OutputableInterface
{
    public function setCommand(Command $command);

    public function getCommand();
}
