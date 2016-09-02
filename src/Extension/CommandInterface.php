<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;

interface CommandInterface extends ParrotAwareInterface
{
    public function handle();
}
