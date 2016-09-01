<?php

namespace Nimbusoft\Parrot;

use Symfony\Component\Yaml\Yaml;
use League\Event\Emitter;
use League\Event\EmitterInterface;
use League\Flysystem\FileNotFoundException;
use Nimbusoft\Parrot\Console;
use Nimbusoft\Parrot\Event\RunEvent;
use Nimbusoft\Parrot\Plugin\File\FilePlugin;
use Nimbusoft\Parrot\Plugin\Database\DatabasePlugin;
use Nimbusoft\Parrot\Plugin\Encryption\EncryptionPlugin;
use Nimbusoft\Parrot\Plugin\Destination\DestinationPlugin;
use Nimbusoft\Parrot\Extension\PluginInterface;
use Nimbusoft\Parrot\Extension\ParrotAwareInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Parrot
{
    const VERSION = '1.0.0';
    const P_LATE = 1000;
    const P_NORMAL = 0;
    const P_EARlY = -1000;

    protected $tempPath;
    protected $plugins = [];

    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;

        $this->setTempPath(sys_get_temp_dir());

        $this->registerDefaultPlugins();
    }

    public static function console()
    {
        $parrot = new static(new Emitter);
        $console = new Console($parrot);

        $console->findPlugins();
        $console->setDefaultCommand('run');
        $console->run();
    }

    public function setTempPath(string $path)
    {
        $this->tempPath = rtrim($path, '/').'/'.uniqid('parrot');
    }

    public function getTempPath()
    {
        return $this->tempPath;
    }

    public function getConsole()
    {
        return $this->console;
    }

    public function setConsole(Console $console)
    {
        $this->console = $console;
    }

    public function registerPlugin(PluginInterface $plugin)
    {
        $plugin->setParrot($this);
        $plugin->register();

        $this->plugins[] = $plugin;
    }

    protected function registerDefaultPlugins()
    {
        $this->registerPlugin(new FilePlugin);
        $this->registerPlugin(new DatabasePlugin);
        $this->registerPlugin(new EncryptionPlugin);
        $this->registerPlugin(new DestinationPlugin);
    }

    public function run($file, Command $command = null)
    {
        if ( ! file_exists($file)) {
            throw new FileNotFoundException($file);
        }

        $rawConfig = [
            'root' => Yaml::parse(file_get_contents($file))
        ];

        $processor = new Processor;
        $treeBuilder = new TreeBuilder;
        $rootNode = $treeBuilder->root('root');

        foreach ($this->plugins as $plugin) {
            $plugin->configure($rootNode);
        }

        $configuration = $processor->process($treeBuilder->buildTree(), $rawConfig);

        mkdir($this->getTempPath());

        $this->emitter->emit(new RunEvent($this, $config, $command));
    }

    public function addCommand(Command $command)
    {
        if ($command instanceof ParrotAwareInterface) $command->setParrot($this);

        return $this->console->add($command);
    }

    public function listen(string $event, callable $listener, int $priority)
    {
        return $this->emitter->addListener($event, $listener, $priority);
    }
}
