<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.upload.php';
require_once '../class/class.db.php';

function save($user_id, $text, $media) {
    $db = new DB;
    $postId = $user_id.'_'.strtotime(date("Y-m-d H:i:s")).microtime(true);

    $db->query("INSERT INTO `posts` (`post_id`,`user_id`,`post_text`) VALUES (:id,:user_id,:text)",
        Array("id"=>$postId,"user_id"=>$user_id,"text"=>$text));

    $mediaHash = $media["hash"];
    $mediaExt = $media["ext"];
    $db->query("INSERT INTO `medias` (`post_id`,`media_hash`,`media_ext`) VALUES (:postId, :mediaHash, :mediaExt)", Array("postId" => $postId, "mediaHash" => $mediaHash, "mediaExt" => $mediaExt));

    return $postId;
}

function create($media) {
    $s = new Session;
    $data['status'] = 'failed';
    $text = httpPost('text');

    $post_id = save($s->_get('id'),$text,$media);

    $account_details = $s->_get('user');
    $data['post_id'] = $post_id;
    $data['status'] = 'success';
    $data['text'] = $text;
    $data['account'] = $account_details;
    
    return $data;
}

function upload() {
    $upload = new Upload;
    $s = new Session;
    global $config;
    if (isset($_FILES['postImg']))
    {
        $upload->fix_file_array($_FILES['postImg']);

        $file = $_FILES['postImg'];

        $date                = date('d M Y H:i:s');
        $mediaHash = strtotime($date).'_'.$s->_get('id').'_'.md5($file['name']);

        $img_dest            = '/assets/images/uploads/posts/'.$mediaHash;
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

                    if ($w_orig >= $w_set OR $h_orig >= $h_set) {
                        $upload->resize_image(
                            $image_file,
                            $image_file,
                            $w_set,
                            $h_set,
                            $upload->ext
                        );
                    }
                   
                    $media["hash"] = $mediaHash;
                    $media['ext'] = $upload->ext;
                    $data = create($media);
                    $return['firstname'] = $data['account']['firstname'];
                    $return['lastname'] = $data['account']['lastname'];
                    $return['profile'] = $data['account']['profile'];
                    $return['post_id'] = $data['post_id'];
                    $return['post_text'] = $data['text'];
                    $return['media_hash'] = $mediaHash;
                    $return['post_created'] = date('Y-m-d H:i:s');
                    header('Content-Type: application/json');
                    echo json_encode($return);
                }
            }
        }
    } else {
        echo 'error';
    }
}

upload();