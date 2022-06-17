<?php

namespace Lenvendo\Lenvendo\Interfaces;

/**
 * Интерфейс команд для выполнения
 *
 * Interface CommandInterface
 * @package Lenvendo\Lenvendo\Interfaces
 */
interface CommandInterface
{
    /**
     * Команда для выполнения запроса
     * @param array $data
     * @return string
     */
    public function execute(array $data):string;
}