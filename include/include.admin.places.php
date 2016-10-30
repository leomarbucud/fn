<?php

$db = new DB;

$sql =  "SELECT * FROM `places` as p ";
$sql .= "LEFT JOIN `galleries` as g ";
$sql .= "ON g.gallery_id = p.gallery_id";

$places = $db->rows($sql);

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
                        <h3 class="panel-title">Places</h3>
                    </div>
                    <table class="table table-bordered">
                    	<thead>
                    		<tr>
                    			<th>Image</th>
                    			<th>Name</th>
                    			<th>Location</th>
                    			<th>Other Details</th>
                    			<th>Gallery</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	<?php foreach($places as $place): ?>
                    		<tr>
                    			<td>
                    				<img src="<?=$config['url']['places']?>/<?=$place['place_image']?>" class="thumbnail" style="max-width: 100px;" data-action="zoom" />
                    			</td>
                    			<td>
                    				<?=$place['place_name']?>
                    			</td>
                    			<td>
                    				<?=$place['place_address']?>
                    			</td>
                    			<td>
                    				<?=$place['place_details']?>
                    			</td>
                    			<td>
                    				<?=$place['gallery_name']?>
                    			</td>
                    			<td>
                    				<a href="<?=$config['url']['base_path']?>/places.php?action=edit&place_id=<?=$place['place_id']?>" >Edit</a> | <a href="">Delete</a>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>
                    	</tbody>
                    </table>
                </div>
                <a href="<?=$config['url']['base_path']?>/places.php?action=add" class="btn btn-sucess">Add place</a>
            </div>
        </div>
    </div>
</div>