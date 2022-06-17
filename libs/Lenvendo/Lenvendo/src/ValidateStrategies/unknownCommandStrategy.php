<?php

namespace Lenvendo\Lenvendo\ValidateStrategies;

use Lenvendo\Lenvendo\Command;
use Lenvendo\Lenvendo\Interfaces\ValidateStrategyInterface;

/**
 * Стратегия валидации данных. Проверка на существование команды
 *
 * Class unknownCommandStrategy
 * @package Lenvendo\Lenvendo\ValidateStrategies
 */
class unknownCommandStrategy implements ValidateStrategyInterface
{
    public function validate(array $data = [])
    {
        $commandList = Command::getInstance()->getCommandList();

        if (in_array($data['command'], $commandList))
            return 1;
        else
            return 'undefined command';
    }
}