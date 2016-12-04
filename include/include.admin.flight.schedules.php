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
$sql .= "ORDER BY ";
$sql .= "date_created ASC ";

$flights = $db->rows($sql);

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
            	<?php if(isset($save)) : if($save) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> 
                    Flight schedule has been added
                </div>
                <?php endif; endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Flight Schedules</h3>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Flight No.</th>
                                <th>Route</th>
                                <th>Depart</th>
                                <th>Arrive</th>
                                <th>Airline</th>
                                <th>Duration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($flights as $flight) : ?>
                            <tr>
                                <td><?=$flight['date']?></td>
                                <td><?=$flight['flight_number']?></td>
                                <td><?=$flight['flight_from']?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>  <?=$flight['flight_to']?></td>
                                <td><?=$flight['depart']?></td>
                                <td><?=$flight['arrive']?></td>
                                <td><?=$flight['airline']?></td>
                                <td>
                                	<?php
                                		$depart = strtotime($flight['depart']);
                                		$arrive = strtotime($flight['arrive']);
                                		$duration = $depart - $arrive;

                                		echo date('H:i',abs($duration));
                                	?>
                                </td>
                                <td class="text-center">
                                    <a href="<?=$config['url']['base_path']?>/flight.schedules.php?action=edit&id=<?=$flight['flight_id']?>" class="btn btn-default btn-xs">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="8">
                                    <a href="<?=$config['url']['base_path']?>/flight.schedules.php?action=add" class="btn btn-primary pull-right btn-sm">
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
