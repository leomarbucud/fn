<?php
require_once 'config.php';
require_once 'function/function.http.php';
require_once 'class/class.session.php';
require_once 'class/class.upload.php';
require_once 'class/class.db.php';

function save($userId, $profilemedia) {
    $db = new DB;
    $sql =  "UPDATE ";
    $sql .= "`user_details` ";
    $sql .= "SET ";
    $sql .= "`profile` = :profile ";
    $sql .= "WHERE ";
    $sql .= "`user_id` = :userId";
    return $db->query($sql, array("profile" => $profilemedia, "userId" => $userId));
}

function updateSession() {
    $s = new Session;
    $db = new DB;
    $sql =  "SELECT ";
    $sql .= "u.username, ";
    $sql .= "u.password, ";
    $sql .= "u.level, ";
    $sql .= "ud.user_id, ";
    $sql .= "ud.lastname, ";
    $sql .= "ud.firstname, ";
    $sql .= "ud.middlename, ";
    $sql .= "ud.address, ";
    $sql .= "ud.birthdate, ";
    $sql .= "ud.gender, ";
    $sql .= "ud.bio, ";
    $sql .= "ud.profile ";
    $sql .= "FROM ";
    $sql .= "`users` as u ";
    $sql .= "INNER JOIN ";
    $sql .= "`user_details` as ud ";
    $sql .= "ON u.id = ud.user_id ";
    $sql .= "WHERE u.id = :id";
    $data = $db->row($sql, Array("id" => $s->_get('id')));
    
	$s->_set('user', $data);
}

function upload() {
    $upload = new Upload;
    $s = new Session;
    global $config;
    if (isset($_FILES['profileImg']))
    {
        $upload->fix_file_array($_FILES['profileImg']);

        $file = $_FILES['profileImg'];

        $date                = date('d M Y H:i:s');
        $mediaHash = strtotime($date).'_'.$s->_get('id').'_'.md5($file['name']);

        $img_dest            = '/assets/images/uploads/profiles/'.$mediaHash;
        $upload->name        = $file['name'];
        $upload->destination = $config['url']['root'].$img_dest;
        $upload->tmp_name    = $file['tmp_name'];
        $formats             = array('jpg','jpeg','gif','png');


        if( $upload->set_format($formats) == TRUE )
        {
            if( file_exists($upload->destination.'.'.$upload->ext) )
            {
                //return 'Sorry! '.$file['name'].' already exists.';
                return null;
            }
            else
            {
                $image_file = $upload->destination.'.'.$upload->ext;
                $img_dest .= '.'.$upload->ext;

                if($upload->submit()) {

                    list($w_orig, $h_orig) = getimagesize($image_file);

                    $w_set = 500;
                    $h_set = 500;

                    //if ($w_orig >= $w_set OR $h_orig >= $h_set) {
                        $upload->resize_image(
                            $image_file,
                            $image_file,
                            $w_set,
                            $h_set,
                            $upload->ext
                        );
                   // }
                   
                    save($s->_get('id'), $mediaHash.'.'.$upload->ext);
                    $media["hash"] = $mediaHash;
                    $media['ext'] = $upload->ext;
                    updateSession();
                    $save = true;
                }
            }
        }
    } else {
        echo 'error';
    }
}
$action = httpGet('action');
$type = httpGet('type');

if($action == 'update' && $type == 'pic' && $_FILES) {
    upload();
}
