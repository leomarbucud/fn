<?php

$s = new Session;

function updatePost($text, $postId, $userId) {

    $db = new DB;
    $sql =  "UPDATE `posts` ";
    $sql .= "SET ";
    $sql .= "`post_text` = :text "; 
    $sql .= "WHERE ";
    $sql .= "`user_id` = :user_id ";
    $sql .= "AND `post_id` = :post_id ";

    return $db->query($sql,
            array("text" => $text,
                "user_id" => $userId,
                "post_id" => $postId));

}

function removePost($postId, $userId) {

    $db = new DB;
    $sql =  "DELETE FROM `posts` ";
    $sql .= "WHERE ";
    //$sql .= "`user_id` = :user_id ";
    $sql .= "`post_id` = :post_id ";

    return $db->query($sql,
                array("post_id" => $postId));

}

if(httpGet('action') == 'update') {

    $text = httpPost('text');
    $postId = httpPost('post_id');
    $userId = $s->_get('id');

    $text = preg_replace("/(\r\n){3,}/","\r\n\r\n",trim($text));

    $result = updatePost($text, $postId, $userId);

    if($result) {
        $save = true;
    }

} elseif(httpGet('action') == 'delete') {
    $postId = httpGet('post');
    $userId = $s->_get('id');

    $result = removePost($postId, $userId);

    if($result) {
        $delete = true;
        $returnUrl = httpGet('rUrl');
        header("location: {$returnUrl}");
    }
}