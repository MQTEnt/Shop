<?php
/* @var $categories \App\Model\Category[] */
$categories = $data['categories'];

$breadcrumbs = $data['breadcrumbs'];

/* @var $request \Pragmatic\Request */
?>
<!DOCTYPE html>
<html>
	
	<head>
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="css/styles.css" />
		
		<title> The PC Shop </title>
		
	</head>
	
	<body>
		<div id="page_wrapper">
			
			<!-- START top header -->
			<div id="top_header" >
				<div id="top_logo">
					
				</div>
				<div id="company_name">GEEK MANIA</div>
				<div id="slogan">The PC Store</div>
			</div>
			<!-- END top header -->

			<!-- START top menu -->
			<nav id="top_menu_nav">
				<ul id="top_menu_list">
					<li class="active"> <a href="index.php"> Home </a> </li>
					<li> 
						<a href="products.php"> Products </a> 
						<ul class="top_menu_submenu">
							<?php foreach ($categories as $category) { ?>
							<li> <a href="products.php"><?=$category->getName()?></a> </li>
							<?php } ?>
						</ul>
					</li>
					<li> <a href="cart.php"> Shopping cart </a> </li>
					<li> <a href="account.php"> My Account </a> </li>
					<li> <a href="contact.php"> Contact Us </a> </li>
				</ul>
			</nav>
			<!-- END top menu -->

			<!-- START breadcrumbs -->
			<ul id="breadcrumb">
				<?php 
					foreach ($breadcrumbs as $name => $breadcrumb) { 
						if (!empty($breadcrumb)) {
							?> <li> <a href="<?=$request->createUrl($breadcrumb['controller'], $breadcrumb['action'])?>"> <?=$name?> </a> </li><?php
						} else {
							?> <li> <?=$name?> </li><?php
						}
				?>
				<?php } ?>
			</ul>
			<!-- END breadcrumbs -->

			<!-- START page body -->
			<div id="page_body">
				<?php include $tpl?>
			</div>
			<!-- END page body -->

			<!-- Start footer -->
			<div id="footer">
				<nav id="footer_menu">
					<ul id="footer_menu_list">
						<li class="active"> <a href="index.php"> Home </a> </li>
						<li><a href="products.php"> Products </a></li>
						<li> <a href="cart.php"> Shopping cart </a> </li>
						<li> <a href="account.php"> My Account </a> </li>
						<li> <a href="contact.php"> Contact Us </a> </li>
					</ul>
				</nav>
				<div id="footer_contact_info">
					<span id="footer_contact_phone"><i class="fa fa-mobile-phone fa-lg">&nbsp;</i>555-555-555</span>
					<span id="footer_contact_mail"><i class="fa fa-fw fa-envelope fa-lg">&nbsp;</i>test@example.com</span>
					<span id="footer_contact_mailing"><i class="fa fa-map-marker fa-lg">&nbsp;</i>123 Sample Str. Sofia, Bulgaria</span>
				</div>
			</div>
			<!-- End footer -->
		</div>
	</body>
	
</html>