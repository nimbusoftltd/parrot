<?php

namespace Nimbusoft\Parrot;

use Nimbusoft\Parrot\Parrot;
use Nimbusoft\Parrot\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Application as BaseApplication;

class Console extends BaseApplication
{
    public function __construct(Parrot $parrot)
    {
        $parrot->setConsole($this);

        $this->parrot = $parrot;

        parent::__construct('Parrot', Parrot::VERSION);

        $this->getDefinition()->addOptions($this->getDefaultOptions());
    }

    public function findPlugins()
    {
        // Use the passed plugin-dir argument to find plugin phar files
        // and load them.
    }

    protected function getDefaultOptions(): array
    {
        return [
            new InputOption('--config-file', '-c', InputOption::VALUE_OPTIONAL, 'The location of the Parrot config file.', './parrot.yml'),
            new InputOption('--plugin-dir', '-p', InputOption::VALUE_OPTIONAL, 'The directory containing Parrot plugins.', '/usr/lib/parrot/plugins')
        ];
    }

    protected function getDefaultCommands()
    {
        $this->parrot->addCommand(new Command\RunCommand);

        return parent::getDefaultCommands();
    }
}
