<?php 
$s = new Session;
$db = new DB;
$sql =  "SELECT ";
$sql .= "hotel_id, ";
$sql .= "hotel_name, ";
$sql .= "hotel_details, ";
$sql .= "hotel_link, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "hotels ";
$sql .= "WHERE ";
$sql .= "hotel_id = :hotel_id ";

$hotel_id = httpGet('id');

$hotel = $db->row($sql, array("hotel_id" => $hotel_id));


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
                        <h3 class="panel-title">Edit Hotel</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/hotels.php?action=update&id=<?=$hotel['hotel_id']?>" method="POST" data-toggle="validator" role="form">
                        	<input type="hidden" value="<?=$hotel['hotel_id']?>" name="hotel_id" />
                            <div class="form-group">
                                <label for="hotel_name" class="control-label">Hotel Name</label>
                                <input type="text" class="form-control" id="hotel_name" name="hotel_name" required value="<?=$hotel['hotel_name']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="hotel_details" class="control-label">Details</label>
                                <textarea class="form-control" id="hotel_details" name="hotel_details"><?=$hotel['hotel_details']?></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="hotel_name" class="control-label">Hotel Website</label>
                                <input type="text" class="form-control" id="hotel_link" name="hotel_link" required value="<?=$hotel['hotel_link']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?=$config['url']['base_path']?>/hotels.php" class="btn btn-default">
                                        Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>