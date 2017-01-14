<?php

$sql =  "SELECT * FROM `galleries`";

$galleries = $db->rows($sql);

$s = new Session;

function getImages($gallery_id) {

    global $db;

    $sql = "SELECT * FROM `images` WHERE `gallery_id` = :gallery";

    return $db->rows($sql, array("gallery" => $gallery_id));

}

?>
<div class="row-offcanvas row-offcanvas-left">
    <div id="sidebar" class="sidebar-offcanvas">
        <?php include_once 'include/include.side.bar.php'; ?>
    </div>
    <div id="main">
        <div class="col-md-12">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
            </p>
            <div class="admin-page">
                <?php if(isset($update)) : if($update) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Successfully updated!</strong> 
                </div>
                <?php endif; endif; ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Gallery</h3>
                    </div>
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                                <th>ID</th>
                    			<th>Name</th>
                    			<th>Description</th>
                                <th>Images</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	<?php foreach($galleries as $gallery): ?>
                    		<tr>
                                <td>
                                    <?=$gallery['gallery_id']?>
                                </td>
                    			<td>
                    				<?=$gallery['gallery_name']?>
                    			</td>
                    			<td>
                    				<?=$gallery['gallery_description']?>
                    			</td>
                    			<td>
                    				<?php foreach (getImages($gallery['gallery_id']) as $image) : ?>
                                        <img src="<?=$config['url']['gallery']?>/<?=$image['image_hash']?>" style="width: 50px;" class="" data-action="zoom"/>
                                    <?php endforeach; ?>
                    			</td>
                    			<td width="200">
                                    <a href="<?=$config['url']['base_path']?>/gallery.php?action=edit&gallery_id=<?=$gallery['gallery_id']?>&gallery_name=<?=$gallery['gallery_name']?>" class="btn btn-sucess">Edit</a>|<a href="" data-action="delete-gallery" data-gallery-id="<?=$gallery['gallery_id']?>" class="btn btn-sucess">Delete</a>|<a href="<?=$config['url']['base_path']?>/gallery.php?action=add_images&gallery_id=<?=$gallery['gallery_id']?>&gallery_name=<?=$gallery['gallery_name']?>" class="btn btn-sucess">Add images</a>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>
                    	</tbody>
                    </table>
                </div>
                <a href="<?=$config['url']['base_path']?>/gallery.php?action=add" class="btn btn-sucess">Add gallery</a>
            </div>
        </div>
    </div>
</div>