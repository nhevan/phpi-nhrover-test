#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

servo = Servo(19)

while True: 
    print(servo.value)
    servo.mid()
    sleep(1)
    break
