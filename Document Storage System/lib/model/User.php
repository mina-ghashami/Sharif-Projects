<?php

/**
 * Subclass for representing a row from the 'user' table.
 *
 * 
 *
 * @package lib.model
 */ 
class User extends BaseUser
{
	public function getFullName(){
		return $this -> getFirstName().' '.$this -> getLastName();
	}
}
