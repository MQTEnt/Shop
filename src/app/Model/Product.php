<?php
namespace App\Model;

use Pragmatic\Model as Model;
use Pragmatic\DBAL\TableJoin as TableJoin;
use Pragmatic\Model\ModelHelper as ModelHelper;

class Product extends Model {

	/**
	 * Regular expression for validate product Name
	 * var string
	 */
	const VALID_NAME_REGEX = '^[A-Za-z]*$';

	/**
	 * Regular expression for validate product's Price 
	 * var float or int
	 */
	const VALID_PRICE_REGEX = '^[0-9]+(\.[0-9]+)?$';

	/**
	 * Regular expression for validate CategoryName 
	 * var string
	 */
	const VALID_CATEGORYNAME_REGEX = '^[a-zA-Z]*$';

	/**
	 * An array of all properties, which need to be unique
	 * @var Array
	 */
	protected static $uniqueProperties = array('name');
	
	/**
	 * The table which content the product
	 * var string
	 */
	protected static $tableName = 'product';

	/**
	 * The Name of Product.
	 * @var string
	 */
	protected $name;

	/**
	 * The ShortDescription of Product 
	 * @var string
	 */
	protected $shortDecription;

	/**
	 * The LongDescription of the Product
	 * @var string
	 */
	protected $longDescription;

	/**
	 * THe Price of the Product.
	 * @var float
	 */
	protected $price;

	/**
	 * The CategoryID of the Product.
	 * @var int
	 */
	protected $categoryId;
	
	/**
	 *
	 * The category name of the product
	 * 
	 * @var string
	 */
	protected $categoryName;

	/**
	 * Return the product name
	 * var string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Return the product shortDescription
	 * var string
	 */
	public function getShortDecription() {
		return $this->shortDecription;
	}

	/**
	 * Return the product longDescription
	 * var sting
	 */
	public function getLongDescription() {
		return $this->longDescription;
	}

	/**
	 * Return the product price
	 * var float
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Return the categoryID
	 * var int
	 */
	public function getCategoryId() {
		return $this->categoryId;
	}
	
	/**
	 * Returns the name of the current category
	 * @return String
	 */
	public function getCategoryName() {
		return $this->categoryName;
	}

	/**
	 * Set the product Name
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
	 * Set the product ShortDescription
	 * var string
	 */
	public function setShortDecription($shortDecription) {
		if ( !$this->validate('shortDecription', $shortDecription) ) {
			return false;
		}
		$this->shortDecription = $shortDecription;
		return $this;
	}

	/**
	 * Set the product LongDescription
	 * var string
	 */
	public function setLongDescription($longDescription) {
		if ( !$this->validate('longDescription', $longDescription) ) {
			return false;
		}
		$this->longDescription = $longDescription;
		return $this;
	}

	/**
	 * Set the product Price
	 * var float
	 */
	public function setPrice($price) {
		if ( !$this->validate('price', $price) ) {
			return false;
		}
		$this->price = $price;
		return $this;
	}

	/**
	 * Set the product CategoryId
	 * var int
	 */
	public function setCategoryId($categoryId) {
		
		$this->categoryId = $categoryId;
		return $this;
	}
	
	/**
	 * 
	 * Internal method to fetch all joins
	 * 
	 * @return type
	 */
	protected static function getJoins() {
	
		$productCategory = new TableJoin();
		$productCategory->setJoinType(TableJoin::JOIN_LEFT)
				->setRightTable('category')
				->setLeftColumns('category_id')
				->setRightColumns('id')
				->setLeftTable(self::$tableName);
		
		return array($productCategory);
		
	}
	
	/**
	 * 
	 * Internal method for fetching all columns definition
	 * 
	 * @return string
	 */
	protected static function getColumns() {
		$columnsToSelect = "`product`.*, `category`.`name` as `category_name` ";
		return $columnsToSelect;
		
	}
	
	
	/**
	 * 
	 * Converts a single image into the appropriately resized images
	 * 
	 * @param type $file
	 */
	public function setImage($file) {
		
	}
	
	protected function toArray() {
		$dataToStore = ModelHelper::modelToArray($this);
		unset($dataToStore['category_name']);
		return $dataToStore;
	}

}
