<?php


function update() {

    $db = new DB;

    $name = httpPost('name');
    $desc = httpPost('description');
    $gallery_id = httpPost('gallery_id');
    $images = httpPost('image');


    $sql =  "UPDATE `galleries` ";
    $sql .= "SET ";
    $sql .= "`gallery_name` = :name, ";
    $sql .= "`gallery_description` = :desc ";
    $sql .= "WHERE ";
    $sql .= "`gallery_id` = :gallery_id";

    $g = $db->query($sql, array("name" => $name, "desc" => $desc, "gallery_id" => $gallery_id));

    $sql = "DELETE FROM `images` WHERE `image_id` = :image_id";

    $i = true;
    if($images) {
        foreach($images as $image) {
            $del = $db->query($sql, array("image_id" => $image));
            if($del) {
                $i = true;
            } else {
                $i = false;
            }
        }
    }

    return $g && $i;

}

if(httpPost('action') == 'update' ) {
    if(update()) {
        $update = true;
    }
}