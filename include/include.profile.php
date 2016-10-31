<?php 
$s = new Session; 
$uid = $s->_get('id');
function getAllPosts($userId) {
    global $config;
    $db = new DB;
    $post_per_page = $config['post']['post_per_page'];
    $page = httpGet('page');
    $sql  = "SELECT ud.user_id, ud.firstname, ud.lastname, ud.profile, p.post_id, p.post_text, p.location, p.lat, p.lng, p.post_images, p.post_metas, p.post_created, p.isApproved, ";
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
    $sql .= "p.user_id = :id ";
    $sql .= "ORDER BY p.post_created DESC ";
    if($page > 1 ) {
        $sql .= "LIMIT {$post_per_page} OFFSET ".($page * $post_per_page)." ";
    } else {
        $sql .= "LIMIT {$post_per_page} ";
    }
    return $db->rows($sql, Array("userId" => $userId, "uId" => $userId, "id" => $userId));
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

$posts = getAllPosts($uid);
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="profile-banner" >
            <div class="blur-bg" style="background-image: url(<?=$config['url']['profile_pic']?>/<?=$s->_get('user')['profile']?>);"></div>
            <div class="content">
                <div class="img-cont">
                    <img class="img-circle" src="<?=$config['url']['profile_pic']?>/<?=$s->_get('user')['profile']?>" width="120" height="120" class="profile-banner-pic" />
                </div>
                <div class="nb">
                    <h2><?=$s->_get('user')['firstname']?> <?=$s->_get('user')['lastname']?></h2>
                    <div class="bio">
                        <?=$s->_get('user')['bio']?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="profile-page">
                <div class="status-box">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object img-circle" src="<?=$config['url']['base_path']?>/assets/images/uploads/profiles/<?=$s->_get('user')['profile']?>" width="50" height="50" />
                        </div>
                        <div class="media-body">
                            <form id="status-form" action="<?=$config['url']['base_path']?>/action/action.upload.php" enctype="multipart/form-data" data-toggle="validator" role="form">
                                <input type="hidden" name="lat" id="lat" />
                                <input type="hidden" name="lng" id="lng" />
                                <input type="hidden" name="loc" id="loc" />
                                <div class="panel panel-default">
                                    <div class="image-preview hide"></div>
                                    <div class="panel-body">
                                        <textarea class="box" id="text" name="text" placeholder="Share your travels..." required></textarea>
                                        <label class="my-location"><span class="glyphicon glyphicon-map-marker"></span> <span class="location">Looking where you are...</span></label>
                                    </div>
                                    <div class="panel-footer">
                                        <span class="btn btn-default btn-sm btn-file">
                                            <span class="glyphicon glyphicon-camera"></span>
                                            <input type="file" name="postImg" id="post-image" required/>
                                        </span>
                                        <button type="submit" class="btn btn-success btn-sm pull-right">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="post-list">
                    <?php foreach($posts as $post): ?>
                    <div class="media post <?=$post['isApproved'] == 0 ? 'alert alert-warning':''?>" data-post-id="<?=$post['post_id']?>">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="<?=$config['url']['profile_pic']?>/<?=$post['profile']?>" width="50" height="50" />
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="dropdown pull-right">
                                <a href="#" class="dropdown-toggle" id="p-a" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="p-a">
                                    <li><a href="<?=$config['url']['base_path']?>/post.php?action=view&type=post&post=<?=$post['post_id']?>">View Post</a></li>
                                    <?php if($uid == $post['user_id']): ?>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?=$config['url']['base_path']?>/post.php?action=edit&type=post&post=<?=$post['post_id']?>">Edit Post</a></li>
                                    <li><a href="<?=$config['url']['base_path']?>/post.php?action=delete&type=post&post=<?=$post['post_id']?>&rUrl=<?=$_SERVER['REQUEST_URI']?>">Remove Post</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>
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
                    <?php endforeach; ?>
                </div>
                <?php 
                    $page = httpGet('page');
                    if($page != null && $page > 1) {
                        $page++;
                    } else {
                        $page = 2;
                    }
                ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php if($page-1 > 1): ?>
                        <li>
                            <a href="<?=$config['url']['base_path']?>/profile.php?page=<?=$page-2?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Prev</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <?php if(count($posts) > 0): ?>
                        <li>
                            <a href="<?=$config['url']['base_path']?>/profile.php?page=<?=$page?>" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
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