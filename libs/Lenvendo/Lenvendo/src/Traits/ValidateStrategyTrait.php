<?php

namespace Lenvendo\Lenvendo\Traits;

/**
 * Трейт для определения существует ли стратегия
 *
 * Trait ValidateStrategyTrait
 * @package Lenvendo\Lenvendo\Traits
 */
trait ValidateStrategyTrait
{
    /**
     * @param $strategyName
     * @return false|mixed
     */
    protected function exist($strategyName)
    {
        $className = 'Lenvendo\\Lenvendo\\ValidateStrategies\\' . $strategyName . 'Strategy';

        if (class_exists($className)) {
            return new $className();
        } else return false;
    }
}
