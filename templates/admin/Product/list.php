<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['paginator'];

/* @var $products App\Model\Product[] */
$products = $data['products'];
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Products <small>products Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> List of the products
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
                <i class="fa fa-info-circle"></i>  <?= $message ?>
            </div>
        </div>
    </div>
    <!-- /.row -->

<?php } ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Products</h3>
            </div>
            <div class="panel-body">
                <div class="text-right">
                    <a href="<?= $request->createUrl(null, 'create') ?>">Create new product <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="text-left">
                    <?php if ($paginator->hasPrev()) { ?>
                        <a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->previousPage())) ?>">Prev</a>
                    <?php } ?>
                    <?php if ($paginator->hasNext()) { ?>
                        <a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->nextPage())) ?>">Next</a>
                    <?php } ?>
                </div>
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Name</th>
                                <th>Short Description</th>
                                <th>Long Description</th>
                                <th>Price</th>
                                <th>Category ID</th>
                             
                                <th width="130px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td><?= $product->getId() ?></td>
                                    <td><?= $product->getName() ?></td>
                                    <td><?= $product->getShortDecription() ?></td>
                                    <td><?= $product->getLongDescription() ?></td>
                                    <td><?= $product->getPrice() ?></td>
                                    <td><?= $product->getCategoryId() ?></td>
                                    
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'update', array('id' => $product->getId())) ?>" style="float:left;" />Edit</a>
                                        <a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'delete', array('id' => $product->getId())) ?>" style="float:right;" />Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="<?= $request->createUrl(null, 'create') ?>">Create new user <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="text-left">
                    <?php if ($paginator->hasPrev()) { ?>
                        <a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->previousPage())) ?>">Prev</a>
                    <?php } ?>
                    <?php if ($paginator->hasNext()) { ?>
                        <a class='btn btn-primary' href="<?= $request->createUrl(null, null, array('page' => $paginator->nextPage())) ?>">Next</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>