<?php

namespace Lenvendo\Lenvendo\Interfaces;

/**
 * Интерфейс валидатора аргументов
 *
 * Interface ValidatorInterface
 * @package Lenvendo\Lenvendo\Interfaces
 */
interface ValidatorInterface
{
    /**
     * Валидация данных
     *
     * @param array $data
     * @return array
     */
    public function validate(array $data = array()) : array;

    /**
     * Назначить правила валидации
     *
     * @param array $rules
     */
    public function setRules(array $rules = array());
}