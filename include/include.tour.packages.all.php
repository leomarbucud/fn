<?php

$db = new DB;

$sql =  "SELECT ";
$sql .= "p.package_id, ";
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
//$sql .= "WHERE g.place_id = :place_id";

//$place_id = httpGet('place_id');

$place_packages = $db->rows($sql);//, array("place_id" => $place_id));

//$sql = "SELECT * FROM `places` WHERE `place_id` = :place_id";
//$place = $db->row($sql, array("place_id" => $place_id));

?>
<div class="m-t-50">
	<div class="container">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h1>Tour packages</h1>
				<div class="row">
					<?php foreach ($place_packages as $package) : ?>
						<div class="col-sm-12 col-md-4">
							<div class="thumbnail">
								<img src="<?=$config['url']['places']?>/<?=$package['place_image']?>" alt="<?=$package['place_name']?>" style="max-height: 220px;">
								<div class="caption">
									<h3 style="height: 52px;"><?=$package['package_name']?></h3>
									<div style="height: 70px;">
							        	<p class="block-with-text"><?=$package['package_details']?></p>
							        </div>
									<p class="lead">PHP <?=money_format('%i', $package['package_price'])?></p>
							        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?action=view_details&package_id=<?=$package['package_id']?>" class="btn btn-success btn-block" role="button">Book</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$package['place_name']?>" class="btn btn-default btn-block" role="button">View posts</a></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
						<?php if(count($place_packages) == 0) : ?>
							<div class="alert alert-info">
								<strong>Sorry!</strong> No tour packages available.
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>

	</div>
