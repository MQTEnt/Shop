<?php
namespace App\Model\Order;

class OrderCustomer {
	
	protected $username;
	protected $email;
	protected $address;
	protected $firstName;
	protected $lastName;
	protected $id;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}
	
	public function getUsername() {
		return $this->username;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getAddress() {
		return $this->address;
	}

	public function getFirstName() {
		return $this->firstName;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setUsername($username) {
		$this->username = $username;
		return $this;
	}

	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}


	
}

