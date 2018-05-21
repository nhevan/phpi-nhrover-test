#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

def setServoPos(servo, pos):
	if pos==0:
		servo.mid()
	if pos==1:
		servo.max()
	if pos==-1:
		servo.min()

if __name__ == '__main__':
	servo = Servo(int(sys.argv[1]))
	setServoPos(servo, int(sys.argv[2]))