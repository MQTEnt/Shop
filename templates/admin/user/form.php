<?php

/* @var $request \Pragmatic\Request */

?>
				<!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users 
							<small>
								<?php if ($request->getCurrentAction() == 'create') { ?> 
								Create User 
								<?php } else { ?> 
								Edit User
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
                            <i class="fa fa-info-circle"></i>  <strong>Error</strong> <?=$message?>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
				<?php } ?>

                <div class="row">
					<div class="col-lg-6">
						<form role="form" action="<?= $request->createUrl() ?>" method="POST">

                            <div class="form-group">
                                <label>Username</label>
                                <input required pattern="<?= App\Model\User\Customer::VALID_USERNAME_REGEX ?>" placeholder="Username" name="username" value="<?=$data['username']?>" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Password</label>
                                <input required pattern="<?=  App\Model\User\Customer::VALID_PASSWORD_REGEX ?>" placeholder="Password" name="password" value="<?=$data['password']?>" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Email</label>
                                <input required pattern="<?=  App\Model\User\Customer::VALID_EMAIL_REGEX ?>" placeholder="Email" name="email" value="<?=$data['email']?>" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>First Name</label>
                                <input required pattern="<?= App\Model\User\Customer::VALID_NAME_REGEX ?>" placeholder="First Name" name="firstName" value="<?=$data['firstName']?>" class="form-control">
                            </div>
							
							<div class="form-group">
                                <label>Last Name</label>
                                <input required pattern="<?= App\Model\User\Customer::VALID_NAME_REGEX ?>" placeholder="Last Name" name="lastName" value="<?=$data['lastName']?>" class="form-control">
                            </div>

							<div class="form-group">
                                <label>Address</label>
                                <textarea name="address" rows="3" class="form-control"><?=$data['address']?></textarea>
                            </div>
							<input type="hidden" name='id' value='<?=$data['id']?>'/>
                            <button class="btn btn-default" type="submit">Submit Button</button>
                            <button class="btn btn-default" type="reset">Reset Button</button>

                        </form>
                    </div>
				</div>