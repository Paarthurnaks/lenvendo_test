<?php

namespace Lenvendo\Lenvendo\Interfaces;

/**
 * Интерфейс для стратегии валидации данных
 *
 * Interface ValidateStrategyInterface
 * @package Lenvendo\Lenvendo\Interfaces
 */
interface ValidateStrategyInterface
{
    /**
     * Метод валидации. Возвращает либо 1 либо строку ошибки
     * @param array $data
     * @return mixed
     */
    public function validate(array $data);
}
