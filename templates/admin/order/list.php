<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['paginator'];

/* @var $orders App\Model\Order[] */
$orders = $data['orders'];
?>
<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Orders <small>Orders Overview</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> List of the orders
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				
				<?php if (!empty($message)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i>  <?=$message?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				
				<?php } ?>

                <div class="row">
					<div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Orders</h3>
                            </div>
                            <div class="panel-body">
								<div class="text-right">
                                    
                                </div>
								<div class="text-left">
									<?php if ($paginator->hasPrev()) { ?>
                                    <a class='btn btn-primary' href="<?=$request->createUrl(null,null,array('page'=>$paginator->previousPage()))?>">Prev</a>
									<?php } ?>
									<?php if ($paginator->hasNext()) {  ?>
									<a class='btn btn-primary' href="<?=$request->createUrl(null,null,array('page'=>$paginator->nextPage()))?>">Next</a>
									<?php } ?>
                                </div>
								<br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Order ID #</th>
                                                <th>Customer ID</th>
                                                <th>Customer Name</th>
                                                <th>Customer Address</th>
												<th>Products</th>
												<th width="130px">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php foreach ($orders as $order) { ?>
                                            <tr>
                                                <td><?=$order->getId()?></td>
                                                <td><?=$order->getUser()->getId()?></td>
												<td><?=$order->getUser()->getFirstName()." ".$order->getUser()->getLastName()?></td>
                                                <td><?=$order->getUser()->getAddress()?></td>
												<td>
													<table class="table table-bordered table-hover table-striped">
														<thead>
															<tr>
																<th>Product ID</th>
																<th>Product Name</th>
																<th>Quantity</th>
																<th>Single Price</th>
																<th>Price</th>
																<th width="130px">Actions</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($order->getProducts() as $product) { ?>
															<?php 
																	/* @var $product \App\Model\Order\OrderProduct */
															?>
															<tr>
																<td><?=$product->getProductId()?></td>
																<td><?=$product->getProductName()?></td>
																<td><?=$product->getCount()?></td>
																<td><?=$product->getProductPrice()?></td>
																<td><?=$product->getTotalPrice()?></td>
																<td></td>
															</tr>
															<?php } ?>
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td><b>Total</b></td>
																<td><?= $order->getTotal()?></td>
																<td></td>
															</tr>
														</tbody>
													</table>
												</td>
												<td>
													<a class="btn btn-primary btn-sm" href="<?=$request->createUrl(null,'delete',array('id'=>$order->getId()))?>" style="float:left;" />Delete</a>
												</td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-right">
                                    
                                </div>
								<div class="text-left">
									<?php if ($paginator->hasPrev()) { ?>
                                    <a class='btn btn-primary' href="<?=$request->createUrl(null,null,array('page'=>$paginator->previousPage()))?>">Prev</a>
									<?php } ?>
									<?php if ($paginator->hasNext()) {  ?>
									<a class='btn btn-primary' href="<?=$request->createUrl(null,null,array('page'=>$paginator->nextPage()))?>">Next</a>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>