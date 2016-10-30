<?php

// database config
$config['db']['host']     = 'localhost' ;
$config['db']['user']     = 'root' ;
$config['db']['password'] = '' ;
$config['db']['db']       = 'db_footnote' ;

// url config
$config['url']['base_path'] = '/fn';
$config['url']['site'] = 'http://localhost';
$config['url']['root'] = realpath(dirname(__FILE__));
$config['url']['profile_pic'] = $config['url']['base_path'].'/assets/images/uploads/profiles';
$config['url']['post_pic'] = $config['url']['base_path'].'/assets/images/uploads/posts';
$config['url']['places'] = $config['url']['base_path'].'/assets/images/uploads/places';
$config['url']['gallery'] = $config['url']['base_path'].'/assets/images/uploads/galleries';


// var config
$config['var']['hash_password'] = '^#$4%9f+1^p9)M@4M)V$';
$config['var']['default_profile_pic'] = '1476196571_18_41b586905e6233e72b076191f8bf9512.png';
$config['var']['anonymous_id'] = '45';

// post config
$config['post']['post_per_page'] = 5;