<?php
require_once("./robot.php");

$robo = new Robot([0,0], 'north');

$robo->command('LLLRRAA');

print_r($robo->position);
print_r($robo->direction.PHP_EOL);