<?php 
$s = new Session;
function getGalleries() {
	$db = new DB;
	$sql = "SELECT * FROM `galleries`";
	return $db->rows($sql);
}

$galleries = getGalleries();

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
                        <h3 class="panel-title">Add Place</h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <form action="<?=$config['url']['base_path']?>/places.php?action=save" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <div class="form-inline row">
                                    <div class="form-group col-sm-6">
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="" required>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="address" class="control-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="details" class="control-label">Other details</label>
                                <textarea rows="3" class="form-control" id="details" name="details" placeholder="Details"></textarea>
                            </div>
                          	 <div class="form-group">
                                <label for="details" class="control-label">Image</label>
                                <br>
                                <div id="imagePrev" class="hide" ></div>
	                            <span class="btn btn-default btn-sm btn-file ">
	                                <span class="glyphicon glyphicon-picture"></span> Select...
	                                <input type="file" name="placeImage" id="placeImage" required/>
	                            </span>
                            </div>
                             <div class="form-group">
                                <label for="details" class="control-label">Gallery</label>
	                            <select class="form-control" name="gallery" required>
                                    <option value="">--Select--</option>
                                    <?php foreach ($galleries as $gallery) : ?>
                                    <option value="<?=$gallery['gallery_id']?>"><?=$gallery['gallery_name']?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>