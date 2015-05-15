<?php
namespace App\Model\User;

use App\Model\User as User;

class Customer extends User {
	
	/**
	 * Regex for validating emails
	 */
	const VALID_EMAIL_REGEX = '^[A-Za-z0-9._%+-]+@(?:[A-Za-z0-9-]+\.)+[A-Za-z]{2,6}$';
	
	/**
	 * Regex for validating names. It allows only alpha characters, white spaces and single quotes
	 */
	const VALID_NAME_REGEX = '^[A-Za-z\'\s]*$';
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'user';
	
	/**
	 * The email of the user
	 * @var string
	 */
	protected $email;
	
	/**
	 * The first name of the user
	 * @var string
	 */
	protected $firstName;
	
	/**
	 * The last name of the user
	 * @var type 
	 */
	protected $lastName;
	
	/**
	 * The address of the user
	 * @var string
	 */
	protected $address;

	/**
	 * Returns the email
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Returns the first name of the user
	 * @return string
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Returns the last name of the user
	 * @return string
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Returns the address of the user
	 * @return address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets and validates the email
	 * @param type $email
	 * @return \User
	 */
	public function setEmail($email) {
		if ( !$this->validate('email', $email) ) {
			return false;
		}
		
		$this->email = $email;
		return true;
	}

	/**
	 * Sets and validates the first name
	 * @param type $firstName
	 * @return \User
	 */
	public function setFirstName($firstName) {
		if ( !$this->validate('name', $firstName) ) {
			return false;
		}
		$this->firstName = $firstName;
		return true;
	}

	/**
	 * Sets and validates the last name
	 * @param type $lastName
	 * @return \User
	 */
	public function setLastName($lastName) {
		if ( !$this->validate('name', $lastName) ) {
			return false;
		}
		$this->lastName = $lastName;
		return true;
	}

	/**
	 * Sets and validates the user address
	 * @param type $address
	 * @return \User
	 */
	public function setAddress($address) {
		$this->address = $address;
		return true;
	}
	
}