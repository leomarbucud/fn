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
        <<?php include_once 'include/include.side.bar.php'; ?>
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
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
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
                                            <a href="<?=$config['url']['base_path']?>/admin.php?action=edit&type=user&id=<?=$user['user_id']?>" class="btn btn-success">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                            </a>
                                            <a href="<?=$config['url']['base_path']?>/admin.php?action=delete&type=user&id=<?=$user['user_id']?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
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