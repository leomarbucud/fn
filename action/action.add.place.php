<?php

function save($media) {

	$db = new DB;

	$name = httpPost('name');
	$address = httpPost('address');
	$details = httpPost('details');
	$gallery = httpPost('gallery');

	$sql =  "INSERT INTO `places` ";
	$sql .= "(`place_name`, `place_address`, `place_details`, `place_image`, `gallery_id`) ";
	$sql .= "VALUES ";
	$sql .= "(:name, :address, :details, :image, :gallery) ";

	$db->query($sql, array("name" => $name,
							"address" => $address,
							"details" => $details,
							"image" => $media,
							"gallery" => $gallery 			
							));

}

function upload() {
    $upload = new Upload;
    $s = new Session;
    global $config;
    if (isset($_FILES['placeImage']))
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
                    $data = save($mediaHash.'.'.$upload->ext);
                   
                }
            }
        }
    } else {
        $error = true;
    }
}


if(httpGet('action') == 'save' ) {

	upload();

}