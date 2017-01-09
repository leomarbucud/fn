<?php
$s = new Session;
$db = new DB;

$sql =  "SELECT ";
$sql .= "b.booking_id, ";
$sql .= "b.package_id, ";
$sql .= "b.user_id, ";
$sql .= "b.status_code, ";
$sql .= "b.note, ";
$sql .= "b.seat, ";
$sql .= "b.flight_id, ";
$sql .= "b.date_of_booking, ";
$sql .= "p.place_id, ";
$sql .= "p.package_name, ";
$sql .= "p.package_price, ";
$sql .= "p.package_days, ";
$sql .= "p.package_person, ";
$sql .= "p.package_accomodation, ";
$sql .= "p.package_transportation, ";
$sql .= "p.package_start, ";
$sql .= "p.package_end, ";
$sql .= "p.package_from, ";
$sql .= "p.package_to, ";
$sql .= "pl.place_name, ";
$sql .= "pl.place_address, ";
$sql .= "pl.place_details, ";
$sql .= "pl.place_image, ";
$sql .= "pl.gallery_id, ";
$sql .= "rbs.status_description, ";
$sql .= "py.payment_id, ";
$sql .= "py.payment_amount, ";
$sql .= "py.payment_quantity, ";
$sql .= "py.payment_status, ";
$sql .= "py.payment_total, ";
$sql .= "h.hotel_name, ";
$sql .= "h.hotel_details, ";
$sql .= "f.flight_number, ";
$sql .= "f.date, ";
$sql .= "a.airline_name ";
$sql .= "FROM `bookings` as b ";
$sql .= "INNER JOIN ";
$sql .= "`packages` as p ";
$sql .= "ON ";
$sql .= "b.package_id = p.package_id ";
$sql .= "INNER JOIN ";
$sql .= "`places` as pl ";
$sql .= "ON ";
$sql .= "p.place_id = pl.place_id ";
$sql .= "INNER JOIN ";
$sql .= "`payments` as py ";
$sql .= "ON ";
$sql .= "b.booking_id = py.booking_id ";
$sql .= "INNER JOIN `ref_booking_status` as rbs ";
$sql .= "ON ";
$sql .= "b.status_code = rbs.status_code ";
$sql .= "LEFT JOIN ";
$sql .= "`hotels` as h ";
$sql .= "ON ";
$sql .= "h.hotel_id = p.package_hotel ";
$sql .= "LEFT JOIN ";
$sql .= "`flight_schedules` as f ";
$sql .= "ON ";
$sql .= "f.flight_id = b.flight_id ";
$sql .= "LEFT JOIN ";
$sql .= "`airlines` as a ";
$sql .= "ON ";
$sql .= "a.airline_id = f.airline ";
$sql .= "WHERE b.user_id = :user_id ";
$sql .= "AND b.booking_id = :booking_id ";
$sql .= "ORDER BY ";
$sql .= "b.date_created ";
$sql .= "DESC";

$user_id = $s->_get('id');

$booking_id = httpGet('id');

$booking = $db->row($sql, array("user_id" => $user_id, "booking_id" => $booking_id));

$sql =  "SELECT ";
$sql .= "f.flight_id, ";
$sql .= "f.flight_number, ";
$sql .= "f.flight_from, ";
$sql .= "f.flight_to, ";
$sql .= "f.date, ";
$sql .= "f.depart, ";
$sql .= "f.arrive, ";
$sql .= "f.airline, ";
$sql .= "(SELECT airline_name FROM airlines as a WHERE a.airline_id = f.airline) as airline_name, ";
$sql .= "f.date_created, ";
$sql .= "(SELECT airport_location FROM airports as a WHERE a.airport_id = f.flight_from) as flight_from_location, ";
$sql .= "(SELECT airport_location FROM airports as a WHERE a.airport_id = f.flight_to) as flight_to_location ";
$sql .= "FROM ";
$sql .= "flight_schedules as f ";
$sql .= "WHERE ";
$sql .= "f.flight_from = :flight_from ";
$sql .= "AND ";
$sql .= "f.flight_to = :flight_to ";
$sql .= "AND ";
$sql .= "f.date BETWEEN ";
$sql .= ":start AND :end";

$available_flights = $db->rows($sql,
    array("flight_from" => $booking['package_from'],
            "flight_to" => $booking['package_to'],
            "start" => $booking['package_start'],
            "end" => $booking['package_end']
            )
);

?>
<div class="aligner login-wrapper m-t-50">
    <div class="aligner-item">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Rebooking form</h3>
            </div>
            <div class="panel-body">
                <?php if(httpGet('error') == 'rebook') : ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Rebooked.
                </div>
                <?php endif; ?>
                <form action="<?=$config['url']['base_path']?>/rebook.php?action=rebook&id=<?=$booking['booking_id']?>" method="POST" data-toggle="validator" role="form">
                    <input type="hidden" name="flight_id" id="flight_id" value="" />
                    <input type="hidden" name="booking_id" value="<?=$booking['booking_id']?>" />
                    <div class="form-group">
                        <label for="firstname" class="control-label">Package Name</label>
                        <label class="form-control"><?=$booking['package_name']?></label>
                    </div>
                    <div class="form-group">
                        <label for="firstname" class="control-label">Current Booking Date</label>
                        <label class="form-control"><?=date_format(date_create($booking['date_of_booking']), "F d, Y")?></label>
                    </div>
                    <div class="form-group">
                        <label for="">Rebooking Date</label>
                        <select id="available-flights" class="form-control" name="date" required>
                            <option value="">--Select from available flights--</option>
                        <?php foreach ($available_flights as $flight): ?>
                            <option value="<?=$flight['date']?>" data-flight-id="<?=$flight['flight_id']?>"><?=date_format(date_create($flight['date']),"F d, Y")?> [<?=$flight['depart']?> | <?=$flight['arrive']?>]</option>
                        <?php endforeach ?>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" data-error="You must aggree to terms and conditions." required> Agree to terms and conditions.
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                                        <div class="form-group">
                        <div class="checkbox">
                            <label>
                                Additional payment will be applied.
                            </label>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Rebook</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>