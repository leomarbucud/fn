<?php 
$s = new Session;
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="col-md-12">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="admin-page">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add User</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/admin.php?action=save&type=user" method="POST" data-toggle="validator" role="form">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First name" value="" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last name" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Email address is invalid" value="" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Birthdate</label>
                                        <input type="text" data-toggle="datepicker" name="birthdate" class="form-control" placeholder="mm/dd/yyyy" value=""  required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Gender</label>
                                        <select class="form-control" name="gender" required>
                                            <option value="">--Select--</option>
                                            <option value="0" >Male</option>
                                            <option value="1" >Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="" required>
                            </div>
                             <div class="form-group">
                                <label for="bio" class="control-label">Bio</label>
                                <textarea rows="3" class="form-control" id="bio" name="bio" placeholder="Bio"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control" value=""  required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password" required data-minlength="6">
                                        <div class="help-block">Minimum of 6 characters</div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="active" />
                                    Active
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>