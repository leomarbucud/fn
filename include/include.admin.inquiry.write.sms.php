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
$sql .= "additional_note ";
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
                        <form action="<?=$config['url']['base_path']?>/inquiries.php?action=send_sms" method="POST" data-toggle="validator" role="form">
	                        <input type="hidden" name="email" value="<?=$inquiry['email']?>" />
	                        <input type="hidden" name="id" value="<?=$inquiry['inquiry_id']?>" />
	                        <table class="table" >
	                            <tr>
	                                <td>To:</td>
	                                <td>
	                                	<input type="text" value="<?=$inquiry['contact']?>" name="contact" class="form-control"/>
	                                	<small>(format +639XXXXXXXXX)</small>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td>Message:</td>
	                                <td>
	                                	<textarea class="form-control" rows="10" name="message">Hi <?=$inquiry['name']?>,

</textarea>
	                                </td>
	                            </tr>
	                            <tr>
	                                <td colspan="2">
	                                	<button type="submit" class="btn btn-success">
	                                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send
	                                    </button>
	                                    <a href="<?=$config['url']['base_path']?>/inquiries.php?action=view_details&id=<?=$inquiry['inquiry_id']?>" class="btn btn-default">
	                                        Back
	                                    </a>
	                                </td>
	                            </tr>
	                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>