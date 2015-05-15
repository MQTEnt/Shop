<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Admin\Controller;

use App\Model\Product as ProductModel;

class ProductController extends AuthenticatedController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$products = ProductModel::listItems('', $paginator);
		
		$data = array(
			'products' => $products,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function update() {
		
		$productId = $this->request->get('id', $this->request->post('id', null));
		
		$products = ProductModel::loadById($productId);
		
		if ( empty($products) ) {
			return false;
		}
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$products->hydrateFromPOSTData($this->request->post());
				$products->update();
				\Pragmatic\FlashMessage::write("Product with id {$products->getId()} updated successfully ");
				$this->response->redirect('product', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
		
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($products, false), 'form.php');
		
	}
	
	public function create() {
		
		$products = new ProductModel;
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$products = ProductModel::createFromPOSTData($this->request->post());
				$products->insert();
				\Pragmatic\FlashMessage::write("Product with id {$products->getId()} created successfully ");
				$this->response->redirect('product', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
			
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($products, false), 'form.php');
		
	}
	
	public function delete() {
		
		$products = ProductModel::loadById($this->request->get('id'));
		$products->delete();
		\Pragmatic\FlashMessage::write("Product with id {$products->getId()} has been deleted successfully");
		$this->response->redirect('product', 'index');
		
	}
	
}

