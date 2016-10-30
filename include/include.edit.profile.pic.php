<?php 
$s = new Session; 

$user = $s->_get('user');
$user['email'] = $s->_get('email');
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
            <div class="profile-page">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Update Profile Picture</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <img id="c-pp" class="img-circle" src="<?=$config['url']['profile_pic']?>/<?=$s->_get('user')['profile']?>" width="100%"/>
                        <img id="n-pp" class="img-circle hide" src="<?=$config['url']['profile_pic']?>/<?=$s->_get('user')['profile']?>" width="100%"/>
                    </div>
                    <div class="panel-footer">
                        <form action="<?=$config['url']['base_path']?>/profile.php?action=update&type=pic" method="POST" enctype="multipart/form-data" data-toggle="validator" role="form">
                            <span class="btn btn-default btn-sm btn-file">
                                <span class="glyphicon glyphicon-camera"></span> Browse...
                                <input type="file" name="profileImg" id="profile-image" required/>
                            </span>
                            <button type="submit" class="btn btn-success btn-sm pull-right">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php //var_dump(getAllPosts($s->_get('id'))); ?>
        </div>
    </div>
</div>