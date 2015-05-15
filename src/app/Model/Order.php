<?php
namespace App\Model;

use Pragmatic\Model as Model;
use App\Model\Order\OrderCustomer as OrderCustomer;
use App\Model\Order\OrderProduct as OrderProduct;
use Pragmatic\DBAL\TableJoin as TableJoin;
use Pragmatic\Model\ModelHelper as ModelHelper;

class Order extends Model {

	/**
	 * Regular expression for validate order Total.
	 * @var float
	 */
	const VALID_TOTAL_REGEX = '^[0-9]\.([0-9][0-9]+)?$';
	
	/**
	 * The name of the table, containing the order records
	 */
	protected static $tableName = 'order';
	
	/**
	 * The name of the table, containing the relation between orders and products
	 */
	const ORDER_PRODUCT_TABLE_NAME = 'order_has_product';

	/**
	 * The Total of order.
	 * @var flaot
	 */
	protected $total;

	/**
	 * The User who made the oder
	 * @var OrderCustomer
	 */
	protected $user;

	/**
	 * An array of productIds
	 * @var array
	 */
	protected $products = array();

	/**
	 *Return the  Total of Order
	 * var float 
	 */
	public function getTotal() {
		return $this->total;
	}

	/**
	 * Return the  UserId of Order
	 * var OrderCustomer
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Return the ProductID from Order
	 * var \OrderProduct[]
	 */
	public function getProducts() {
		return $this->products;
	}

	/**
	 * Set the order Total
	 * var float
	 */
	public function setTotal($total) {
		if ( !$this->validate('total', $total) ) {
			return false;
		}
		$this->total = $total;
		return $this;
	}
	
	/**
	 * Recalculates and returns the total sum in the order
	 */
	public function calculateTotal() {
		$this->total = 0;
		
		foreach ( $this->products as $product ) {
			$productPrice = bcmul($product->getProductPrice(), $product->getCount(), 2);
			$this->total = bcadd($productPrice, $this->total, 2);
		}
		
		return $this->total;
	}

	/**
	 * Set the UserID from Order
	 * var int
	 */
	public function setUser($userId) {
		
		$user = User\Customer::loadById($userId);
		
		if ( empty($user) ) {
			return false;
		}
		
		$this->user = new OrderCustomer();
		$this->user->setAddress($user->getAddress())
				->setEmail($user->getEmail())
				->setFirstName($user->getFirstName())
				->setId($userId)
				->setLastName($user->getLastName())
				->setUsername($user->getUserName());
		
		return $this;
	}

	/**
	 * Adds a product to the order
	 * var int
	 */
	public function addProduct($productId, $count = 1) {
		
		if (array_key_exists($productId, $this->products) ) {
			$this->products[$productId]->addCount($count);
			$this->calculateTotal();
			return true;
		}
		
		$product = Product::loadById($productId);
		
		if ( empty($product) ) {
			return false;
		}
		
		$orderProduct = new OrderProduct();
		$orderProduct->setProductId($product->getId())
				->setProductName($product->getName())
				->setProductPrice($product->getPrice())
				->setCount($count);
		
		$this->products[$productId] = $orderProduct;
		
		$this->calculateTotal();
		
		return true;
		
	}
	
	/**
	 * 
	 * Removes a product from the order and recalulates the total
	 * 
	 * @param type $productId
	 * @param type $count
	 * @return boolean
	 */
	public function removeProduct($productId, $count = 1) {
		
		if (!array_key_exists($productId, $this->products) ) {
			return false;
		}
		
		$this->products[$productId]->subtractCount($count);
		
		if ( $this->products[$productId]->getCount() == 0 ) {
			unset($this->products[$productId]);
		}
		
		$this->calculateTotal();
		
		return true;
		
	}
	
	/**
	 * 
	 * Internal method to fetch all joins
	 * 
	 * @return type
	 */
	protected static function getJoins() {
	
		$orderHasProductJoin = new TableJoin();
		$orderHasProductJoin->setJoinType(TableJoin::JOIN_LEFT)
				->setRightTable(self::ORDER_PRODUCT_TABLE_NAME)
				->setLeftColumns('id')
				->setRightColumns('order_id')
				->setLeftTable(static::$tableName);
		
		$productsJoin = new TableJoin();
		$productsJoin->setJoinType(TableJoin::JOIN_LEFT)
				->setRightTable('product')
				->setLeftColumns('product_id')
				->setRightColumns('id')
				->setLeftTable(self::ORDER_PRODUCT_TABLE_NAME);
		
		$usersJoin = new TableJoin();
		$usersJoin->setJoinType(TableJoin::JOIN_LEFT)
				->setRightTable('user')
				->setLeftColumns('user_id')
				->setRightColumns('id')
				->setLeftTable('order');
		
		return array($orderHasProductJoin, $productsJoin, $usersJoin);
		
	}
	
