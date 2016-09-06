<?php

namespace Nimbusoft\Parrot\Parrot;

use League\Flysystem\FilesystemInterface;

interface FileAdapterInterface
{
    public function getName();

    public function setup(array $config): FilesystemInterface;
}
