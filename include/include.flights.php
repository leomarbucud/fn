<?php

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
$sql .= "f.date >= CURDATE() ";
$sql .= "ORDER BY ";
$sql .= "f.date ASC ";

$flights = $db->rows($sql);

?>
<div id="wrap">
<div class="m-t-50">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Flight Schedules</h1>
				<div class="row">
					<div class="col-md-12">
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
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <?php foreach($flights as $flight) : ?>
		                            <tr>
		                                <td><?=date_format(date_create($flight['date']),"F d, Y")?></td>
		                                <td><?=$flight['flight_number']?></td>
		                                <td><?=$flight['flight_from_location']?> <span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>  <?=$flight['flight_to_location']?></td>
		                                <td><?=$flight['depart']?></td>
		                                <td><?=$flight['arrive']?></td>
		                                <td><?=$flight['airline_name']?></td>
		                                <td>
		                                	<?php
		                                		if(strpos($flight['duration'], "-") !== false) {
		                                			$flight['duration'] = str_replace("-", "", $flight['duration']);
		                                			echo date('H:i',strtotime("23:00:00") - strtotime($flight['duration']));
		                                		} else {
		                                			echo date('H:i',strtotime($flight['duration']));
		                                		}
		                                	?>
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
	</div>
</div>
