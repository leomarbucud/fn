<?php 
$s = new Session;
$db = new DB;

$sql =  "SELECT ";
$sql .= "b.booking_id, ";
$sql .= "b.package_id, ";
$sql .= "b.user_id, ";
$sql .= "b.status_code, ";
$sql .= "b.note, ";
$sql .= "b.date_of_booking, ";
$sql .= "p.place_id, ";
$sql .= "p.package_name, ";
$sql .= "p.package_price, ";
$sql .= "p.package_days, ";
$sql .= "p.package_person, ";
$sql .= "p.package_accomodation, ";
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
$sql .= "py.payment_total ";
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
$sql .= "WHERE b.user_id = :user_id ";
$sql .= "ORDER BY ";
$sql .= "b.date_created ";
$sql .= "DESC";

$user_id = $s->_get('id');

$bookings = $db->rows($sql, array("user_id" => $user_id));

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
                        <h3 class="panel-title">Bookings</h3>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="250">Package Name</th>
                                <th>Destination</th>
                                <th>Date Booked</th>
                                <th width="150">Amount</th>
                                <th>Status</th>
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
                                <td rowspan="2" width="150">
                                    <img src="<?=$config['url']['places']?>/<?=$booking['place_image']?>" alt="<?=$package['place_name']?>" style="width: 100%;" data-action="zoom">
                                </td>
                                <td><?=$booking['package_name']?></td>
                                <td><?=$booking['place_name']?></td>
                                <td><?=date_format(date_create($booking['date_of_booking']), "F d, Y")?></td>
                                <td rowspan="2" style="text-align: right;">PHP <?=money_format('%i', $booking['payment_amount'])?> <br>
                                     x <?=$booking['payment_quantity']?> <br>
                                    <h4><span class="label label-success">PHP <?=money_format('%i', $booking['payment_total'])?></span></h4>
                                    <br>
                                    <small><a href="<?=$config['url']['base_path']?>/howtopay.php">How to pay?</a></small>
                                </td>
                                <td><?=$booking['status_description']?></td>
                            </tr>
                            <tr class="<?=$tr_class?>">
                                <td>
                                   Personal Note: <br>
                                   <small><?=($booking['note'] != '' ? $booking['note'] : 'N/A')?></small>
                                </td>
                                <td colspan="2">
                                    <strong>Transpo</strong> : <small><?=($booking['package_transportation'] != '' ? $booking['package_transportation'] : 'N/A')?></small>
                                     <br>
                                    <strong>Accomodation</strong> : <small><?=($booking['package_accomodation'] != '' ? $booking['package_accomodation'] : 'N/A')?></small>
                                </td>
                               
                                <td>
                                <?php if($booking['status_code'] != 4 ) : ?>
                                    <button class="btn btn-danger" data-status-code="4" data-booking-id="<?=$booking['booking_id']?>" data-action="cancel-booking">Cancel</button>
                                <?php endif; ?>
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