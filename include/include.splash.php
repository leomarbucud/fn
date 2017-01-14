<?php
$s = new Session;
$db = new DB;
$sql =  "SELECT ";
$sql .= "* ";
$sql .= "FROM ";
$sql .= "`places` ";
$sql .= "ORDER BY ";
$sql .= "`rank` = 0, `rank`";
$sql .= "ASC ";
$sql .= "LIMIT 10";

$places = $db->rows($sql);

?>
<div class="m-t-50">
	<div id="carousel-home" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
      	<div class="item active" style="height: 500px; background-image: url(<?=$config['url']['base_path']?>/assets/images/content/boracay-white-beach-sunset.jpg); background-size: cover; background-position: center center;">
          <div class="container">
            <div class="carousel-caption">
              <h1>It's more fun in the Philippines!</h1>
              <p class="lead">Visit the top destinations here in the Philippines.</p>
				<a class="btn btn-primary btn-lg" href="<?=$config['url']['base_path']?>/about.php" role="button">Learn more</a>
            </div>
          </div>
        </div>
        <div class="item" style="height: 500px; background-image: url(<?=$config['url']['base_path']?>/assets/images/content/lions_head_baguio_city.jpg); background-size: cover; background-position: center center;">
          <div class="container">
            <div class="carousel-caption">
              <h1>Enjoy traveling with your friends.</h1>
              <p class="lead">It’s always more fun to travel with friends!</p>
              <a class="btn btn-lg btn-primary" href="<?=$config['url']['base_path']?>/?register=true">Sign up today</a>
            </div>
          </div>
        </div>
        <div class="item" style="height: 500px; background-image: url(<?=$config['url']['base_path']?>/assets/images/content/Pearl-Farm-Davao-BEACH-RESORT-3.png); background-size: cover; background-position: center center;">
          <div class="container">
            <div class="carousel-caption">
              <h1>Explore the Philippines.</h1>
              <p class="lead">Philippines has 7,000 tropical islands, come and visit Philippine’s best tourist spot.</p>
              <a class="btn btn-lg btn-primary" href="<?=$config['url']['base_path']?>/destinations.php">View Destinations</a>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-home" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#carousel-home" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
    </div><!-- /.carousel -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<h1>Top Destinations</h1>
				<div class="row">
				<?php foreach ($places as $place) : ?>
				  <div class="col-sm-6 col-md-4">
				    <div class="thumbnail" style="height: 450px;">
				      <img src="<?=$config['url']['places']?>/<?=$place['place_image']?>" alt="<?=$place['place_name']?>" style="max-height: 160px;">
				      <div class="caption">
				        <h3><?=$place['place_name']?></h3>
				        <small><?=$place['place_address']?></small>
				        <p style="height: 100px;"><?=$place['place_details']?></p>
				        <p><a href="<?=$config['url']['base_path']?>/tourpackage.php?place_id=<?=$place['place_id']?>" class="btn btn-success btn-block" role="button">View tour packages</a> <a href="<?=$config['url']['base_path']?>/search.php?q=<?=$place['place_name']?>" class="btn btn-default btn-block" role="button">View posts</a></p>
				      </div>
				    </div>
				  </div>
				  <?php endforeach; ?>
				</div>
			</div>
			<div class="col-md-4">
			    <br>
				<p class="lead">The Philippines is the third largest English speaking country in the world. It has a rich history combining Asian, European, and American influences. Prior to Spanish colonization in 1521, the Filipinos had a rich culture and were trading with the Chinese and the Japanese. Spain's colonization brought about the construction of Intramuros in 1571, a "Walled City" comprised of European buildings and churches, replicated in different parts of the archipelago. In 1898, after 350 years and 300 rebellions, the Filipinos, with leaders like Jose Rizal and Emilio Aguinaldo, succeeded in winning their independence.</p>
				 
				<p>In 1898, the Philippines became the first and only colony of the United States. Following the Philippine-American War, the United States brought widespread education to the islands. Filipinos fought alongside Americans during World War II, particularly at the famous battle of Bataan and Corregidor which delayed Japanese advance and saved Australia. They then waged a guerilla war against the Japanese from 1941 to 1945. The Philippines regained its independence in 1946.</p>
				 
				<p>Filipinos are a freedom-loving people, having waged two peaceful, bloodless revolutions against what were perceived as corrupt regimes. The Philippines is a vibrant democracy, as evidenced by 12 English national newspapers, 7 national television stations, hundreds of cable TV stations, and 2,000 radio stations.</p>
				 
				<p>Filipinos are a fun-loving people. Throughout the islands, there are fiestas celebrated everyday and foreign guests are always welcome to their homes.</p>
			</div>
		</div>
	</div>

</div>
<?php if($s->_get('user') && $s->_get('welcome')) : ?>
<div id="welcomeModal" class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Welcome!</h4>
      </div>
      <div class="modal-body">
        <p>Welcome back <?=$s->_get('user')['firstname'].' '.$s->_get('user')['lastname']?>!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php 
	$s->_unset('welcome');
?>
<?php endif; ?>