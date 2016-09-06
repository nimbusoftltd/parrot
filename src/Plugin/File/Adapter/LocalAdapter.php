<?php

namespace Nimbusoft\Parrot\Plugin\File\Adapter;

use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;
use Nimbusoft\Parrot\Plugin\File\FileAdapterInterface;

class LocalAdapter implements FileAdapterInterface
{
    public function getName()
    {
        return 'local';
    }

    public function configure()
    {

    }

    public function setup(array $config): AdapterInterface
    {
        switch ($config['links']) {
            case 'skip':
                $links = Local::SKIP_LINKS;
            break;

            default:
            case 'disallow':
                $links = Local::DISALLOW_LINKS;
            break;
        }

        foreach ($config['writeFlags'] as $flag) {
            if (isset($writeFlags)) {
                $writeFlags = $writeFlags | constant($flag);
            } else {
                $writeFlags = constant($flag);
            }
        }

        return new Local($config['path'], $writeFlags, $links, $config['permissions']);
    }
}
