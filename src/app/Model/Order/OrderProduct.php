<?php
namespace App\Model\Order;

class OrderProduct {
	
	protected $id;
	
	protected $productId;
	
	protected $productName;
	
	protected $productPrice;
	
	protected $count;
	
	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

		
	public function getProductId() {
		return $this->productId;
	}

	public function getProductName() {
		return $this->productName;
	}

	public function getProductPrice() {
		return $this->productPrice;
	}

	public function getCount() {
		return $this->count;
	}
	
	public function getTotalPrice() {
		return bcmul($this->count, $this->productPrice, 2);
	}

	public function setProductId($productId) {
		$this->productId = $productId;
		return $this;
	}

	public function setProductName($productName) {
		$this->productName = $productName;
		return $this;
	}

	public function setProductPrice($productPrice) {
		$this->productPrice = $productPrice;
		return $this;
	}

	public function setCount($count) {
		$this->count = $count;
		return $this;
	}
	
	public function addCount($count = 1) {
		$this->count+=$count;
	}
	
	public function subtractCount($count = 1) {
		if ( $this->count < $count ) {
			$this->count = 0;
		} else {
			$this->count-=$count;
		}
		
	}

}

