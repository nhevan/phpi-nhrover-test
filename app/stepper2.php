<?php

namespace App;

use App\StepperController;

class stepper2 extends StepperController
{
	/**
	 * sets up all the necessary pins required to control the motor
	 * @return [type] [description]
	 */
	protected function setupPins()
	{
		$this->motor_switch = $this->gpio->getOutputPin(18);
		$this->input_1 = $this->gpio->getOutputPin(17); // this is input 2 in motor driver
		$this->input_2 = $this->gpio->getOutputPin(24); // this is input 4 in motor driver
		$this->input_3 = $this->gpio->getOutputPin(4); // this is input 1 in motor driver
		$this->input_4 = $this->gpio->getOutputPin(23); // this is input 3 in motor driver
	}

	/**
	 * rotates the hand in desired direction
	 * @return [type] [description]
	 */
	public function rotate($target_primary_angle, $verbose = 0)
	{
        if($verbose > 0) echo "\r\n================Move Primary=================\r\n";
		$current_primary_hand_angle = $this->settings->getCurrentHandAngle('primary_hand');
        $angle_to_rotate_primary_hand = $current_primary_hand_angle - $target_primary_angle;
        $angle_to_rotate_primary_hand = $angle_to_rotate_primary_hand;
        $steps_to_move_primary_hand_original = $angle_to_rotate_primary_hand / ($this->settings->get('step_count') * $this->settings->get('min_angle'));
        $steps_to_move_primary_hand_original = abs($steps_to_move_primary_hand_original);
        $steps_to_move_primary_hand = round($steps_to_move_primary_hand_original);
        $steps_to_move_primary_hand = $steps_to_move_primary_hand * $this->zoom_value;

        if($verbose > 0) echo "Current Primary Hand angle = {$current_primary_hand_angle} \r\n";
        if($verbose > 0) echo "Angle to rotate Primary Hand = {$angle_to_rotate_primary_hand} \r\n";
        if($verbose > 0) echo "Original Steps to move Primary Hand = {$steps_to_move_primary_hand_original} \r\n";
        if($verbose > 0) echo "Steps to move Primary Hand = {$steps_to_move_primary_hand} \r\n";

        $this->setStepsToMove(abs($steps_to_move_primary_hand));
        if ($angle_to_rotate_primary_hand > 0) {
            $this->rotateClockwise();
            if($verbose > 0) echo "Rotation direction : Clockwise \r\n";

            return [$steps_to_move_primary_hand, 'Clockwise'];
        }else{
            $this->rotateAntiClockwise();
            if($verbose > 0) echo "Rotation direction : Anti Clockwise \r\n";

            return [$steps_to_move_primary_hand, 'Anti Clockwise'];
        }
        if($verbose > 0) echo "=============================================\r\n";
	}

	/**
	 * rotates the motor clock wise
	 * @return [type] [description]
	 */
	public function rotateClockwise()
	{
		parent::rotateClockwise();
		$this->settings->track('primary_hand', -1 * $this->getStepsToMove()); // clockwise step is considered as a negative step
	}

	/**
	 * rotates the motor anti clock wise
	 * @return [type] [description]
	 */
	public function rotateAntiClockwise()
	{
		parent::rotateAntiClockwise();
		$this->settings->track('primary_hand', $this->getStepsToMove()); // anti clockwise step is considered as a positive step
	}
}
