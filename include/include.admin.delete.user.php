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
if(!$user) {
    header("location: {$config['url']['base_path']}/admin.php");
}
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
                        <h3 class="panel-title"><?=$user['firstname']?> <?=$user['lastname']?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-success alert-warning" role="alert">
                            <strong>Warning!</strong> This user will permanently deleted. You cannot undo this action.
                        </div>
                        <div class="media">
                            <div class="media-left">
                                <a href="#">
                                    <img class="img-circle" src="<?=$config['url']['profile_pic']?>/<?=$user['profile']?>" width="50" height="50" />
                                </a>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?=$user['firstname']?> <?=$user['lastname']?></h4>
                                <table class="table" >
                                    <tr>
                                        <td>Email</td>
                                        <td><?=$user['email']?></td>
                                    </tr>
                                    <tr>
                                        <td>Birthday</td>
                                        <td><?=$user['birthdate']?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?=$user['gender']==0?'Male':'Female'?></td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td><?=$user['address']?></td>
                                    </tr>
                                    <tr>
                                        <td>Bio</td>
                                        <td><?=$user['bio']?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=user&id=<?=$user['user_id']?>" class="btn btn-default">
                                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel
                                            </a>
                                            <a href="<?=$config['url']['base_path']?>/admin.php?action=delete&type=user&confirm=yes&id=<?=$user['user_id']?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Proceed to delete
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>