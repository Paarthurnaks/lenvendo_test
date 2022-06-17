<?php

namespace Lenvendo\Lenvendo\Commands;

/**
 * Команда help в консоли
 *
 * Class helpCommand
 * @package Lenvendo\Lenvendo\Commands
 */
class helpCommand extends AbstractCommand
{
    /**
     * Название команды
     * @var string
     */
    public string $name = 'help';

    /**
     * Описание команды
     * @var string
     */
    public string $description = 'this is help command description';

    public function execute(array $data = array()): string
    {
        return 'this is help command';
    }
}