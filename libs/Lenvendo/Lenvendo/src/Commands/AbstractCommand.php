<?php

namespace Lenvendo\Lenvendo\Commands;

use Lenvendo\Lenvendo\Interfaces\CommandInterface;

/**
 * Абстрактный класс регистрации команды.
 * Реализует интерфейс CommandInterface.
 *
 * Class AbstractCommand
 * @package Lenvendo\Lenvendo\Commands
 */
abstract class AbstractCommand implements CommandInterface
{
    /**
     * Название команды
     * @var string
     */
    public string $name = 'undefined command name';

    /**
     * Описание команды
     * @var string
     */
    public string $description = '';

    /**
     * Метод выполнение команды
     *
     * @param array $data
     * @return string
     */
    public function execute(array $data = array()):string
    {
        return 'Command worked successfully.';
    }
}