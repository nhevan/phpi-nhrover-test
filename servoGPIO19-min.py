#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

servo = Servo(19)

while True:
    servo.min()