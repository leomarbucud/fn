<?php 
$s = new Session;
$db = new DB;
$sql =  "SELECT ";
$sql .= "airport_id, ";
$sql .= "airport_name, ";
$sql .= "airport_location, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "airports ";;
$sql .= "WHERE ";
$sql .= "airport_id = :airport_id ";

$airport_id = httpGet('id');

$airport = $db->row($sql, array("airport_id" => $airport_id));


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
                        <h3 class="panel-title">Edit Airport</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/airports.php?action=update&id=<?=$airport['airport_id']?>" method="POST" data-toggle="validator" role="form">
                        	<input type="hidden" value="<?=$airport['airport_id']?>" name="airport_id" />
                            <div class="form-group">
                                <label for="airport_name" class="control-label">airport Name</label>
                                <input type="text" class="form-control" id="airport_name" name="airport_name" required value="<?=$airport['airport_name']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="airport_location" class="control-label">Location</label>
                                <input type="text" class="form-control" id="airport_location" name="airport_location" required value="<?=$airport['airport_location']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?=$config['url']['base_path']?>/airports.php" class="btn btn-default">
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