	/**
	 * 
	 * Internal method for fetching all columns definition
	 * 
	 * @return string
	 */
	protected static function getColumns() {
		$columnsToSelect = "`order`.*, "
				. "GROUP_CONCAT(`product_id` ORDER BY `product`.`id`) as product_ids, "
				. "GROUP_CONCAT(`product`.`name` ORDER BY `product`.`id`) as product_names, "
				. "GROUP_CONCAT(`product`.`price` ORDER BY `product`.`id`) as product_prices, "
				. "GROUP_CONCAT(`order_has_product`.`count` ORDER BY `order_has_product`.`product_id`) as product_counts, "
				. "user.email as email, user.first_name, user.last_name, user.address, user.username";
		
		return $columnsToSelect;
		
	}
	
	/**
	 * 
	 * Internal method for fetching the group by condition
	 * 
	 * @return string
	 */
	protected static function getGroupBy() {
		return '`order`.`id`';
	}

	/**
	 * Internal method to create and populate an Order object with data from the database
	 * @param type $dbData
	 * @return \Category
	 */
	protected static function hydrateDBData($dbData) {
		$order = parent::hydrateDBData($dbData);
		
		if ( !empty($dbData['product_ids']) ) {
		
			$productIds = explode(',', $dbData['product_ids']);
			$productNames = explode(',', $dbData['product_names']);
			$productPrices = explode(',', $dbData['product_prices']);
			$productCounts = explode(',', $dbData['product_counts']);
			
			foreach ( $productIds as $idx => $productId ) {
				
				$orderProduct = new OrderProduct();
				$orderProduct->setProductId($productIds[$idx])
						->setProductName($productNames[$idx])
						->setProductPrice($productPrices[$idx])
						->setCount($productCounts[$idx]);
				$order->products[$productId] = $orderProduct;
			}
			
			$order->user = new OrderCustomer();
			$order->user->setAddress($dbData['address'])
				->setEmail($dbData['email'])
				->setFirstName($dbData['first_name'])
				->setId($dbData['user_id'])
				->setLastName($dbData['last_name'])
				->setUsername($dbData['username']);
			
		}
		
		return $order;
	}

	/**
	 * 
	 * Updates the database with the current data in the category object
	 * 
	 * @return boolean
	 */
	public function update() {
		if ( $this->id === null ) {
			throw new \Exception("This category instance does not have an id, it is probably not in the database");
		}
		
		if (parent::update()) {
			
			//First delete all products in the order, so we can add only the current ones
			static::$dataBase->delete(self::ORDER_PRODUCT_TABLE_NAME, "`order_id` = '{$this->id}'");
			
			//Now add all product ids to the table
			foreach ( $this->products as $productId=>$productData ) {
				static::$dataBase->insert(
						self::ORDER_PRODUCT_TABLE_NAME, 
						array('product_id'=>$productId, 'order_id'=>$this->id,'count'=>$productData->getCount())
						);
			}
			
		}
	}
	
	protected function toArray() {
		$dataToStore = ModelHelper::modelToArray($this);
		unset($dataToStore['products']);
		$dataToStore['user_id'] = $this->user->getId();
		unset($dataToStore['user']);
		return $dataToStore;
	}
	
	/**
	 * Deletes the current order object from the database
	 * @return boolean
	 */
	public function delete() {
		
		if ( $this->id === null ) {
			throw new \Exception("This model instance does not have an id, it is probably not in the database");
		}
		
		//First delete all products in the order
		static::$dataBase->delete(self::ORDER_PRODUCT_TABLE_NAME, "`order_id` = '{$this->id}'");
		parent::delete();
	}
	
	/**
	 * Inserts the current order object into the database
	 * @return boolean
	 */
	public function insert() {
		
		if ( parent::insert() ) {			
			//Now add all product ids to the table
			foreach ( $this->products as $productId=>$productData ) {
				static::$dataBase->insert(
						self::ORDER_PRODUCT_TABLE_NAME, 
						array('product_id'=>$productId, 'order_id'=>$this->id,'count'=>$productData->getCount())
						);
			}
			
			return true;
		} else {
			return false;
		}
		
	}


}

