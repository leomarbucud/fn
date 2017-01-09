<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';

$session = new Session;

if(!$session->_get('id')) {
    //header("location: {$config['url']['base_path']}");
}

include_once 'include/include.header.php';

$booking_id = httpGet('booking_id');
$payment_id = httpGet('payment_id');
$status = httpGet('status');

$rebook_id = httpGet('rebook_id');

if($booking_id && $payment_id && $status) {
	require_once 'action/action.update.payment.php';
} else if($booking_id && $rebook_id && $status) {
	require_once 'action/action.update.rebook.php';
}

include_once 'include/include.bookings.php';

include_once 'include/include.footer.php';