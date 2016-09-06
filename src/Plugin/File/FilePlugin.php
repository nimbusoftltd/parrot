<?php

namespace Nimbusoft\Parrot\Plugin\File;

use Nimbusoft\Parrot\Parrot;
use League\Event\EventInterface;
use Nimbusoft\Parrot\Extension\AbstractPlugin;
use Symfony\Component\Config\Definition\Builder\ParentNodeDefinitionInterface;

class FilePlugin extends AbstractPlugin implements FilePluginInterface
{
    protected $adapters = [];

    public function getName(): string
    {
        return 'file';
    }

    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function configure(ParentNodeDefinitionInterface $config)
    {

    }

    public function adapters(): array
    {
        return [
            new LocalAdapter,
            new S3Adapter,
            new OpenStackAdapter
        ];
    }

    public function registerAdapters(array $adapters)
    {
        foreach ($adapters as $adapter) $this->registerAdapter($adapter);
    }

    public function registerAdapter(FileAdapterInterface $adapter)
    {
        $this->adapters[$adapter->getName()] = $adapter;
    }

    public function getAdapters(): array
    {
        return $this->adapters;
    }

    public function getAdapter($adapter): FileAdapterInterface
    {
        return $this->adapters[$adapter];
    }

    public function run(EventInterface $event)
    {
        $config = $event->getConfig();

        foreach ($this->parrot->getPlugins() as $plugin) {
            if ($plugin instanceof FilePluginInterface) {
                $this->registerAdapters($plugin->adapters());
            }
        }

        if ( ! isset($config['files'])) return;
        if (isset($config['files']['adapter'])) $config['files'] = [$config['files']];
    }
}
