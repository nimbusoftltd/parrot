<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

interface PluginInterface extends ParrotAwareInterface
{
    public function register();
}
