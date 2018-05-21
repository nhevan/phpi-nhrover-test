#!/usr/bin/env python3

from gpiozero import Servo
from time import sleep

def setServoPos(servo, pos):
	sleep_time = 0.5
	if pos==0:
		print("Turning to mid position \n")
		while True: 
		    servo.mid()
		    sleep(sleep_time)
		    break
	if pos==1:
		print("Turning to max position \n")
		while True: 
		    servo.max()
		    sleep(sleep_time)
		    break
	if pos==-1:
		print("Turning to min position \n")
		while True: 
		    servo.min()
		    sleep(sleep_time)
		    break

if __name__ == '__main__':
	import sys
	servo = Servo(int(sys.argv[1]))
	setServoPos(servo, int(sys.argv[2]))
