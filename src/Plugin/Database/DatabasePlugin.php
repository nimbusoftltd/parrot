<?php

namespace Nimbusoft\Parrot\Plugin\Database;

use Nimbusoft\Parrot\Parrot;
use Nimbusoft\Parrot\Extension\ConfigurableInterface;
use Nimbusoft\Parrot\Extension\AbstractPlugin;
use Spatie\DbDumper\Databases\MySql;
use Spatie\DbDumper\Databases\PostgreSql;
use Spatie\DbDumper\DbDumper;
use Symfony\Component\Config\Definition\Builder\ParentNodeDefinitionInterface;

class DatabasePlugin extends AbstractPlugin
{
    public function register()
    {
        $this->parrot->listen('run', [$this, 'run'], Parrot::P_NORMAL);
    }

    public function configure(ParentNodeDefinitionInterface $config)
    {
        $config
            ->children()
                ->arrayNode('database')
                    ->beforeNormalization()
                        ->ifTrue(function($v) {
                            return isset($v['username']);
                        })
                        ->then(function ($v) {
                            return [$v];
                        })
                    ->end()
                    ->prototype('array')
                        ->children()
                            ->enumNode('type')
                                ->defaultValue('mysql')
                                ->values(['mysql', 'pgsql'])
                            ->end()
                            ->scalarNode('host')
                                ->defaultValue('localhost')
                            ->end()
                            ->scalarNode('port')->end()
                            ->scalarNode('binary')->end()
                            ->scalarNode('exclude')->end()
                            ->scalarNode('include')->end()
                            ->scalarNode('timeout')->end()
                            ->scalarNode('socket')->end()
                            ->scalarNode('username')
                                ->isRequired()
                            ->end()
                            ->scalarNode('password')->end()
                            ->arrayNode('database')
                                ->beforeNormalization()
                                    ->ifString()
                                    ->then(function ($v) {
                                        return [$v];
                                    })
                                ->end()
                                ->prototype('scalar')->end()
                            ->end()
                            ->arrayNode('include')
                                ->prototype('array')->end()
                            ->end()
                            ->arrayNode('exclude')
                                ->prototype('array')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }

    public function run(ConfigurableInterface $event)
    {
        $config = $event->getConfig();

        if (empty($config['database'])) return;

        foreach ($config['database'] as $database) {
            switch ($database['type']) {
                case 'mysql':
                    $this->processMysql($database);
                break;

                case 'pgsql':
                    $this->processPgsql($database);
                break;
            }
        }
    }

    protected function processMysql(array $config)
    {
        $dir = $this->parrot->getTempPath().'/database/mysql';

        mkdir($dir, 0777, true);

        foreach ($config['database'] as $database) {
            $db = MySql::create()->setDbName($database);

            $this->setConfigValues($db, $config);

            $db->dumpToFile("{$dir}/{$database}.sql");
        }
    }

    protected function processPgsql(array $config)
    {
        $dir = $this->parrot->getTempPath().'/database/pgsql';

        mkdir($dir, 0777, true);

        foreach ($config['database'] as $database) {
            $db = PostgreSql::create()->setDbName($database);

            $this->setConfigValues($db, $config);

            $db->dumpToFile("{$dir}/{$database}.sql");
        }
    }

    protected function setConfigValues(DbDumper $db, array $config)
    {
        $db->setUserName($config['username']);
        $db->setPassword($config['password']);

        if ( ! empty($config['port'])) $db->setPort($config['port']);
        if ( ! empty($config['binary'])) $db->setDumpBinaryPath($config['binary']);
        if ( ! empty($config['exclude'])) $db->excludeTables($config['exclude']);
        if ( ! empty($config['include'])) $db->includeTables($config['include']);
        if ( ! empty($config['timeout'])) $db->setTimeout($config['timeout']);
        if ( ! empty($config['socker'])) $db->setSocket($config['socket']);
    }
}
