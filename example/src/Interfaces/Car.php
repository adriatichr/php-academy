<?php 

require_once 'Driveable.php';

class Car implements Driveable
{
	public function accelerate()
	{
		echo 'Ubrzavam!';
	}	
}
