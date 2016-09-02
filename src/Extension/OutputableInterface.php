<?php

namespace Nimbusoft\Parrot\Extension;

interface OutputableInterface
{
    public function info($output);

    public function error($output);

    public function warning($output);

    public function success($output);
}
