<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

interface ParrotAwareInterface
{
    public function getParrot(): Parrot;

    public function setParrot(Parrot $parrot);
}
