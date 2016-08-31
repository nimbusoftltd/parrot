<?php

namespace Nimbusoft\Parrot;

use Symfony\Component\Yaml\Yaml;
use League\Event\Emitter;
use League\Event\EmitterInterface;
use Nimbusoft\Parrot\Console;
use Nimbusoft\Parrot\Event\RunEvent;
use Nimbusoft\Parrot\Plugin\FilesPlugin;
use Nimbusoft\Parrot\Plugin\MysqlPlugin;
use Nimbusoft\Parrot\Plugin\PgsqlPlugin;
use Nimbusoft\Parrot\Plugin\EncryptionPlugin;
use Nimbusoft\Parrot\Plugin\DestinationPlugin;
use Nimbusoft\Parrot\Extension\PluginInterface;
use Nimbusoft\Parrot\Extension\CommandInterface;
use Symfony\Component\Console\Command\Command;

class Parrot
{
    const VERSION = '1.0.0';
    const P_LATE = 1000;
    const P_NORMAL = 0;
    const P_EARlY = -1000;

    public function __construct(EmitterInterface $emitter)
    {
        $this->emitter = $emitter;

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

    public function setConsole(Console $console)
    {
        $this->console = $console;
    }

    public function registerPlugin(PluginInterface $plugin)
    {
        $plugin->setParrot($this);
        $plugin->register();
    }

    protected function registerDefaultPlugins()
    {
        $this->registerPlugin(new DestinationPlugin);
        $this->registerPlugin(new EncryptionPlugin);
        $this->registerPlugin(new FilesPlugin);
        $this->registerPlugin(new MysqlPlugin);
        $this->registerPlugin(new PgsqlPlugin);
    }

    public function run($file)
    {
        $config = Yaml::parse(file_get_contents($file));

        $this->emitter->emit(new RunEvent($this, $config));
    }

    public function addCommand(Command $command)
    {
        if ($command instanceof CommandInterface) $command->setParrot($this);

        return $this->console->add($command);
    }

    public function listen(string $event, callable $listener, int $priority)
    {
        return $this->emitter->addListener($event, $listener, $priority);
    }
}
