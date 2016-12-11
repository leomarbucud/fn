<?php

$s = new Session;

$db = new DB;

$sql =  "SELECT ";
$sql .= "f.flight_id, ";
$sql .= "f.flight_number, ";
$sql .= "f.flight_from, ";
$sql .= "f.flight_to, ";
$sql .= "f.date, ";
$sql .= "f.depart, ";
$sql .= "TIMEDIFF(f.arrive, f.depart) as duration, ";
$sql .= "f.arrive, ";
$sql .= "f.airline, ";
$sql .= "(SELECT airline_name FROM airlines as a WHERE a.airline_id = f.airline) as airline_name, ";
$sql .= "f.date_created, ";
$sql .= "(SELECT airport_location FROM airports as a WHERE a.airport_id = f.flight_from) as flight_from_location, ";
$sql .= "(SELECT airport_location FROM airports as a WHERE a.airport_id = f.flight_to) as flight_to_location ";
$sql .= "FROM ";
$sql .= "flight_schedules as f ";
$sql .= "WHERE ";
$sql .= "f.flight_id = :flight_id ";

$flight_details = $db->row($sql,
		array("flight_id" => httpGet('id'))
	);

if(!$flight_details) {
	header("location: {$config['url']['base_path']}/tourpackage.php?action=view_details&package_id=".httpGet('id'));
}
?>
<div class="login-wrapper" style="min-height: 100%;">
    <div class="container m-t-50" style="max-width: 500px;" >
        <div class="panel panel-success" >
            <div class="panel-heading">
                <h3 class="panel-title">Flight Details</h3>
            </div>
            <div class="panel-body">
            	<table class="table table-bordered table-striped">
            		<tr>
            			<td>Flight No.</td>
            			<td><?=$flight_details['flight_number']?></td>
            		</tr>
            		<tr>
            			<td>Date</td>
            			<td><?=date_format(date_create($flight_details['date']),"F d, Y")?></td>
            		</tr>
            		<tr>
            			<td>Route</td>
            			<td>
            				<?=$flight_details['flight_from_location']?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span> <?=$flight_details['flight_to_location']?>
            			</td>
            		</tr>
            		<tr>
            			<td>Depart</td>
            			<td><?=$flight_details['depart']?></td>
            		</tr>
            		<tr>
            			<td>Arrive</td>
            			<td><?=$flight_details['arrive']?></td>
            		</tr>
					<tr>
            			<td>Duration</td>
            			<td>
            			<?php
	                		if(strpos($flight_details['duration'], "-") !== false) {
	                			$flight_details['duration'] = str_replace("-", "", $flight_details['duration']);
	                			echo date('H:i',strtotime("23:00:00") - strtotime($flight_details['duration']));
	                		} else {
	                			echo date('H:i',strtotime($flight_details['duration']));
	                		}
	                	?>
                    	<td>
            		</tr>
            		<tr>
            			<td>Airline</td>
            			<td><?=$flight_details['airline_name']?></td>
            		</tr>
            	</table>
            </div>
        </div>
    </div>
</div>