<?php 
$s = new Session; 

function getAllPosts($userId) {
    global $config;
    $db = new DB;
    $post_per_page = $config['post']['post_per_page'];
    $page = httpGet('page');
    $sql  = "SELECT ud.user_id, ud.firstname, ud.lastname, ud.profile, p.post_id, p.post_text, p.post_images, p.post_metas, p.post_created, ";
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

$posts = getAllPosts($s->_get('id'));
?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <div class="col-md-12 profile-actions">
            <ul>
                <li><a href="<?=$config['url']['base_path']?>"><span class="glyphicon glyphicon-home"></span> News Feed</a></li>
                <li class="active"><a href="<?=$config['url']['base_path']?>/profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Messages</a></li>
            </ul>
            <h4>Account Settings</h4>
            <ul>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=info"><span class="glyphicon glyphicon-pencil"></span> Edit Account</a></li>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=security"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
                <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=pic"><span class="glyphicon glyphicon-camera"></span> Change Profile Picture</a></li>
            </ul>
        </div>
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
                                <div class="panel panel-default">
                                    <div class="image-preview hide"></div>
                                    <div class="panel-body">
                                        <textarea class="box" id="text" name="text" placeholder="Share your travels..." required></textarea>
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
                    <div class="media post" data-post-id="<?=$post['post_id']?>">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle" src="<?=$config['url']['profile_pic']?>/<?=$post['profile']?>" width="50" height="50" />
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="name"><a href="#"><?=$post['firstname']?> <?=$post['lastname']?></a></h4>
                            <span class="moment" data-toggle="moment" data-time="<?=$post['post_created']?>" ><?=$post['post_created']?></span>
                            <div class="image">
                                <img class="" src="<?=$config['url']['base_path']?>/media.php?hash=<?=$post['media_hash']?>&type=post" data-action="zoom"/>
                            </div>
                            <p><?=$post['post_text']?></p>
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
                <?php if($page-1 > 1): ?>
                <a href="<?=$config['url']['base_path']?>/profile.php?page=<?=$page-2?>">Previous</a>
                <?php endif; ?>
                <?php if(count($posts) > 0): ?>
                <a href="<?=$config['url']['base_path']?>/profile.php?page=<?=$page?>" class="pull-right">Next</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-md-3">
            <?php //var_dump(getAllPosts($s->_get('id'))); ?>
        </div>
    </div>
</div>