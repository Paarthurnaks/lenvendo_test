<?php

namespace App\Classes\CustomCommands;

use Lenvendo\Lenvendo\Commands\AbstractCommand;

class myCustomCommand extends AbstractCommand
{
    /**
     * Название команды
     * @var string
     */
    public string $name = 'custom_command';

    /**
     * Описание команды
     * @var string
     */
    public string $description = 'my custom command';

    public function execute(array $data = array()): string
    {
        // ...
        return 'my custom command result';
    }
}