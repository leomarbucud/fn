<?php 
$s = new Session; 

function getUserById($userId) {
    $db = new DB;
    $sql =  "SELECT ";
    $sql .= "ud.user_id, ";
    $sql .= "ud.firstname, ";
    $sql .= "ud.middlename, ";
    $sql .= "ud.lastname, ";
    $sql .= "ud.address, ";
    $sql .= "ud.birthdate, ";
    $sql .= "ud.gender, ";
    $sql .= "ud.bio, ";
    $sql .= "ud.profile, ";
    $sql .= "u.username, ";
    $sql .= "u.email, ";
    $sql .= "u.active ";
    $sql .= "FROM ";
    $sql .= "`user_details` as ud ";
    $sql .= "INNER JOIN ";
    $sql .= "`users` as u ";
    $sql .= "ON ";
    $sql .= "u.id = ud.user_id ";
    $sql .= "WHERE ";
    $sql .= "u.id = :user_id";
    $return = $db->row($sql, array("user_id" => $userId));

    return $return;
}
$userId = httpGet('id');
if($userId) {
    $user = getUserbyId($userId);
}
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
                        <h3 class="panel-title">Edit <?=$user['firstname']?> <?=$user['lastname']?></h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/admin.php?action=update&type=user&id=<?=$user['user_id']?>" method="POST" data-toggle="validator" role="form">
                            <input type="hidden" name="user_id" value="<?=$user['user_id']?>" />
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="First name" value="<?=$user['firstname']?>" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Last name" value="<?=$user['lastname']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="Email address is invalid" value="<?=$user['email']?>" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Birthdate</label>
                                        <input type="text" data-toggle="datepicker" name="birthdate" class="form-control" placeholder="YYYY-MM-DD" value="<?=$user['birthdate']?>"  required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Gender</label>
                                        <select class="form-control" name="gender">
                                            <option value="0" <?=$user['gender']==0?'selected':''?>>Male</option>
                                            <option value="1" <?=$user['gender']==1?'selected':''?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="<?=$user['address']?>" required>
                            </div>
                             <div class="form-group">
                                <label for="bio" class="control-label">Bio</label>
                                <textarea rows="3" class="form-control" id="bio" name="bio" placeholder="Bio" ><?=$user['bio']?></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?=$user['username']?>"  required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="" class="control-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Password">
                                        <div class="help-block">Minimum of 6 characters</div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" value="1" name="active" <?=$user['active']?'checked':''?> />
                                    Active
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>