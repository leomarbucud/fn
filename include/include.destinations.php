<?php

$db = new DB;
$sql =  "SELECT ";
$sql .= "* ";
$sql .= ", (";
$sql .= "SELECT COUNT(*) ";
$sql .= "FROM `posts` as p ";
$sql .= "WHERE ";
$sql .= "p.post_text LIKE CONCAT(\"%\",pl.place_name,\"%\") ";
$sql .= "OR ";
$sql .= "p.location LIKE CONCAT(\"%\",pl.place_name,\"%\") ";
// $sql .= "p.post_text RLIKE '[[:<:]]baguio[[:>:]]' ";
// $sql .= "MATCH (p.post_text,p.location) ";
// $sql .= "AGAINST (CONCAT(\"'\",pl.place_name,\"'\")) ";
$sql .= "AND p.isApproved > 0 ";
$sql .= ") as user_rank ";
$sql .= "FROM ";
$sql .= "`places` as pl ";
$sql .= "ORDER BY ";
if($config['var']['dest_rank'] == "user") {
	$sql .= "user_rank ";
	$sql .= "DESC ";
} else {
	$sql .= "`rank` = 0, `rank` ";
	$sql .= "ASC ";
}
$places = $db->rows($sql);

?>
<div id="wrap">
<div class="m-t-50">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<h1>Top 5 Desitinations based on users' feedback</h1>
				<div class="row">
				<?php $i = 0; ?>
				<?php foreach ($places as $place) : ?>
				<?php if($i == 4) { break; } ?>
				  <div class="col-sm-6 col-md-4">
				    <div class="thumbnail" style="">
				      <img src="<?=$config['url']['places']?>/<?=$place['place_image']?>" alt="<?=$place['place_name']?>" style="height: 160px;">
				      <div class="caption">
				        <h3><?=$place['place_name']?></h3>
				        <!-- <h3><?=$place['r']?></h3> -->
				        <small><?=$place['place_address']?></small>
				        <div style="height: 50px;">
				        	<p class="block-with-text"><?=$place['place_details']?></p>
				        </div>
				        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$place['place_id']?>" class="btn btn-success btn-block" role="button">View tour packages</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$place['place_name']?>" class="btn btn-default btn-block" role="button">View posts</a></p>
				      </div>
				    </div>
				  </div>
				  <?php endforeach; ?>
				</div>
				<h2>Other destinations</h2>
				<div class="row">
				<?php foreach (array_slice($places, 5) as $place) : ?>
				  <div class="col-sm-6 col-md-4">
				    <div class="thumbnail" style="">
				      <img src="<?=$config['url']['places']?>/<?=$place['place_image']?>" alt="<?=$place['place_name']?>" style="height: 160px;">
				      <div class="caption">
				        <h3><?=$place['place_name']?></h3>
				        <!-- <h3><?=$place['r']?></h3> -->
				        <small><?=$place['place_address']?></small>
				        <div style="height: 50px;">
				        	<p class="block-with-text"><?=$place['place_details']?></p>
				        </div>
				        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$place['place_id']?>" class="btn btn-success btn-block" role="button">View tour packages</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$place['place_name']?>" class="btn btn-default btn-block" role="button">View posts</a></p>
				      </div>
				    </div>
				  </div>
				  <?php endforeach; ?>
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</div>
</div>
</div>