<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;
use Symfony\Component\Config\Definition\Builder\ParentNodeDefinitionInterface;

abstract class AbstractPlugin implements PluginInterface
{
    use ParrotAwareTrait;

    public function configure(ParentNodeDefinitionInterface $config) {}
}
