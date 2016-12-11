<?php

$db = new DB;

$sql =  "SELECT ";
$sql .= "flight_id, ";
$sql .= "flight_number, ";
$sql .= "flight_from, ";
$sql .= "flight_to, ";
$sql .= "date, ";
$sql .= "depart, ";
$sql .= "arrive, ";
$sql .= "airline, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "flight_schedules ";
$sql .= "WHERE ";
$sql .= "flight_id = :flight_id ";
$sql .= "ORDER BY ";
$sql .= "date_created ASC ";

$flight_id = httpGet('id');

$flight = $db->row($sql, array("flight_id" => $flight_id));

$sql =  "SELECT ";
$sql .= "airport_id, ";
$sql .= "airport_name, ";
$sql .= "airport_location ";
$sql .= "FROM ";
$sql .= "airports ";

$airports = $db->rows($sql);

$sql =  "SELECT ";
$sql .= "airline_id, ";
$sql .= "airline_name, ";
$sql .= "airline_details, ";
$sql .= "date_created ";
$sql .= "FROM ";
$sql .= "airlines ";

$airlines = $db->rows($sql);

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
                        <h3 class="panel-title">Edit Flight Schedule</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/flight.schedules.php?action=update&id=<?=$flight['flight_id']?>" method="POST" data-toggle="validator" role="form">
                            <input type="hidden" name="flight_id" value="<?=$flight['flight_id']?>">
                            <div class="form-group">
                                <label for="flight_no" class="control-label">Flight No.</label>
                                <input type="text" class="form-control" id="flight_no" name="flight_number" required value="<?=$flight['flight_number']?>">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Route</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="flight_from" name="flight_from" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($airports as $airport) : ?>
                                            <?php
                                                $selected_from = "";
                                                if($flight['flight_from'] == $airport['airport_id']) {
                                                    $selected_from = "selected";
                                                }
                                            ?>
                                            <option value="<?=$airport['airport_id']?>" <?=$selected_from?> ><?=$airport['airport_location']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <select class="form-control" id="flight_to" name="flight_to" required>
                                            <option value="">--Select--</option>
                                            <?php foreach($airports as $airport) : ?>
                                            <?php
                                                $selected_to = "";
                                                if($flight['flight_to'] == $airport['airport_id']) {
                                                    $selected_to = "selected";
                                                }
                                            ?>
                                            <option value="<?=$airport['airport_id']?>" <?=$selected_to?> ><?=$airport['airport_location']?></option>
                                            <?php endforeach;?>
                                        </select>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline row">
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Date</label>
                                        <input id="flight-date" type="text" data-toggle="datepicker" class="form-control" name="date" required placeholder="dd/mm/yyyy" value="<?=$flight['date']?>"/>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Depart</label>
                                        <input type="time" name="depart" id="depart" class="form-control" placeholder="00:00" required value="<?=$flight['depart']?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group col-sm-4">
                                        <label for="" class="control-label">Arrive</label>
                                        <input type="time" name="arrive" id="arrive" class="form-control" placeholder="00:00" required value="<?=$flight['arrive']?>">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="airline" class="control-label">Airline</label>
                                <select class="form-control" id="airline" name="airline" required>
                                    <option value="">--Select--</option>
                                    <?php foreach($airlines as $airline) : ?>
                                    <?php
                                        $selected = "";
                                        if($airline['airline_id'] == $flight['airline']) {
                                            $selected = "selected";
                                        }
                                    ?>
                                    <option value="<?=$airline['airline_id']?>" <?=$selected?> ><?=$airline['airline_name']?></option>
                                    <?php endforeach;?>
                                </select>
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