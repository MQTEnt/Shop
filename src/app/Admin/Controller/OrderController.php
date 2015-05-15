<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Admin\Controller;

/**
 * Description of OrderController
 *
 * @author muteX
 */
class OrderController extends AuthenticatedController {
	
	public function index() {
		
		$paginator = new \Pragmatic\DBAL\Paginator(10);
		
		$orders = \App\Model\Order::listItems('', $paginator);
		
		$data = array(
			'orders' => $orders,
			'paginator' => $paginator
		);
		
		$this->render($data, 'list.php');
		
	}
	
	public function delete() {
		
		$order = \App\Model\Order::loadById($this->request->get('id'));
		$order->delete();
		\Pragmatic\FlashMessage::write("Order with id {$order->getId()} has been deleted successfully");
		$this->response->redirect('order', 'index');
		
	}
	
}
