<?php

namespace Nimbusoft\Parrot\Event;

use Nimbusoft\Parrot\Parrot;
use Nimbusoft\Parrot\Extension\ConfigurableInterface;
use Nimbusoft\Parrot\Extension\CommandAwareInterface;
use Nimbusoft\Parrot\Extension\CommandAwareTrait;
use Nimbusoft\Parrot\Extension\ConfigurableTrait;
use Nimbusoft\Parrot\Extension\ParrotAwareTrait;
use Nimbusoft\Parrot\Extension\ParrotAwareInterface;
use League\Event\AbstractEvent;
use Symfony\Component\Console\Command\Command;

class RunEvent extends AbstractEvent implements ConfigurableInterface, CommandAwareInterface
{
    use CommandAwareTrait;
    use ConfigurableTrait;
    use ParrotAwareTrait;

    public function __construct(Command $command = null)
    {
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
}
