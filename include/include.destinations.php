<?php

$db = new DB;
$sql =  "SELECT * FROM `places`";

$places = $db->rows($sql);

?>
<div id="wrap">
<div class="m-t-50">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<h1>Top Destinations</h1>
				<div class="row">
				<?php foreach ($places as $place) : ?>
				  <div class="col-sm-6 col-md-4">
				    <div class="thumbnail">
				      <img src="<?=$config['url']['places']?>/<?=$place['place_image']?>" alt="<?=$place['place_name']?>">
				      <div class="caption">
				        <h3><?=$place['place_name']?></h3>
				        <small><?=$place['place_address']?></small>
				        <p><?=$place['place_details']?></p>
				        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$place['place_id']?>" class="btn btn-success btn-block" role="button">View tour packages</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$place['place_name']?>" class="btn btn-primary btn-block" role="button">View posts</a></p>
				      </div>
				    </div>
				  </div>
				  <?php endforeach; ?>
				</div>
			</div>
			<div class="col-md-4">
				
			</div>
		</div>
	</div>
</div>
</div>