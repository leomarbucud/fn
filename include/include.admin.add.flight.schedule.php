<?php 
$s = new Session;
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
                        <h3 class="panel-title">Add Flight Schedule</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/flight.schedules.php?action=save" method="POST" data-toggle="validator" role="form">
                            <div class="form-group">
                                <label for="flight_no" class="control-label">Flight No.</label>
                                <input type="text" class="form-control" id="flight_no" name="flight_number" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Route</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="flight_from" class="form-control" id="from" placeholder="From" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="flight_to" class="form-control" id="to" placeholder="Destination" value="" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Date</label>
                                        <input id="flight-date" type="text" data-toggle="datepicker" class="form-control" name="date" required placeholder="dd/mm/yyyy" />
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Depart</label>
                                        <input type="time" name="depart" id="depart" class="form-control" placeholder="00:00" value=""  required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Arrive</label>
                                        <input type="time" name="arrive" id="arrive" class="form-control" placeholder="00:00" value=""  required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="control-label">Airline</label>
                                <input type="text" class="form-control" id="airline" name="airline" placeholder="Airline" value="" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?=$config['url']['base_path']?>/flight.schedules.php" class="btn btn-default">
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