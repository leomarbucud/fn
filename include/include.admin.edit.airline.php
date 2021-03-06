<?php 
$s = new Session;
$db = new DB;
$sql =  "SELECT ";
$sql .= "airline_id, ";
$sql .= "airline_name, ";
$sql .= "airline_details, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "airlines ";
$sql .= "WHERE ";
$sql .= "airline_id = :airline_id ";

$airline_id = httpGet('id');

$airline = $db->row($sql, array("airline_id" => $airline_id));


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
                        <h3 class="panel-title">Edit Airline</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/airlines.php?action=update&id=<?=$airline['airline_id']?>" method="POST" data-toggle="validator" role="form">
                        	<input type="hidden" value="<?=$airline['airline_id']?>" name="airline_id" />
                            <div class="form-group">
                                <label for="airline_name" class="control-label">Airline Name</label>
                                <input type="text" class="form-control" id="airline_name" name="airline_name" required value="<?=$airline['airline_name']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="airline_details" class="control-label">Details</label>
                                <input type="text" class="form-control" id="airline_details" name="airline_details" required value="<?=$airline['airline_details']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?=$config['url']['base_path']?>/airlines.php" class="btn btn-default">
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