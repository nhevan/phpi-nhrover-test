#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

servo = Servo(19)

while True:
    servo.mid()
    sleep(3)
    servo.max()
    sleep(3)
    servo.min()
    sleep(3)
