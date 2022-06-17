<?php

namespace Lenvendo\Lenvendo;

use Lenvendo\Lenvendo\Commands\getInfoCommand;
use Lenvendo\Lenvendo\Commands\helpCommand;
use Lenvendo\Lenvendo\Interfaces\CommandInterface;

/**
 * Класс для обработки, регистрации команд
 * TODO: Синглтон лишь ради проверки существования методов. Можно в дальнейшем переделать
 * Class Command
 * @package Lenvendo\Lenvendo
 */
class Command
{
    /**
     * Экземпляр класса
     * @var Command|null
     */
    private static ?Command $instance = null;

    /**
     * Список команд
     * @var array
     */
    public array $commands = [];

    /**
     * Получить экземпляр класса
     * @return Command
     */
    public static function getInstance(): Command
    {
        if (static::$instance === null) {
            static::$instance = new static();
            static::$instance->commands =  [
                'help' => new helpCommand(),
                'get_info' => new getInfoCommand()
            ];
        }

        return static::$instance;
    }

    /**
     * Не разрешен конструктор класса
     */
    private function __construct() {}

    /**
     * Не разрешено клонирование
     */
    private function __clone() {}

    /**
     * выполнение определенной команды
     * @param string $commandName
     * @param array $data
     * @return string
     */
    public function execute(string $commandName = 'help', array $data = array()): string
    {
        if (isset($this->commands[$commandName])) {
            if (in_array('help',$data['Arguments']))
                return $this->commands[$commandName]->description;
            else
                return $this->commands[$commandName]->execute($data);
        }
        else
            return 'error';
    }

    /**
     * Возвращает список всех комманд
     * @return int[]|string[]
     */
    public function getCommandList()
    {
        return array_keys($this->commands);
    }

    /**
     * Добавляется кастомную команду.
     * Она должна реализовывать CommandInterface интерфейс
     * и желательно унаследованной от класса AbstractCommand
     *
     * @param CommandInterface $command
     * @return $this
     */
    public function addCustomCommand(CommandInterface $command): Command
    {
        $this->commands[$command->name] = $command;
        return $this;
    }
}