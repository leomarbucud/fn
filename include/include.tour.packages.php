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
$sql .= "WHERE g.place_id = :place_id";

$place_id = httpGet('place_id');

$place_packages = $db->rows($sql, array("place_id" => $place_id));

$sql = "SELECT * FROM `places` WHERE `place_id` = :place_id";
$place = $db->row($sql, array("place_id" => $place_id));

?>
<div id="wrap">
<div class="m-t-50">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Tour packages for <?=$place['place_name']?></h1>
				<div class="row">
					<?php $counter = 0; ?>
					<?php foreach ($place_packages as $package) : ?>
						<div class="col-sm-12 col-md-6">
							<div class="thumbnail">
								<img src="<?=$config['url']['places']?>/<?=$package['place_image']?>" alt="<?=$package['place_name']?>">
								<div class="caption">
									<h3><?=$package['package_name']?></h3>
									<p><?=$package['package_details']?></p>
									<div class="row">
										<div class="col-xs-12 col-md-5">
											<p class="lead">PHP <?=money_format('%i', $package['package_price'])?></p>
										</div>
										<div class="col-xs-12 col-md-7" style="text-align: right;">
											<a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$package['place_id']?>" class="btn btn-success" role="button">Book</a>
											<a href="<?=$config['url']['base_path']?>/tourpackage.php?action=view_details&package_id=<?=$package['package_id']?>" class="btn btn-default" role="button">View details</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php if($counter % 3 == 0) : ?>
						<!-- <div class="clearfix"></div> -->
						<?php endif; ?>
						<?php $counter++; ?>
						<?php endforeach; ?>
						<?php if(count($place_packages) == 0) : ?>
							<div class="alert alert-info">
								<strong>Sorry!</strong> No tour packages available for <?=$place['place_name']?>.
							</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>
		</div>
	</div>
</div>
