<?php

namespace Nimbusoft\Parrot\Plugin\Destination;

use RuntimeException;
use League\Event\EventInterface;
use Nimbusoft\Parrot\Plugin\File\FilePlugin;
use Nimbusoft\Parrot\Extension\AbstractPlugin;
use Symfony\Component\Config\Definition\Builder\ParentNodeDefinitionInterface;

class DestinationPlugin extends AbstractPlugin
{
    public function getName(): string
    {
        return 'destination';
    }

    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], -2500);
    }

    public function configure(ParentNodeDefinitionInterface $config)
    {
        $config
            ->children()
                ->enumNode('compression')
                    ->defaultValue('gzip')
                    ->values(['gzip'])
                ->end()
                ->scalarNode('filename')
                    ->isRequired()
                ->end()
            ->end();
    }

    public function run(EventInterface $event)
    {
        $config = $event->getConfig();

        foreach ($this->parrot->getPlugin('file')->getAdapters() as $adapter) {

        }

        if ( ! isset($config['destination'])) {
            throw new RuntimeException("'destination' section not found in parrot.yml file");
        }

        $config['files'] = $config['destination'];

        $newEvent = clone $event;
        $newEvent->setConfig($config);

        return parent::run($newEvent);
    }
}
