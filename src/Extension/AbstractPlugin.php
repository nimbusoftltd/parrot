<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

abstract class AbstractPlugin implements PluginInterface
{
    public function setParrot(Parrot $parrot)
    {
        $this->parrot = $parrot;
    }
}
