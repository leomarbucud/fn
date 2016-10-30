
<?php 
$s = new Session;
if($s->_get('user')['level'] == 0 ) : ?>

<?php endif; ?>
<footer>
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="copyright">
						&copy; 2016, Footnote, All rights reserved
					</div>
				</div>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
					<div class="design">
						Contact: 09261234567
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/bower_components/bootstrap/dist/js/bootstrap-date-picker.min.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/bower_components/moment/min/moment.min.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/js/plugin.fileupload.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/js/zoom.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/js/geolocation.js"></script>
<script type="text/javascript" src="<?=$config['url']['base_path']?>/assets/js/footnote.js"></script>
</body>

</html>