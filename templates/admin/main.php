<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/sb-admin.css')?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=$request->createAbsoluteUrl('css/plugins/morris.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=$request->createAbsoluteUrl('font-awesome-4.1.0/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=$request->createAbsoluteUrl('products/list.php')?>">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            
			<ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="<?=$request->createUrl('administrativeuser', 'login')?>">Logout</a>
                </li>
            </ul>
			<?php /* @var $request \Pragmatic\Request */ ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li <?php echo $request->isActive('product') ? 'class="active"' : '';?> >
                        <a href="<?=$request->createUrl('product', 'index')?>"> Products</a>
                    </li>
                    <li <?php echo $request->isActive('category') ? 'class="active"' : '';?>>
                        <a href="<?=$request->createUrl('category', 'index')?>"> Categories</a>
                    </li>
					<li <?php echo $request->isActive('order') ? 'class="active"' : '';?>>
                        <a href="<?=$request->createUrl('order', 'index')?>"> Orders</a>
                    </li>
					<li <?php echo $request->isActive('user') ? 'class="active"' : '';?>>
                        <a href="<?=$request->createUrl('user', 'index')?>"> Users</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
		
		<div id="page-wrapper">

			<div class="container-fluid">
				<?php include $tpl ?>
			</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper --> 
	</div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="<?=$request->createAbsoluteUrl('js/jquery-1.11.0.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/raphael.min.js')?>"></script>
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/morris.min.js')?>"></script>
    <script src="<?=$request->createAbsoluteUrl('js/plugins/morris/morris-data.js')?>"></script>

</body>

</html>
