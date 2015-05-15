<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Admin\Controller;

use App\Model\Category as CategoryModel;

class CategoryController extends AuthenticatedController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$category = CategoryModel::listItems('', $paginator);
		
		$data = array(
			'categories' => $category,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function update() {
		
		$categoryId = $this->request->get('id', $this->request->post('id', null));
		
		$category = CategoryModel::loadById($categoryId);
		
		if ( empty($category) ) {
			return false;
		}
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$category->hydrateFromPOSTData($this->request->post());
				$category->update();
				\Pragmatic\FlashMessage::write("Category with id {$category->getId()} updated successfully ");
				$this->response->redirect('Category', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
		
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($category, false), 'form.php');
		
	}
	
	public function create() {
		
		$category = new CategoryModel();
		
		if ( $this->request->method() == \Pragmatic\Request::METHOD_POST ) {
			
			try {
				$category = CategoryModel::createFromPOSTData($this->request->post());
				$category->insert();
				\Pragmatic\FlashMessage::write("Category with id {$category->getId()} created successfully ");
				$this->response->redirect('Category', 'index');
			} catch ( \Exception $e ) {
				\Pragmatic\FlashMessage::write(nl2br($e->getMessage()));
				$this->render($this->request->post(), 'form.php');
				return;
			}
			
		}
		
		$this->render(\Pragmatic\ModelHelper::modelToArray($category, false), 'form.php');
		
	}
	
	public function delete() {
		
		$category = CategoryModel::loadById($this->request->get('id'));
		$category->delete();
		\Pragmatic\FlashMessage::write("Category with id {$category->getId()} has been deleted successfully");
		$this->response->redirect('Category', 'index');
		
	}
	
}

