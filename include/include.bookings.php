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
$sql .= "ORDER BY ";
$sql .= "b.date_created ";
$sql .= "DESC";

$user_id = $s->_get('id');

$bookings = $db->rows($sql, array("user_id" => $user_id));

$user = $s->_get('user');

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
                <?php if(isset($update_payment)) : if($update_payment) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thank you!</strong> Your booking is now on process. We will notify you once completed.
                </div>
                <?php endif; endif; ?>
                <?php if(isset($update_rebook_payment)) : if($update_rebook_payment) : ?>
                <div class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Thank you!</strong> Your rebooking is now on process. We will notify you once completed.
                </div>
                <?php endif; endif; ?>
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
                                <td rowspan="2" width="150">
                                    <img src="<?=$config['url']['places']?>/<?=$booking['place_image']?>" alt="<?=$package['place_name']?>" style="width: 100%;" data-action="zoom">
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
                                        <?php if($booking['payment_status'] != 1): ?>
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="business" value="admin@footnote.com">
                                            <input type="hidden" name="currency_code" value="PHP">
                                            <input type="hidden" name="item_number" value="<?=$booking['booking_id']?>">
                                            <input type="hidden" name="item_name" value="<?=$booking['package_name']?>">
                                            <input type="hidden" name="amount" value="<?=money_format('%i', $booking['payment_total'])?>">
                                            <input type="hidden" name="return" value="<?=$config['url']['site'].$config['url']['base_path']?>/bookings.php?booking_id=<?=$booking['booking_id']?>&payment_id=<?=$booking['payment_id']?>&status=1">
                                            <input type="hidden" name="cancel_return" value="<?=$config['url']['site'].$config['url']['base_path']?>/bookings.php?booking_id=<?=$booking['booking_id']?>&status=0">

                                            <!-- user info prefill paypal -->
                                            <input type="hidden" name="first_name" value="<?=$user['firstname']?>">
                                            <input type="hidden" name="last_name" value="<?=$user['lastname']?>">
                                            <input type="hidden" name="address1" value="<?=$user['address']?>">
                                            <input type="hidden" name="email" value="<?=$user['email']?>">
                                            <small>Pay now with</small>
                                            <input type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal - The safer, easier way to pay online">
                                            <img alt="" width="1" height="1"
                                            src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                        </form>
                                        <form action="<?=$config['url']['site'].$config['url']['base_path']?>/bookings.php?booking_id=<?=$booking['booking_id']?>&payment_id=<?=$booking['payment_id']?>&status=1" method="POST">
                                          <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_50wHWiEaH2XMl1x32R4i0XXM"
                                            data-amount="<?=(($booking['payment_total'] / 1 ) * 100)?>"
                                            data-name="Footnote"
                                            data-description="<?=$booking['package_name']?>"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-currency="PHP "
                                            data-locale="en-PH">
                                          </script>
                                          <?=$booking['payment_total']?>
                                        </form>
                                        <small><a href="<?=$config['url']['base_path']?>/howtopay.php">How to pay?</a></small>
                                        <?php endif; ?>
                                        <?php if($rebook): ?>
                                        <hr>
                                        Rebooking fee: <h4><span class="label label-success">PHP <?=money_format('%i', $rebook['rebook_amount'])?></span></h4>
                                        <?php if($rebook['rebook_status'] == 1 ): ?>
                                            <small>PAID</small>
                                        <?php endif; ?>
                                        <?php if($rebook['rebook_status'] != 1 ): ?>
                                        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="business" value="admin@footnote.com">
                                            <input type="hidden" name="currency_code" value="PHP">
                                            <input type="hidden" name="item_number" value="<?=$rebook['booking_id']?>">
                                            <input type="hidden" name="item_name" value="<?=$booking['package_name']?>">
                                            <input type="hidden" name="amount" value="<?=money_format('%i', $rebook['rebook_amount'])?>">
                                            <input type="hidden" name="return" value="<?=$config['url']['site'].$config['url']['base_path']?>/bookings.php?booking_id=<?=$rebook['booking_id']?>&rebook_id=<?=$rebook['rebook_id']?>&status=1">
                                            <input type="hidden" name="cancel_return" value="<?=$config['url']['site'].$config['url']['base_path']?>/bookings.php?booking_id=<?=$rebook['booking_id']?>&status=0">

                                            <!-- user info prefill paypal -->
                                            <input type="hidden" name="first_name" value="<?=$user['firstname']?>">
                                            <input type="hidden" name="last_name" value="<?=$user['lastname']?>">
                                            <input type="hidden" name="address1" value="<?=$user['address']?>">
                                            <input type="hidden" name="email" value="<?=$user['email']?>">
                                            <small>Pay now with</small>
                                            <input type="image" name="submit" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_100x26.png" alt="PayPal - The safer, easier way to pay online">
                                            <img alt="" width="1" height="1"
                                            src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
                                        </form>
                                        <small><a href="<?=$config['url']['base_path']?>/howtopay.php">How to pay?</a></small>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td><h4><span class="label label-<?=$tr_class?>"><?=$booking['status_description']?></span></h4></td>
                            </tr>
                            <tr class="<?=$tr_class?>">
                                <td>
                                   Personal Note: <br>
                                   <small><?=($booking['note'] != '' ? $booking['note'] : 'N/A')?></small>
                                   <br/>
                                   <?php if($booking['seat'] == 1 ): ?>
                                        <small>You requested to seat next to window</small>
                                   <?php endif; ?>
                                </td>
                                <td colspan="2">
                                    <strong>Flight no.</strong> : <small><?=($booking['flight_number'] != '' ? $booking['flight_number'] : 'N/A')?></small>
                                    <br>
                                    <strong>Airline</strong> : <small><?=($booking['airline_name'] != '' ? $booking['airline_name'] : 'N/A')?></small>
                                    <br>
                                    <strong>Hotel</strong> : <small><?=($booking['hotel_name'] != '' ? $booking['hotel_name'] : 'N/A')?></small>
                                    <br>
                                    <strong>Hotel details and notes</strong> : <small><?=($booking['hotel_details'] != '' ? $booking['hotel_details'] : 'N/A')?></small>
                                </td>
                               
                                <td>
                                <?php if($booking['status_code'] != 4 ) : ?>
                                    <button class="btn btn-danger" data-status-code="4" data-booking-id="<?=$booking['booking_id']?>" data-action="cancel-booking">Cancel</button>
                                <?php endif; ?>
                                <?php if($booking['status_code'] == 3): ?>
                                    <a href="<?=$config['url']['base_path']?>/rebook.php?id=<?=$booking['booking_id']?>" class="btn btn-success">Rebook</a>
                                <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if(count($bookings) == 0 ): ?>
                    <div class="alert alert-info">You have no bookings</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>