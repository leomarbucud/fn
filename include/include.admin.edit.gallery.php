<?php 
$s = new Session;
$db = new DB;
$gallery_id = httpGet('gallery_id');

$sql = "SELECT * FROM `galleries` WHERE `gallery_id` = :gallery_id";

$gallery = $db->row($sql, array("gallery_id" => $gallery_id));

if(!$gallery) {
    header("location: {$config['url']['base_path']}/gallery.php");
}

function getImages($gallery_id) {
    $db = new DB;
    $sql = "SELECT * FROM `images` WHERE `gallery_id` = :gallery";
    return $db->rows($sql, array("gallery" => $gallery_id));
}
$images = getImages($gallery['gallery_id']);

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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit Gallery</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?=$config['url']['base_path']?>/gallery.php?action=update" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="gallery_id" value="<?=$gallery['gallery_id']?>" />
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?=$gallery['gallery_name']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Description</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="description" class="form-control" id="description" placeholder="Description" value="<?=$gallery['gallery_description']?>" required>
                                    </div>
                                </div>
                            </div>
                            <div>
                            <strong>Select image to delete</strong>
                            <?php foreach ($images as $image) : ?>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="image[]" value="<?=$image['image_id']?>">
                                        <img src="<?=$config['url']['gallery']?>/<?=$image['image_hash']?>" style="width: 70px;" class="" />
                                    </label>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>