<?php
require_once '../config.php';
require_once '../function/function.http.php';
require_once '../class/class.session.php';
require_once '../class/class.db.php';

function addComment($post_id, $comment, $userId) {
    $db = new DB;

    $sql =  "INSERT INTO `comments` ";
    $sql .= "(`post_id`, `comment_text`, `user_id`, `comment_created`) ";
    $sql .= "VALUES ";
    $sql .= "(:postId, :comment, :userId, now())";

    return $db->query($sql, array(
            "postId" => $post_id,
            "comment" => $comment,
            "userId" => $userId
    ));
}

function getComments($postId) {
    $db = new DB;
    $sql =  "SELECT ";
    $sql .= "ud.firstname, ";
    $sql .= "ud.lastname, ";
    $sql .= "ud.profile, ";
    $sql .= "c.comment_text, ";
    $sql .= "c.comment_created ";
    $sql .= "FROM ";
    $sql .= "`user_details` as ud ";
    $sql .= "INNER JOIN ";
    $sql .= "`comments` as c ";
    $sql .= "ON ";
    $sql .= "c.user_id = ud.user_id ";
    $sql .= "WHERE ";
    $sql .= "c.post_id = :postId ";
    $sql .= "ORDER BY c.comment_created ASC ";
   // $sql .= "LIMIT 3";

    return $db->rows($sql, array("postId" => $postId));
}

$s = new Session;

$comment = httpPost('comment');
$post_id = httpPost('post_id');
$userId = $s->_get('id');
// anonymouse user
if(!$userId) {
    $userId = $config['var']['anonymous_id'];
}
$comments = false;
if($comment && $post_id) {
    $result = addComment($post_id, $comment, $userId);
    if($result) {
        $comments = getComments($post_id);
    }
}

header('Content-Type: text/html; charset=utf-8');
?>
<?php if($comments) : foreach($comments as $comment) :?>
<div class="media comment">
    <div class="media-left">
        <a href="#">
            <img class="media-object img-circle" src="<?=$config['url']['base_path']?>/assets/images/uploads/profiles/<?=$comment['profile']?>" width="30" height="30" />
        </a>
    </div>
    <div class="media-body">
        <h4 class="name"><a href="#"><?=$comment['firstname']?> <?=$comment['lastname']?></a></h4>
        <span class="moment" data-toggle="moment" data-time="<?=$comment['comment_created']?>"><?=$comment['comment_created']?></span>
        <p><?=$comment['comment_text']?></p>
    </div>
</div>
<hr>
<?php endforeach; endif;?>