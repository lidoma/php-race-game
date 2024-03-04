<?php

use cli\Colors;
use Game\App;
use function cli\line;

require __DIR__.'/vendor/autoload.php';

try {
    $cars = App::prepareCars();

    $racers = App::warmUpRacers($cars);

    $race = App::startEngines($racers);

    $race->output();
} catch (Exception $e) {
    line(Colors::colorize("%1 %s %n"), $e->getMessage());
    exit();
}
