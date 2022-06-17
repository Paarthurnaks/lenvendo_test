<?php

namespace Lenvendo\Lenvendo;

use Lenvendo\Lenvendo\Interfaces\CommandInterface;
use Lenvendo\Lenvendo\Interfaces\ValidatorInterface;
use Lenvendo\Lenvendo\Command;

/**
 * Основной класс библиотеки.
 * Отвечает за выполнение команды,
 * валидацию параметров, вывод в консоль.
 *
 * Class Commander
 * @package Lenvendo\Lenvendo
 */
class Commander
{
    /**
     * Список аргументов
     * @var array
     */
    protected array $args;

    /**
     * Команда исполнения
     * @var string
     */
    protected string $command;

    /**
     * Валидатор запроса
     * @var ValidatorInterface|Validator
     */
    protected ValidatorInterface $validator;

    /**
     * Класс для обработки аргументов
     * @var Argument
     */
    protected Argument $argument;

    /**
     * @var Command
     */
    protected Command $commandClass;

    /**
     * Результат обработки запроса
     * @var string
     */
    public string $result;

    function __construct()
    {
        $this->init($_SERVER['argv']);
        $this->validator = new Validator([
            'invalidArguments',
            'unknownCommand'
        ]);
        $this->argument = new Argument();
        $this->commandClass = Command::getInstance();
    }

    /**
     * Инициализация/переинициализация базовых данных класса
     * @param array $argv
     * @return $this
     */
    public function init($argv = array()): Commander
    {
        unset($argv[0]);
        $this->setCommand($argv[1] ?? 'help');
        unset($argv[1]);
        $this->setArguments($argv);
        $this->result = 'Empty result';
        return $this;
    }

    /**
     * Обработка запроса
     *
     * @return $this
     */
    public function execute(): Commander
    {
        $arguments = $this->getArguments();
        $validateData = $this->validator->validate([
            'command' => $this->getCommand(),
            'arguments' => $arguments
        ]);

        if (isset($validateData['success'])) {
            $argumentData = $this->argument->toData($arguments);
            $this->result = $this->commandClass->execute($this->getCommand(), $argumentData);
        } else {
            $this->result = $validateData['errorMessage'];
        }

        return $this;
    }

    /**
     * Вывод результата обработки данных
     * @param bool $noEcho
     * @return $this|string
     */
    public function output(bool $noEcho = false)
    {
        $result = $this->result;

        if ($noEcho)
            return $result;
        else  {
            echo $result;
            return $this;
        }
    }

    /**
     * Делегирования добавления кастомной команды
     * @param CommandInterface $command
     * @return $this
     */
    public function addCustomCommand(CommandInterface $command): Commander
    {
        $this->commandClass->addCustomCommand($command);
        return $this;
    }

    /**
     * Переназначить аргументы
     * @param array $arguments
     * @return $this
     */
    public function setArguments(array $arguments = array()): Commander
    {
        $this->args = $arguments;
        return $this;
    }

    /**
     * Получить список аргументов
     *
     * @return mixed
     */
    public function getArguments()
    {
        return $this->args;
    }

    /**
     * Получить текущую команду
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }

    /**
     * Переназначить команду
     *
     * @param string $command
     * @return $this
     */
    public function setCommand(string $command): Commander
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @param ValidatorInterface $validator
     */
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }
}