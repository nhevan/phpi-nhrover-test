<?php

use Calcinai\PHPi\External\Generic\Button;
use Calcinai\PHPi\External\Generic\Motor\Stepper;

include __DIR__.'/../vendor/autoload.php';

$loop = \React\EventLoop\Factory::create();
$board = \Calcinai\PHPi\Factory::create($loop);

//This is for a 4 phase motor - can be any number of phases
$motor = new Stepper([$board->getPin(4), $board->getPin(17), $board->getPin(23), $board->getPin(24)]);
$motor->setSpeed(10);

//Can also hook up events like this:
//$button = new Button($board->getPin(17));
//$button->on('press', [$motor, 'step']);


//Forward for 2 sec, rev for 2 sec
$loop->addPeriodicTimer(2, function() use($motor){
    //Long winded way to toggle direction
    $motor->getDirection() === Stepper::DIRECTION_FORWARD ? $motor->reverse() : $motor->forward();
});

$motor->forward();


$loop->run();