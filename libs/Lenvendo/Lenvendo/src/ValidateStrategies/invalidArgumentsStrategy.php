<?php

namespace Lenvendo\Lenvendo\ValidateStrategies;

use Lenvendo\Lenvendo\Interfaces\ValidateStrategyInterface;

/**
 * Стратегия валидации данных. Проверка на правильную передачу аргументов
 * TODO: Возможно, следует доработать регулярку, так как она пропускает некоторые варианты
 *
 * Class invalidArgumentsStrategy
 * @package Lenvendo\Lenvendo\ValidateStrategies
 */
class invalidArgumentsStrategy implements ValidateStrategyInterface
{
    public function validate(array $data = [])
    {
        $regular = '/(\[|{)*(=)*(}|\])/';

        foreach ($data['arguments'] as $datum) {
            if (!preg_match($regular,$datum))
                return 'invalid argument';
        }

        return 1;
    }
}