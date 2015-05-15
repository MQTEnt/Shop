<?php
/* @var $request \Pragmatic\Request */
?>
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Categories 
            <small>
                <?php if ($request->getCurrentAction() == 'create') { ?> 
                    Create Category 
                <?php } else { ?> 
                    Edit Category
                <?php } ?>
            </small>
        </h1>
    </div>
</div>
<!-- /.row -->
<?php if (!empty($message)) { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-info-circle"></i>  <strong>Error</strong> <?= $message ?>
            </div>
        </div>
    </div>
    <!-- /.row -->
<?php } ?>

<div class="row">
    <div class="col-lg-6">
        <form role="form" action="<?= $request->createUrl() ?>" method="POST">

            <div class="form-group">
                <label>Name</label>
                <input required pattern="<?= App\Model\Category::VALID_NAME_REGEX ?>" placeholder="name" name="name" value="<?= $data['name'] ?>" class="form-control">
            </div>

            <div class="form-group">
                <label>Description</label>
                <input placeholder="description" name="description" value="<?= $data['description'] ?>" class="form-control">
            </div>


            <input type="hidden" name='id' value='<?= $data['id'] ?>'/>
            <button class="btn btn-default" type="submit">Submit Button</button>
            <button class="btn btn-default" type="reset">Reset Button</button>

        </form>
    </div>
</div>