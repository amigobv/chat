<?php

class User extends Entity {
	private $firstName;
	private $lastName;
	private $username;
	private $hashPassword;
	
	public function __construct($id, $firstName, $lastName, $username, $hashPassword) {
		parent::__construct($id);
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->username = $username;
		$this->hashPassword = $hashPassword;
	}
	
	public function getUsername() {
		return $this->username;
	}
	
	public function setUsername($username) {
		$this->username = $username;
	}
		
	public function getPassword() {
		return $this->hashPassword;
	}
	
	public function setPassword($hashPassword) {
		$this->hashPassword = $hashPassword;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
}

?>