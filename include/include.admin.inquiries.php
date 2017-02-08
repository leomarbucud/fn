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
// $sql .= "GROUP BY ";
// $sql .= "status ";
$sql .= "ORDER BY ";
$sql .= "date_created ASC ";

$inquiries = $db->rows($sql);

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
            	<?php if(isset($email_sent)) : if($email_sent) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Email has been sent!</strong> 
                    <p>
                    	To: <?=$email?>
                    	<br/>
                    	Subject: <?=$subject?>
                    </p>
                </div>
                <?php endif; endif; ?>
                <?php if(isset($sms_sent)) : if($sms_sent) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>SMS has been sent!</strong> 
                </div>
                <?php endif; endif; ?>
                <?php if(isset($error_sms)) : if($error_sms) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>SMS failed to send, please check the number and try again.</strong> 
                </div>
                <?php endif; endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Inquiries</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inquiries as $inquiry) : ?>
                            <tr>
                                <td><?=$inquiry['name']?></td>
                                <td><?=$inquiry['email']?></td>
                                <td><?=$inquiry['place_from']?></td>
                                <td><?=$inquiry['place_togo']?></td>
                                <td><?=$inquiry['status']?></td>
                                <td class="text-center">
                                    <a href="<?=$config['url']['base_path']?>/inquiries.php?action=view_details&id=<?=$inquiry['inquiry_id']?>" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View details
                                    </a>
                                    <a href="<?=$config['url']['base_path']?>/inquiries.php?action=write_email&type=user&id=<?=$inquiry['inquiry_id']?>" class="btn btn-success btn-xs">
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send email
                                    </a>
                                    <a href="<?=$config['url']['base_path']?>/inquiries.php?action=write_sms&type=user&id=<?=$inquiry['inquiry_id']?>" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Send SMS
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
