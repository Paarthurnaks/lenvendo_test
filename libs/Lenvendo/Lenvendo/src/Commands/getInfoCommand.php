<?php

namespace Lenvendo\Lenvendo\Commands;

/**
 * Класс выполнения команды получения информации
 * TODO: Компоновщик в методе execute смотрелся бы куда лучше
 * Class getInfoCommand
 * @package Lenvendo\Lenvendo\Commands
 */
class getInfoCommand extends AbstractCommand
{
    /**
     * Название команды
     * @var string
     */
    public string $name = 'get_info';

    /**
     * Описание команды
     * @var string
     */
    public string $description = 'this command prints all arguments';

    public function execute(array $data = array()): string
    {
        $response = 'Called command: '
            . $this->name
            . "\n\n"
            . "Arguments:\n";

        foreach ($data['Arguments'] as $argument) {
            $response .= "\t- " . $argument . "\n";
        }

        $response .= "\nOptions:\n";

        foreach ($data['Options'] as $option) {
            $response .= "\t- " . $option['name'] . "\n";

            foreach ($option['value'] as $value) {
                $response .= "\t\t- " . $value . "\n";
            }
        }
        return $response;
    }
}