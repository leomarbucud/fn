<?php

$db = new DB;

$sql =  "SELECT ";
$sql .= "p.package_name, ";
$sql .= "p.place_id, ";
$sql .= "p.package_price, ";
$sql .= "p.package_details, ";
$sql .= "g.place_image, ";
$sql .= "g.place_name  ";
$sql .= "FROM ";
$sql .= "`packages` as p ";
$sql .= "LEFT JOIN ";
$sql .= "`places` as g ";
$sql .= "ON ";
$sql .= "g.place_id = p.place_id ";

$packages = $db->rows($sql);


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
                    			<th>Destination</th>
                                <th>Price</th>
                    			<th>Other Details</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tbody>
                    	<?php foreach($packages as $package): ?>
                    		<tr>
                    			<td>
                    				<img src="<?=$config['url']['places']?>/<?=$package['place_image']?>" class="thumbnail" style="max-width: 100px;" data-action="zoom" />
                    			</td>
                    			<td>
                    				<?=$package['package_name']?>
                    			</td>
                    			<td>
                    				<?=$package['place_name']?>
                    			</td>
                    			<td>
                    				<?=$package['package_price']?>
                    			</td>
                    			<td>
                    				<?=$package['package_details']?>
                    			</td>
                    			<td>
                    				<a href="<?=$config['url']['base_path']?>/places.php?action=edit&place_id=<?=$packages['package_id']?>" >Edit</a> | <a href="">Delete</a>
                    			</td>
                    		</tr>
                    	<?php endforeach;?>
                    	</tbody>
                    </table>
                </div>
                <a href="<?=$config['url']['base_path']?>/packages.php?action=add" class="btn btn-sucess">Add package</a>
            </div>
        </div>
    </div>
</div>