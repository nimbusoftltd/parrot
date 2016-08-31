<?php

namespace Nimbusoft\Parrot\Event;

use Nimbusoft\Parrot\Parrot;
use League\Event\AbstractEvent;

class RunEvent extends AbstractEvent
{
    public function __construct(Parrot $parrot, array $config)
    {
        $this->parrot = $parrot;
        $this->config = $config;
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
