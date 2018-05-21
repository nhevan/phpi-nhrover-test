#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

def setServoPos(servo, pos):
	if pos==0:
		print("Turning to mid position \n")
		servo.mid()
	if pos==1:
		print("Turning to max position \n")
		servo.max()
	if pos==-1:
		print("Turning to min position \n")
		servo.min()

if __name__ == '__main__':
	import sys
	servo = Servo(int(sys.argv[1]))
	setServoPos(servo, int(sys.argv[2]))