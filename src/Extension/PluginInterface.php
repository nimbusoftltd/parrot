<?php

namespace Nimbusoft\Parrot\Extension;

use Nimbusoft\Parrot\Parrot;
use Symfony\Component\Config\Definition\Builder\ParentNodeDefinitionInterface;

interface PluginInterface extends ParrotAwareInterface
{
    public function register();

    public function configure(ParentNodeDefinitionInterface $config);
}
