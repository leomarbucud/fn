<!doctype html>
<html>
<head>
    <title>Footnote</title>
    <link rel="stylesheet" href="<?=$config['url']['base_path']?>/assets/bower_components/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?=$config['url']['base_path']?>/assets/css/footnote.css" />
</head>
<body>
<?php
  $s = new Session;
  if($s->_get('id')):
?>
<nav class="navbar navbar-default navbar-fixed-top nb-g">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=$url['base_path']?>">Footnote</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" action="<?=$config['url']['base_path']?>/search.php" method="get">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" name="q" required>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?=$config['url']['base_path']?>">Home</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <?php if($s->_get('level') == '1' ) : ?>
            <li><a href="<?=$config['url']['base_path']?>/admin.php">Admin Panel</a></li>
            <?php  endif; ?> 
            <li role="separator" class="divider"></li>
            <li><a href="<?=$config['url']['base_path']?>/logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<?php endif; ?>