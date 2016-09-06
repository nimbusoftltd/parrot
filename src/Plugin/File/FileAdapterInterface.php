<?php

namespace Nimbusoft\Parrot\Plugin\File;

use League\Flysystem\AdapterInterface;

interface FileAdapterInterface
{
    public function getName();

    public function setup(array $config): AdapterInterface;
}
