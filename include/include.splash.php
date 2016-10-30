<?php

$db = new DB;
$sql =  "SELECT * FROM `places`";

$places = $db->rows($sql);

?>
<div class="m-t-50">
	<div class="jumbotron green">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-5">
					<img src="<?=$config['url']['base_path']?>/assets/images/content/boracay-white-beach-sunset.jpg" class="thumbnail img-responsive"/>
				</div>
				<div class="col-md-7">
					<h1>It's more fun in the Philippines!</h1>
					<p>Visit the top destinations here in the Philippines.</p>
					<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
				</div>
			</div>
		</div>
	</div>
	
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
				        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$place['place_id']?>" class="btn btn-primary" role="button">View tour packages</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$place['place_name']?>" class="btn btn-default" role="button">View posts</a></p>
				      </div>
				    </div>
				  </div>
				  <?php endforeach; ?>
				</div>
			</div>
			<div class="col-md-4">
				<p class="lead">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </p>
				<p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
			</div>
		</div>
	</div>

</div>
