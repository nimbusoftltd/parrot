<?php

namespace Nimbusoft\Parrot\Extension;

interface ConfigurableInterface
{
    public function setConfig(array $config);

    public function getConfig(): array;
}
