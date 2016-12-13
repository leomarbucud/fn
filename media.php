<?php

require_once 'config.php';

require_once 'function/function.http.php';

require_once 'class/class.session.php';
require_once 'class/class.db.php';

$type = httpGet('type');
$hash = httpGet('hash');

function getImage($hash) {
    $db = new DB;
    $sql  = "SELECT `media_id`, `post_id`, `media_hash`, `media_ext`, `media_created` ";
    $sql .= "FROM `medias` ";
    $sql .= "WHERE `media_hash` = :hash";

    return $db->row($sql, Array("hash" => $hash));
}

$img = getImage($hash);

switch( $img['media_ext'] ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    default:
}

header('Content-type: ' . $ctype);
echo file_get_contents($config['url']['site'].$config['url']['post_pic'].'/'.$img["media_hash"].'.'.$img["media_ext"]);