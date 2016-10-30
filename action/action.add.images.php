<?php

function save($media, $gallery) {

	$db = new DB;

	$sql =  "INSERT INTO `images` ";
	$sql .= "(`image_hash`, `gallery_id`) ";
	$sql .= "VALUES ";
	$sql .= "(:image, :gallery) ";

	$db->query($sql, array("image" => $media,
							"gallery" => $gallery 			
							));

}

function upload() {
    $upload = new Upload;
    $s = new Session;
    global $config;
    if (isset($_FILES['galleryImages']))
    {
        $upload->fix_file_array($_FILES['galleryImages']);
        foreach ($_FILES['galleryImages'] as $index => $file)
        {
            $date                = date('d M Y H:i:s');
            $mediaHash = strtotime($date).'_'.md5($file['name']);

            $img_dest            = '/assets/images/uploads/galleries/'.$mediaHash;
            $upload->name        = $file['name'];
            $upload->destination = $config['url']['root'].$img_dest;
            $upload->tmp_name    = $file['tmp_name'];
            $formats             = array('jpg','jpeg','gif','png');


            if( $upload->set_format($formats) == TRUE )
            {
                if( file_exists($upload->destination.'.'.$upload->ext) )
                {
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
                        $data = save($mediaHash.'.'.$upload->ext, httpPost('gallery_id'));
                       
                    }
                }
            }
        }
    } else {
        $error = true;
    }
}


if(httpGet('action') == 'save_images' ) {

	upload();

}