<?php

namespace Nimbusoft\Parrot\Extension;

trait ConfigurableTrait
{
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    public function getConfig(): array
    {
        return $this->config;
    }
}
