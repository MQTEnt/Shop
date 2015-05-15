<?php

/* @var $products App\Model\Product[] */
$products = $data['products'];

/* @var $request \Pragmatic\Request */

?>
<!-- START Featured products -->
				
<!-- Page Body title -->
<header class="content-title">
	<div class="title-bg">
		<h1 class="title">Featured Products</h1>
	</div><!-- End .title-bg -->
	<p class="title-desc">Our featured products</p>
</header>
<!-- END Page body title -->

<div id="featured_products">
		
		<?php foreach ($products as $product) { ?>
		<!-- START Product tile -->
		<div class="featured_product_tile">
			<a href="<?=$request->createUrl('product', 'index')?>">
				<img class="featured_product_image" src="img/products/small/product<?=$product->getId()?>.jpg" alt=""/>
				<span class="featured_product_name"><?=$product->getName()?></span>
				<span class="featured_product_description"><?=$product->getShortDecription()?></span>
				<span class="featured_product_price">$<?=$product->getPrice()?></span>
			</a>
		</div>
		<!-- END Product tile -->
		<?php } ?>
</div>
<!-- END Featured products -->

