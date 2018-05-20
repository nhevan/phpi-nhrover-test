<?php

use Calcinai\PHPi\Pin\PinFunction;

require "vendor/autoload.php";

$board = Calcinai\PHPi\Factory::create();


$pin = $board->getPin(4) //BCM pin number
->setFunction(PinFunction::OUTPUT);

$pin->high();
