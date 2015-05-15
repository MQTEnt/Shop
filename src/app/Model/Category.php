<?php
namespace App\Model;

use Pragmatic\Model as Model;

class Category extends Model {


	/**
	 * Regular expression for validate Category Name
	 * var string
	 */
	const VALID_NAME_REGEX = '^[A-Za-z]*$';
	
	/**
	 * The name of the table, containing the user records
	 */
	protected static $tableName = 'category';

	/**
	 * An array of all properties, which need to be unique
	 * @var Array
	 */
	protected static $uniqueProperties = array('name');
	
	/**
	 * The Name of the Category
	 * @var string
	 */
	protected $name;

	/**
	 * The Dscription of the Category
	 * @var string
	 */
	protected $description;

	/**
	 * Return the Category Name
	 * var string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Return the Category Description.
	 * var string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * 
	 * Set the Category Name.
	 * var string
	 */
	public function setName($name) {
		if ( !$this->validate('name', $name) ) {
			return false;
		}
		
		$this->name = $name;
		return $this;
	}

	/**
	 * 
	 * Set the Category Description.
	 * var string
	 */
	public function setDescription ($descripsion) {
		if ( !$this->validate('descripsion', $descripsion) ) {
			return false;
		}
		$this->description = $descripsion;
		return $this;
	}
    
}    