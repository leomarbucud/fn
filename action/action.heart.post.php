<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.db.php';

function heartPost($postId, $userId, $rating) {
    $db = new DB;
    $sql = "SELECT COUNT(*) FROM `hearts` WHERE `post_id` = :postId AND `user_id` = :userId";
    $isRated = $db->single($sql, Array("postId" => $postId, "userId" => $userId));
    if($isRated > 0) {
        //$sql = "UPDATE `hearts` SET `hearts_rating` = :rating WHERE `post_id` = :postId AND `user_id` = :userId";
        $sql = "DELETE FROM `hearts` WHERE `post_id` = :postId AND `user_id` = :userId";
        $heartPost = $db->query($sql, Array("postId" => $postId, "userId" => $userId));
        $rated = false;
    } else {
        $sql = "INSERT INTO `hearts` (`post_id`,`user_id`,`hearts_rating`) VALUES (:postId, :userId, :rating)";
        $heartPost = $db->query($sql, Array("postId" => $postId, "userId" => $userId, "rating" => $rating));
        $rated = true;
    }
    if ($heartPost) {
        $sql = "SELECT p.post_id, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 1) as hearts_1, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 2) as hearts_2, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 3) as hearts_3, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 4) as hearts_4, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id AND hearts_rating = 5) as hearts_5, ";
        $sql .= "(SELECT COUNT(*) FROM `hearts` WHERE `post_id` = p.post_id) as total, ";
        $sql .= "(SELECT CASE WHEN COUNT(*) > 0 THEN `hearts_rating` ELSE FALSE END FROM `hearts` as h WHERE h.post_id = p.post_id AND h.user_id = :userId) as hearts_given ";
        $sql .= "FROM posts as p ";
        $sql .= "WHERE p.post_id = :postId";
        
        return $db->row($sql, Array("postId" => $postId, "userId" => $userId));
    }
    return false;
}

$s = new Session;

$postId = httpPost('post_id');
$rating = httpPost('rating');
$userId = $s->_get('id');

if($postId && $rating && $userId) {
    $result = heartPost($postId, $userId, $rating);
    header('Content-Type: application/json');
    echo json_encode($result);
}