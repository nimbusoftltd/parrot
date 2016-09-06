<?php

namespace Nimbusoft\Parrot\Plugin\File;

use League\Flysystem\FilesystemInterface;

interface FileAdapterInterface
{
    public function getName();

    public function setup(array $config): FilesystemInterface;
}
