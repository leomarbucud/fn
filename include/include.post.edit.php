<?php 
$s = new Session; 

function getPost($userId, $postId) {
    global $config;
    $db = new DB;
    $post_per_page = $config['post']['post_per_page'];
    $page = httpGet('page');
    $sql  = "SELECT ud.user_id, ud.firstname, ud.lastname, ud.profile, p.post_id, p.post_text, p.location, p.lat, p.lng, p.post_images, p.post_metas, p.post_created, ";
    $sql .= "(SELECT `media_hash` FROM `medias` as m WHERE m.post_id = p.post_id) as media_hash, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id) as hearts, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 1) as hearts_1, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 2) as hearts_2, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 3) as hearts_3, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 4) as hearts_4, ";
    $sql .= "(SELECT COUNT(hearts_id) FROM `hearts` as h WHERE h.post_id = p.post_id AND h.hearts_rating = 5) as hearts_5, ";
    $sql .= "(SELECT CASE WHEN COUNT(*) > 0 THEN `hearts_rating` ELSE FALSE END FROM `hearts` as h WHERE h.post_id = p.post_id AND h.user_id = :userId) as hearts_given, ";
    $sql .= "CASE WHEN ud.user_id = :uId THEN TRUE ELSE FALSE END as my_post ";
    $sql .= "FROM `posts` as p LEFT JOIN `users` as u ";
    $sql .= "ON p.user_id = u.id ";
    $sql .= "INNER JOIN `user_details` ud ";
    $sql .= "ON ud.user_id = u.id ";
    $sql .= "WHERE ";
    $sql .= "p.post_id = :post_id ";
    return $db->row($sql, Array("userId" => $userId, "uId" => $userId, "post_id" => $postId));
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
    $sql .= "LIMIT 3";

    return $db->rows($sql, array("postId" => $postId));
}

$post = getPost($s->_get('id'), httpGet('post'));
if(!$post){
    header("location: {$config['url']['base_path']}");
} elseif( $s->_get('id') != $post['user_id']) {
    header("location: {$config['url']['base_path']}");
}
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="col-md-9">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="news-feed">
                <div class="status-box">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object img-circle" src="<?=$config['url']['profile_pic']?>/<?=$post['profile']?>" width="50" height="50" />
                        </div>
                        <div class="media-body">
                            <form action="<?=$config['url']['base_path']?>/post.php?action=update&type=post&post=<?=$post['post_id']?>" method="POST" data-toggle="validator" role="form">
                                <input type="hidden" name="post_id" value="<?=$post['post_id']?>" /> 
                                <div class="panel panel-default">
                                    <div class="image">
                                        <img class="" src="<?=$config['url']['base_path']?>/media.php?hash=<?=$post['media_hash']?>&type=post" data-action="zoom"/>
                                    </div>
                                    <div class="panel-body">
                                        <textarea class="box" id="text" name="text" placeholder="Share your travels..." required><?=$post['post_text']?></textarea>
                                    </div>
                                    <div class="panel-footer">
                                        <button type="submit" class="btn btn-success btn-sm">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-3 right-side">
            <div class="panel panel-default">
                <div id="location-map"></div>
                <div class="panel-body">
                    <span class="location"></span>
                </div>
            </div>
             <div class="panel panel-default">
                <div class="panel-body">
                    <label>Nearby Places <small>(within)</small></label>
                    <form action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="GET">
                        <select class="form-control" name="radius" id="radius">
                            <option value="1000" <?=httpGet('radius')==1000?'selected':''?>>1km</option>
                            <option value="5000" <?=httpGet('radius')==5000?'selected':''?>>5km</option>
                            <option value="10000" <?=httpGet('radius')==10000?'selected':''?>>10km</option>
                            <option value="15000" <?=httpGet('radius')==15000?'selected':''?>>15km</option>
                        </select>
                    </form>
                </div>
                <div class="list-group nearby"></div>
            </div>
        </div>
    </div>
</div>