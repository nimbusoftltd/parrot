<?php

namespace Nimbusoft\Parrot\Plugin\File;

use Nimbusoft\Parrot\Parrot;
use League\Event\EventInterface;
use Nimbusoft\Parrot\Plugin\File\Adapter\S3Adapter;
use Nimbusoft\Parrot\Plugin\File\Adapter\LocalAdapter;
use Nimbusoft\Parrot\Plugin\File\Adapter\OpenStackAdapter;
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
        $this->parrot->listen('pre-config', [$this, 'preConfig'], Parrot::P_NORMAL);
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function configure(ParentNodeDefinitionInterface $config)
    {
        $adapters = array_keys($this->adapters);

        $config
            ->children()
                ->arrayNode('files')
                    ->beforeNormalization()
                        ->ifTrue(function($v) {
                            return isset($v['adapter']);
                        })
                        ->then(function ($v) {
                            return [$v];
                        })
                    ->end()
                    ->prototype('array')
                        ->children()
                            ->enumNode('adapter')
                                ->isRequired()
                                ->values($adapters)
                            ->end()
                            ->arrayNode('config')
                                ->isRequired()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
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

    public function preConfig(EventInterface $event)
    {
        foreach ($this->parrot->getPlugins() as $plugin) {
            if ($plugin instanceof FilePluginInterface) {
                $this->registerAdapters($plugin->adapters());
            }
        }
    }

    public function run(EventInterface $event)
    {

    }
}
