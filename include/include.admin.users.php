<?php 
$s = new Session; 

function getUsers() {
    $db = new DB;
    $s = new Session;
    $sql =  "SELECT ";
    $sql .= "ud.user_id, ";
    $sql .= "ud.firstname, ";
    $sql .= "ud.middlename, ";
    $sql .= "ud.lastname, ";
    $sql .= "ud.address, ";
    $sql .= "ud.birthdate, ";
    $sql .= "ud.gender, ";
    $sql .= "ud.bio, ";
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
    $sql .= "u.id != :user_id";
    $return = $db->rows($sql, array("user_id" => $s->_get('id')));

    return $return;
}
$users = getUsers();
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <div class="profile-side">
            <img class="img-circle" src="<?=$config['url']['profile_pic']?>/<?=$s->_get('user')['profile']?>" width="50" height="50" />&nbsp;
            <strong><?=$s->_get('user')['firstname']?> <?=$s->_get('user')['lastname']?></strong>
        </div>
        <div class="col-md-12 profile-actions">
            <ul>
                <li><a href="<?=$config['url']['base_path']?>"><span class="glyphicon glyphicon-home"></span> News Feed</a></li>
                <li><a href="<?=$config['url']['base_path']?>/profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messages</a></li>
            </ul>
            <h4>Account Settings</h4>
            <ul>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=info"><span class="glyphicon glyphicon-pencil"></span> Edit Account</a></li>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=security"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=pic"><span class="glyphicon glyphicon-camera"></span> Change Profile Picture</a></li>
            </ul>
            <h4>Admin Settings</h4>
            <ul>
                <li class="active"><a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=users"><span class="glyphicon glyphicon-user"></span> Users</a></li>
                <li><a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=ads"><span class="glyphicon glyphicon-flag"></span> Ads</a></li>                
            </ul>
        </div>
    </div>
    <div id="main">
        <div class="col-md-12">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="admin-page">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Users</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $user) : ?>
                                <tr>
                                    <td><?=$user['firstname']?> <?=$user['lastname']?></td>
                                    <td><?=$user['username']?></td>
                                    <td><?=$user['email']?></td>
                                    <td class="text-center">
                                        <?php if($user['active'] == 1): ?>
                                        <label class="label label-success">Active</label>
                                        <?php else: ?>
                                        <label class="label label-default">Disabled</label>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=user&id=<?=$user['user_id']?>" class="btn btn-default btn-xs">
                                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View
                                        </a>
                                         <a href="<?=$config['url']['base_path']?>/admin.php?action=edit&type=user&id=<?=$user['user_id']?>" class="btn btn-success btn-xs">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="6">
                                        <a href="<?=$config['url']['base_path']?>/admin.php?action=add&type=user" class="btn btn-primary pull-right btn-sm">
                                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>