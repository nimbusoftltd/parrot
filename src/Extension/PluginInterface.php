<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

interface PluginInterface
{
    public function register();

    public function setParrot(Parrot $parrot);
}
