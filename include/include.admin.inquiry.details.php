<?php 

$db = new DB;

$sql =  "SELECT ";
$sql .= "inquiry_id, ";
$sql .= "place_from, ";
$sql .= "place_togo, ";
$sql .= "name, ";
$sql .= "email, ";
$sql .= "contact, ";
$sql .= "type, ";
$sql .= "status, ";
$sql .= "additional_note, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "inquiries ";
$sql .= "WHERE ";
$sql .= "inquiry_id = :inquiry_id";

$inquiry_id = httpGet("id");

$inquiry = $db->row($sql, array("inquiry_id" => $inquiry_id));


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
                        <h3 class="panel-title">Inquiry ID : <?=$inquiry['inquiry_id']?></h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <table class="table" >
                            <tr>
                                <td>Name</td>
                                <td><?=$inquiry['name']?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?=$inquiry['email']?></td>
                            </tr>
                            <tr>
                                <td>Contact</td>
                                <td><?=$inquiry['contact']?></td>
                            </tr>
                            <tr>
                                <td>From</td>
                                <td><?=$inquiry['place_from']?></td>
                            </tr>
                            <tr>
                                <td>To</td>
                                <td><?=$inquiry['place_togo']?></td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td><?=$inquiry['type']?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><?=$inquiry['status']?></td>
                            </tr>
                            <tr>
                                <td>Created</td>
                                <td><?=$inquiry['date_created']?></td>
                            </tr>
                            <tr>
                                <td>Note</td>
                                <td><?=$inquiry['additional_note']?></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="<?=$config['url']['base_path']?>/inquiries.php?action=write_email&type=user&id=<?=$inquiry['inquiry_id']?>" class="btn btn-success">
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send email
                                    </a>
                                    <!-- <a href="<?=$config['url']['base_path']?>/admin.php?action=delete&type=user&id=<?=$user['user_id']?>" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete
                                    </a> -->
                                    <a href="<?=$config['url']['base_path']?>/inquiries.php" class="btn btn-default">
                                        Back
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