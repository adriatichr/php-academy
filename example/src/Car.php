<?php

class Car
{
	public $maxSpeed = 50;
	private $currentSpeed = 0;

	public function getCurrentSpeed()
	{
		return $this->currentSpeed;
	}

	public function accelerate()
	{
		$this->currentSpeed += 10;
	}

	public function decelerate()
	{
		if($this->currentSpeed >= 10) {
			$this->currentSpeed -= 10;
		} else {
			$this->currentSpeed = 0;
		}
	}

}
