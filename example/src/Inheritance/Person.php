<?php

abstract class Person
{
	protected $name;
	protected $surname;

	public function __construct($name, $surname)
	{
		$this->name = $name;
		$this->surname = $surname;
	}

	abstract public function getFullName();

}