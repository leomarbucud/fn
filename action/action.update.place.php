<?php

function save($media) {

	$db = new DB;

	$name = httpPost('name');
	$address = httpPost('address');
	$details = httpPost('details');
	$gallery = httpPost('gallery');
    $id = httpPost('place_id');

    $sql =  "UPDATE `places` ";
    $sql .= "SET ";
    $sql .= "`place_name` = :name, ";
    $sql .= "`place_address` = :address, ";
    $sql .= "`place_details` = :details, ";
    if(!empty($media)) {
        $sql .= "`place_image` = :image, ";
    }
    $sql .= "`gallery_id` = :gallery ";
    $sql .= "WHERE ";
    $sql .= "`place_id` = :id";
	
    $params = array("name" => $name,
                    "address" => $address,
                    "details" => $details,
                    "gallery" => $gallery,
                    "id" => $id   
                            );
    if(!empty($media)) {
        $params['image'] = $media;
    }

	return $db->query($sql, $params);

}

function update() {
    $upload = new Upload;
    $s = new Session;
    global $config;
    if (!empty($_FILES['placeImage']['name']))
    {

        $upload->fix_file_array($_FILES['placeImage']);

        $file = $_FILES['placeImage'];

        $date                = date('d M Y H:i:s');
        $mediaHash = strtotime($date).'_'.md5($file['name']);

        $img_dest            = '/assets/images/uploads/places/'.$mediaHash;
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
                    return save($mediaHash.'.'.$upload->ext);
                   
                }
            }
        }
    } else {
        return save(null);
    }
}


if(httpGet('action') == 'update' ) {

	if(update()) {
        $update = true;
    }

}