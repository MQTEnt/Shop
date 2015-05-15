<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\FrontEnd\Controller;

/**
 * Description of IndexController
 *
 * @author muteX
 */
class IndexController extends BaseController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(6);
		
		$products = \App\Model\Product::listItems('', $paginator);
		
		$data = [
			'products' => $products,
			'categories' => $this->getCategories()
		];
		
		$this->render($data, 'index.php');
		
	}
	
	protected function getBreadCrumbs() {
		return [
			'Home'=>[]
			];
	}
	
	
}
