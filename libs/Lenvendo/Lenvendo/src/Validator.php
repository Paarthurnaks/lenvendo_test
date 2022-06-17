<?php

namespace Lenvendo\Lenvendo;

use Lenvendo\Lenvendo\Interfaces\ValidatorInterface;
use Lenvendo\Lenvendo\Traits\ValidateStrategyTrait;

/**
 * Валидатор аргументов
 *
 * Class Validator
 * @package Lenvendo\Lenvendo
 */
class Validator implements ValidatorInterface
{
    use ValidateStrategyTrait;
    /**
     * Список правил валидации
     * @var array
     */
    protected array $rules = [];

    function __construct(array $rules)
    {
        $this->setRules($rules);
    }

    public function validate(array $data = array()): array
    {
        $rules = $this->getRules();
        $response = [
            'success' => 1,
            'data' => $data
        ];

        foreach ($rules as $rule) {
            $validateStrategy = $this->exist($rule);

            if ($validateStrategy) {
                $validateResult = $validateStrategy->validate($data);
                if ($validateResult != 1) {
                    $response = [
                        'error' => 1,
                        'errorMessage' => $validateResult
                    ];
                }
            }
        }

        return $response;
    }

    /**
     * Переназначение правил валидации
     * @param array $rules
     */
    public function setRules(array $rules = array())
    {
        $this->rules = $rules;
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }
}