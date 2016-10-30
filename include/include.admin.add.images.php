<?php 
$s = new Session;
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
                        <h3 class="panel-title">Add Images to <?=httpGet('gallery_name')?></h3>
                    </div>
                    <div class="panel-body">
                        <?php if(isset($save)) : if($save) : ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Successfully updated!</strong> 
                        </div>
                        <?php endif; endif; ?>
                        <div id="imagesPrev" class="hide row" ></div>
                        <form action="<?=$config['url']['base_path']?>/gallery.php?action=save_images" method="POST" data-toggle="validator" role="form" enctype="multipart/form-data">
                            <input type="hidden" name="gallery_id" value="<?=httpGet('gallery_id')?>">
                             <div class="form-group">
                                <label for="details" class="control-label">Images</label>
                                <br>
                                <span class="btn btn-default btn-sm btn-file ">
                                    <span class="glyphicon glyphicon-picture"></span> Multiple select...
                                    <input type="file" multiple name="galleryImages[]" id="galleryImages" required/>
                                </span>
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