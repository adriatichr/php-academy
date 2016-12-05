<?php

require_once 'Person.php';

class Employee extends Person
{
	public function getFullName()
	{
		return $this->surname . ', ' . $this->name;
	}
}
