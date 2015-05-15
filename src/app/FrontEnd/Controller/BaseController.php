<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\FrontEnd\Controller;
/**
 * Description of BaseController
 *
 * @author muteX
 */
class BaseController extends \Pragmatic\Controller {
	
	protected $categories;
	
	public function getCategories() {
		
		if ( empty($this->categories) ) {
			$this->categories = \App\Model\Category::listItems();
		}
		
		return $this->categories;
		
	}
	
	protected function getBreadCrumbs() {
//		return [
//			'name' => ['controller'=>'xx','action'=>'xxx'],
//			'name' => ['controller'=>'xx','action'=>'xxx'],
//			'name' => []
//		];
		
		return [];
	}
	
	protected function render($data, $tpl) {
		
		$data = array_merge(
					[
						'categories' => $this->getCategories(),
						'breadcrumbs' => $this->getBreadCrumbs()
					],
					$data
				);
		
		return parent::render($data, $tpl);
	}

	
}
