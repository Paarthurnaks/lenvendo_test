<?php

namespace Lenvendo\Lenvendo;

/**
 * Класс для обработки аргументов
 * Class Argument
 * @package Lenvendo\Lenvendo
 */
class Argument
{
    /**
     * Ограничения аргументов
     * @var string[]
     */
    protected array $argumentConfines = [
        '{','}'
    ];

    /**
     * Ограничения параметров
     * @var string[]
     */
    protected array $parametersConfines = [
        '[',']'
    ];

    /**
     * Разделитель аргументов
     * @var string 
     */
    protected string $separator = ',';

    /**
     * Преобразовывает все входные аргументы. Разделяет на операторов и аргументы
     * @param array $arguments
     * @return array
     */
    public function toData(array $arguments = array()): array
    {
        $response = [
            'Arguments' => [],
            'Options' => []
        ];

        foreach ($arguments as $argument) {
            $firstSign = substr($argument, 0, 1);

            if ($firstSign == $this->argumentConfines[0]) {
                $response['Arguments'] = array_merge($response['Arguments'], $this->getArguments($argument));
            } elseif ($firstSign == $this->parametersConfines[0]) {
                $response['Options'][] = $this->getOptions($argument);
            }
        }

        return $response;
    }

    /**
     * @param string $argument
     * @param bool $withoutConfines
     * @return array
     */
    protected function getArguments(string $argument = '', bool $withoutConfines = false): array
    {
        $response = [];

        if (!$withoutConfines) {
            $newArgumentWithoutFirst = trim($argument, $this->argumentConfines[0]);
            $argument = trim($newArgumentWithoutFirst, $this->argumentConfines[1]);
        }

        $splitArguments = explode($this->separator,$argument);

        foreach ($splitArguments as $splitArgument) {
            $response[] = $splitArgument;
        }
        return $response;
    }

    /**
     * @param string $option
     * @return array
     */
    protected function getOptions(string $option = ''): array
    {
        $newParameterWithoutFirst = trim($option, $this->parametersConfines[0]);
        $newParameter = trim($newParameterWithoutFirst, $this->parametersConfines[1]);

        $newParameterAfterSplit = explode('=',$newParameter);

        return [
            'name' => $newParameterAfterSplit[0],
            'value' => $this->getArguments($newParameterAfterSplit[1])
        ];
    }
}