<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

interface CommandInterface
{
    public function setParrot(Parrot $parrot);

    public function handle();
}
