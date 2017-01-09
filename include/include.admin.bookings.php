<?php 
$s = new Session;
$db = new DB;

$status_code = 1;
if(httpGet('status')) {
    $status_code = httpGet('status');
}

$name = httpGet('name');

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
$sql .= "p.package_hotel, ";
$sql .= "p.package_transportation, ";
$sql .= "pl.place_name, ";
$sql .= "pl.place_address, ";
$sql .= "pl.place_details, ";
$sql .= "pl.place_image, ";
$sql .= "pl.gallery_id, ";
$sql .= "rbs.status_description, ";
$sql .= "py.payment_id, ";
$sql .= "py.payment_amount, ";
$sql .= "py.payment_quantity, ";
$sql .= "py.payment_total, ";
$sql .= "py.payment_status, ";
$sql .= "ud.firstname, ";
$sql .= "ud.lastname, ";
$sql .= "ud.contact, ";
$sql .= "ud.address, ";
$sql .= "ud.user_id, ";
$sql .= "u.email, ";
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
$sql .= "INNER JOIN ";
$sql .= "`ref_booking_status` as rbs ";
$sql .= "ON ";
$sql .= "b.status_code = rbs.status_code ";
$sql .= "INNER JOIN ";
$sql .= "`user_details` as ud ";
$sql .= "ON ";
$sql .= "ud.user_id = b.user_id ";
$sql .= "INNER JOIN ";
$sql .= "`users` as u ";
$sql .= "ON ";
$sql .= "u.id = b.user_id ";
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
$sql .= "WHERE (";
$sql .= "ud.lastname LIKE '%{$name}%' ";
$sql .= "OR ";
$sql .= "ud.firstname LIKE '%{$name}%' )";
if($status_code != 'all') {
    $sql .= "AND ";
    $sql .= "b.status_code = :status_code ";
}
$sql .= "ORDER BY ";
$sql .= "b.date_created ";
$sql .= "DESC";

$user_id = $s->_get('id');
$params = array();
if($status_code != 'all') {
    $params['status_code'] = $status_code;
}

$bookings = $db->rows($sql, $params);

$sql = "SELECT * FROM `ref_booking_status`";

$statuses = $db->rows($sql);

function checkRebook($booking_id) {
    $db = new DB;

    $sql = "SELECT ";
    $sql .= "* ";
    $sql .= "FROM ";
    $sql .= "`rebook` ";
    $sql .= "WHERE ";
    $sql .= "`booking_id` = :booking_id";

    $rebook = $db->row($sql, array("booking_id" => $booking_id));
    return $rebook;
}

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
                <form class="form-inline">
                    <div class="form-group">
                        <label>View: </label>
                        <select name="status" onchange="window.location.href = '<?=$config['url']['base_path']?>/admin.bookings.php?status=' + this.value;" class="form-control">
                            <?php foreach ($statuses as $status) : ?>
                            <option value="<?=$status['status_code']?>" <?=$status_code==$status['status_code']?'selected':''?> ><?=$status['status_description']?></option>
                            <?php endforeach; ?>
                            <option value="all"  <?=$status_code=='all'?'selected':''?> >All</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Search by name:</label>
                        <input class="form-control" placeholder="Name" name="name" value="<?=httpGet('name')?>" />
                    </div>
                </form>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Bookings</h3>
                    </div>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>BID</th>
                                <th>User</th>
                                <th width="250">Package Name</th>
                                <th>Destination</th>
                                <th>Date Booked</th>
                                <th width="150">Amount</th>
                                <th>Status 
                                    <span class="glyphicon glyphicon-question-sign" data-toggle="tooltip" title="Select from the options to change booking status."></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <?php
                                $tr_class = '';
                                switch ($booking['status_code']) {
                                    case 1:
                                        $tr_class = 'warning';
                                        break;
                                    case 2 :
                                        $tr_class = 'info';
                                        break;
                                    case 3:
                                    case 5:
                                        $tr_class = 'success';
                                        break;
                                    case 4  :
                                        $tr_class = 'danger';
                                        break;
                                    default:
                                        
                                        break;
                                }
                            ?>
                            <tr class="<?=$tr_class?>">
                                <td rowspan="2" style="text-align: center; vertical-align: middle;">
                                    <?=$booking['booking_id']?>
                                </td>
                                <td rowspan="2">
                                    <strong>Name: </strong>
                                    <span><?=$booking['firstname']?> <?=$booking['lastname']?></span>
                                    <br>
                                    <strong>Contact No: </strong>
                                    <span><?=$booking['contact']?></span>
                                    <br>
                                    <strong>Email: </strong>
                                    <span><?=$booking['email']?></span>
                                    <br>
                                    <strong>Address: </strong>
                                    <span><?=$booking['address']?></span>
                                </td>
                                <td><?=$booking['package_name']?></td>
                                <td><?=$booking['place_name']?></td>
                                <td>
                                    <?=date_format(date_create($booking['date_of_booking']), "F d, Y")?>
                                    <?php $rebook = checkRebook($booking['booking_id']); ?>
                                    <?php if($rebook) : ?>
                                        <br/>
                                        Rebooked date: <?=date_format(date_create($rebook['rebook_date']), "F d, Y")?>
                                    <?php endif; ?>
                                </td>
                                <td rowspan="2" style="text-align: right;">
                                    <div style="position: relative;">
                                            PHP <?=money_format('%i', $booking['payment_amount'])?> <br>
                                         x <?=$booking['payment_quantity']?> <br>
                                        <h4><span class="label label-success">PHP <?=money_format('%i', $booking['payment_total'])?></span></h4>
                                        <br>
                                        <?php if($booking['payment_status'] == 1) : ?>
                                            <p class="flag"><span class="flag-text">PAID</span></p>
                                        <?php endif; ?>
                                        <?php if($rebook): ?>
                                        <hr>
                                        Rebooking fee: <h4><span class="label label-success">PHP <?=money_format('%i', $rebook['rebook_amount'])?></span></h4>
                                        <?php if($rebook['rebook_status'] == 1 ): ?>
                                            <small>PAID</small>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td rowspan="2">
                                    <select class="form-control" data-action="change-status" data-booking-id="<?=$booking['booking_id']?>">
                                        <?php foreach ($statuses as $status) : ?>
                                        <option value="<?=$status['status_code']?>" <?=$booking['status_code']==$status['status_code']?'selected':''?> ><?=$status['status_description']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="<?=$tr_class?>">
                                <td>
                                   Personal Note: <br>
                                   <small><?=($booking['note'] != '' ? $booking['note'] : 'N/A')?></small>
                                   <?php if($booking['seat'] == 1 ): ?>
                                        <small>Requested to seat next to window</small>
                                   <?php endif; ?>
                                </td>
                                <td colspan="2">
                                    <strong>Flight no.</strong> : <small><?=($booking['flight_number'] != '' ? $booking['flight_number'] : 'N/A')?></small>
                                     <br>
                                     <strong>Airline</strong> : <small><?=($booking['airline_name'] != '' ? $booking['airline_name'] : 'N/A')?></small>
                                     <br>
                                    <strong>Hotel</strong> : <small><?=($booking['hotel_name'] != '' ? $booking['hotel_name'] : 'N/A')?></small>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if(count($bookings) == 0 ): ?>
                            <tr>
                                <td colspan="7">
                                    <div class="alert alert-warning">No results</div>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>