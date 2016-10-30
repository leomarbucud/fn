<?php
    $profile_pic = $config['var']['default_profile_pic'];
    $name = 'Anonymous User';
    $bio = '';
    if($s->_get('user')) {
        $profile_pic = $s->_get('user')['profile'];
        $name = $s->_get('user')['firstname'].' '.$s->_get('user')['lastname'];
        $bio = $s->_get('user')['bio'];
    }
?>
<div class="status-box">
    <div class="media">
        <div class="media-left">
            <img class="media-object img-circle" src="<?=$config['url']['profile_pic']?>/<?=$profile_pic?>" width="50" height="50" />
        </div>
        <div class="media-body">
            <form id="status-form" action="<?=$config['url']['base_path']?>/action/action.upload.php" enctype="multipart/form-data" data-toggle="validator" role="form">
                <input type="hidden" name="lat" id="lat" />
                <input type="hidden" name="lng" id="lng" />
                <input type="hidden" name="loc" id="loc" />
                <?php if(!$s->_get('user')) : ?>
                <input type="text" name="aname" placeholder="Name" class="form-control">
                <?php endif; ?>
                <div class="panel panel-default">
                    <div class="image-preview hide"></div>
                    <div class="panel-body">
                        <textarea class="box" id="text" name="text" placeholder="Share your travels..." required></textarea>
                        <label class="my-location" ><span class="glyphicon glyphicon-map-marker"></span> <span class="location no-selectoion" data-toggle="tooltip" data-placement="top" title="Double click to edit location" style="cursor: pointer; min-width: 300px;">Looking where you are...</span></label>
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