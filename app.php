<?php

use \Lenvendo\Lenvendo\Commander;

require_once "vendor/autoload.php";
require_once "libs/Lenvendo/Lenvendo/autoload.inc.php";

$commander = new Commander();
$commander
    ->addCustomCommand(new \App\Classes\CustomCommands\myCustomCommand())
    ->execute()
    ->output();