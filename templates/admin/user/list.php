<?php
/* @var $request \Pragmatic\Request */

/* @var $paginator \Pragmatic\DBAL\Paginator */
$paginator = $data['paginator'];

/* @var $users App\Model\User\Customer[] */
$users = $data['users'];
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Users <small>users Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> List of the users
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
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Users</h3>
            </div>
            <div class="panel-body">
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
                <br/>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID #</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>email</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                                <th width="130px">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) { ?>
                                <tr>
                                    <td><?= $user->getId() ?></td>
                                    <td><?= $user->getUsername() ?></td>
                                    <td><?= $user->getPassword() ?></td>
                                    <td><?= $user->getEmail() ?></td>
                                    <td><?= $user->getFirstName() ?></td>
                                    <td><?= $user->getLastName() ?></td>
                                    <td><?= $user->getAddress() ?></td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'update', array('id' => $user->getId())) ?>" style="float:left;" />Edit</a>
                                        <a class="btn btn-primary btn-sm" href="<?= $request->createUrl(null, 'delete', array('id' => $user->getId())) ?>" style="float:right;" />Delete</a>
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