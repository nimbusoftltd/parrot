<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

trait ParrotAwareTrait
{
    public function getParrot(): Parrot
    {
        return $this->parrot;
    }

    public function setParrot(Parrot $parrot)
    {
        $this->parrot = $parrot;
    }
}
