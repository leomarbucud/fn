<?php 
$s = new Session; 
$uid = $s->_get('id');
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

$post = getPost($uid, httpGet('post'));
if(!$post){
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
                <?php if(isset($save)) : if($save == true):  ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Post updated.
                </div>
                <?php endif; endif;?>
                <div class="post-list">
                    <div class="media post feed" data-post-id="<?=$post['post_id']?>">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="<?=$config['url']['profile_pic']?>/<?=$post['profile']?>" width="50" height="50" />
                            </a>
                        </div>
                        <div class="media-body">
                            <?php if($uid == $post['user_id']): ?>
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle" id="p-a" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="p-a">
                                    <li><a href="<?=$config['url']['base_path']?>/post.php?action=edit&type=post&post=<?=$post['post_id']?>">Edit Post</a></li>
                                    <li><a href="<?=$config['url']['base_path']?>/post.php?action=delete&type=post&post=<?=$post['post_id']?>&rUrl=<?=$_SERVER['REQUEST_URI']?>">Remove Post</a></li>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <h4 class="name"><a href="#"><?=$post['firstname']?> <?=$post['lastname']?></a></h4>
                            <label class="my-location"><span class="glyphicon glyphicon-map-marker"></span> <?=$post['location']?></label>
                            <span class="moment" data-toggle="moment" data-time="<?=$post['post_created']?>" ><?=$post['post_created']?></span>
                            <div class="image">
                                <img class="" src="<?=$config['url']['base_path']?>/media.php?hash=<?=$post['media_hash']?>&type=post" data-action="zoom"/>
                            </div>
                            <p><?=nl2br(trim($post['post_text']))?></p>
                            <span class="likes">
                            <?php if($post['hearts'] > 1 ): ?>
                                <?=$post['hearts']?> likes
                            <?php else: ?>
                                <?=$post['hearts']?> like
                            <?php endif; ?>
                            </span>
                            <hr>
                            <div class="actions">
                                <form class="add-comment" action="<?=$config['url']['base_path']?>/action/action.comment.php" data-toggle="validator" data-post-id="<?=$post['post_id']?>">
                                    <input type="hidden" name="post_id" value="<?=$post['post_id']?>" />
                                    <input type="text" name="comment" class="form-control comment-box" placeholder="Write comment..." required/>
                                </form>
                                <a data-toggle="like" data-post-id="<?=$post['post_id']?>" class="favorite <?=($post['hearts_given']?'red':'')?>">
                                    <span class="glyphicon glyphicon-heart<?=($post['hearts_given']?'':'-empty')?>"></span>
                                </a>
                                <?php /*<div class="like-btn">
                                    <div class="reaction-box">
                                        <div class="reaction-icon angry" data-rating="1" data-post-id="<?=$post['post_id']?>">
                                            <label>Angry</label>
                                        </div>
                                        <div class="reaction-icon sad" data-rating="2" data-post-id="<?=$post['post_id']?>">
                                            <label>Sad</label>
                                        </div>
                                        <div class="reaction-icon wow" data-rating="3" data-post-id="<?=$post['post_id']?>">
                                            <label>Wow</label>
                                        </div>
                                        <div class="reaction-icon haha" data-rating="4" data-post-id="<?=$post['post_id']?>">
                                            <label>Haha</label>
                                        </div>
                                         <div class="reaction-icon love" data-rating="5" data-post-id="<?=$post['post_id']?>">
                                            <label>Love</label>
                                        </div>
                                        <div class="reaction-icon like" data-rating="6" data-post-id="<?=$post['post_id']?>">
                                            <label>Like</label>
                                        </div>
                                    </div>
                                </div> */ ?>
                            </div>
                            <hr>
                            <div class="comments-cont" data-post-id="<?=$post['post_id']?>">
                                <?php foreach(getComments($post['post_id']) as $comment) :?>
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
                                <?php endforeach; ?>
                            </div>
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