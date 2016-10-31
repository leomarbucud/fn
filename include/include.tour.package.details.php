<?php

$s = new Session;

$db = new DB;

$sql =  "SELECT ";
$sql .= "p.package_id, ";
$sql .= "p.package_name, ";
$sql .= "p.place_id, ";
$sql .= "p.package_price, ";
$sql .= "p.package_details, ";
$sql .= "p.package_person, ";
$sql .= "p.package_accomodation, ";
$sql .= "p.package_transportation, ";
$sql .= "g.place_image, ";
$sql .= "g.place_name, ";
$sql .= "g.place_details, ";
$sql .= "g.gallery_id ";
$sql .= "FROM ";
$sql .= "`packages` as p ";
$sql .= "LEFT JOIN ";
$sql .= "`places` as g ";
$sql .= "ON ";
$sql .= "g.place_id = p.place_id ";
$sql .= "WHERE ";
$sql .= "`package_id` = :package_id ";

$package_id = httpGet('package_id');

$package_details = $db->row($sql, array("package_id" => $package_id));

$sql = "SELECT * FROM `images` WHERE `gallery_id` = :gallery_id";
$images = $db->rows($sql, array("gallery_id" => $package_details['gallery_id']));

?>
<div id="wrap">
	<div class="m-t-50">
		<br>
		<div class="container">
			<div class="row">
				<div class="col-md-5">

					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<!-- Indicators -->
						<ol class="carousel-indicators">
							<?php for($i = 0; $i < count($images); $i++) : ?>
								<li data-target="#carousel-example-generic" data-slide-to="<?=$i?>" class="<?=$i==0?'active':''?>"></li>
							<?php endfor; ?>
						</ol>

						<!-- Wrapper for slides -->
						<div class="carousel-inner" role="listbox">

							<?php foreach ($images as $index => $image) : ?>
								<div class="item <?=$index==0?'active':''?>">
									<img src="<?=$config['url']['gallery']?>/<?=$image['image_hash']?>" style="width: 100%;">
									<div class="carousel-caption">

									</div>
								</div>
							<?php endforeach; ?>
						</div>

						<!-- Controls -->
						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<h2><?=$package_details['place_name']?></h2>
					<p><?=$package_details['place_details']?></p>
				</div>
				<div class="col-md-4">
					<h1><?=$package_details['package_name']?></h1>
					<h2>PHP <?=money_format('%i', $package_details['package_price'])?></h2>
					<h3>Package details</h3>
					<dl>
						<dt>Destination</dt>
						<dl><?=$package_details['place_name']?></dl>
						<dt>No. of person</dt>
						<dl><?=$package_details['package_person']?></dl>
						<dt>Transportation</dt>
						<dl><?=$package_details['package_transportation']?></dl>
						<dt>Accomodation</dt>
						<dl><?=$package_details['package_accomodation']?></dl>
						<dt>Other details</dt>
						<dl><?=$package_details['package_details']?></dl>
					</dl>
				</div>
				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							Book now
						</div>
						<div class="panel-body">
							<?php if($s->_get('user')): ?>
								<form id="booking-form" data-toggle="validator" method="POST" action="<?=$config['url']['base_path']?>/action/action.book.php">
									<input type="hidden" name="action" value="book">
									<input type="hidden" name="price" id="package-price" value="<?=$package_details['package_price']?>" />
									<input type="hidden" name="package_id" id="package-id" value="<?=$package_details['package_id']?>" />
									<input type="hidden" name="total" id="total" value="" />
									<div class="form-group">
										<label for="">Date</label>
										<input id="book-date" type="text" data-toggle="datepicker" class="form-control" name="date" required />
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label for="">No. of Person</label>
										<input type="number" name="person" class="form-control" id="book-person" value="2" min="1" required />
										<div class="help-block with-errors"></div>
									</div>

									<div class="form-group">
										<label for="exampleInputPassword1">Total</label>
										<p class="form-control-static">PHP <span id="book-total">--</span></p>
									</div>
									<div class="form-group">
										<label for="note">Additional note</label>
										<textarea class="form-control" name="note"></textarea>
									</div>
									<div class="form-group">
										<div class="checkbox">
											<label>
												<input type="checkbox" data-error="You must aggree to terms and conditions." required> Agree to terms and conditions.
											</label>
											<div class="help-block with-errors"></div>
										</div>
									</div>
									<button type="submit" class="btn btn-success btn-block">Book</button>
								</form>
							<?php else: ?>
								<p>Please login first before you can book.</p>
								<form action="<?=$config['url']['base_path']?>/login.php" method="POST" data-toggle="validator" role="form">
									<input type="hidden" name="rUrl" value="<?=$_SERVER['REQUEST_URI']?>" />
									<div class="form-group">
										<label for="username">Username <small>(or email)</small></label>
										<input type="username" name="login" id="username" class="form-control" placeholder="Username or Email" required value="<?=httpGet('username')?>">
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label for="password">Password</label>
										<input type="password" name="password" id="password" class="form-control" placeholder="Password" required value="">
										<div class="help-block"><a href="<?=$config['url']['base_path']?>/forgot.php">Forgot password?</a></div>
										<div class="help-block with-errors"></div>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="remember" value="1"> Remember me
										</label>
									</div>
									<button type="submit" class="btn btn-success">Login</button> | <a href="<?=$config['url']['base_path']?>/?register=true">Create an account</a>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
