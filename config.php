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


// var config
$config['var']['hash_password'] = '^#$4%9f+1^p9)M@4M)V$';

// post config
$config['post']['post_per_page'] = 5;