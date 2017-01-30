<?php

$dev = strpos($_SERVER['SERVER_NAME'], "localhost") > -1 ? true : false;

if($dev) {
	// database config local
	$config['db']['host']     = 'localhost' ;
	$config['db']['user']     = 'root' ;
	$config['db']['password'] = '' ;
	$config['db']['db']       = 'footnote' ;
} else {
	// database config server
	$config['db']['host']     = 'br-cdbr-azure-south-b.cloudapp.net' ;
	$config['db']['user']     = 'bb52bd77737f84' ;
	$config['db']['password'] = '3ca0ad99' ;
	$config['db']['db']       = 'footnote' ;
}

// checking $protocol in HTTP or HTTPS 
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') { 
	$protocol = "https"; 
} else { 
	$protocol = "http"; 
} 
// url config
$config['url']['base_path'] = strpos($_SERVER['SERVER_NAME'], "localhost") !== false ? '/fn' : '';
$config['url']['site'] = $protocol.'://'.$_SERVER['SERVER_NAME']; //'http://localhost';
$config['url']['root'] = realpath(dirname(__FILE__));
$config['url']['profile_pic'] = $config['url']['base_path'].'/assets/images/uploads/profiles';
$config['url']['post_pic'] = $config['url']['base_path'].'/assets/images/uploads/posts';
$config['url']['places'] = $config['url']['base_path'].'/assets/images/uploads/places';
$config['url']['gallery'] = $config['url']['base_path'].'/assets/images/uploads/galleries';


// var config
$config['var']['hash_password'] = '^#$4%9f+1^p9)M@4M)V$';
$config['var']['default_profile_pic'] = '1476196571_18_41b586905e6233e72b076191f8bf9512.png';
$config['var']['anonymous_id'] = '45';
$config['var']['rebook_amount'] = '1000';
$config['var']['dest_rank'] = 'user';

// post config
$config['post']['post_per_page'] = 5;

if(!function_exists('money_format')){
	function money_format($d, $n) {
		return $n;
	}
}