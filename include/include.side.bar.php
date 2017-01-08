<?php
    $profile_pic = $config['var']['default_profile_pic'];
    $name = 'Anonymous User';
    $bio = '';
    if($s->_get('user')) {
        $profile_pic = $s->_get('user')['profile'];
        $name = $s->_get('user')['firstname']. ' '.$s->_get('user')['lastname'];
        $bio = $s->_get('user')['bio'];
    }
?>
<?php if($_SERVER['REQUEST_URI'] != $config['url']['base_path'].'/profile.php') : ?>
<div class="profile-side">
    <img class="img-circle" src="<?=$config['url']['profile_pic']?>/<?=$profile_pic?>" width="50" height="50" />&nbsp;
    <strong><?=$name?></strong>
    <div class="bio">
        <?=$bio?>
    </div>
</div>
<?php endif; ?>

<div class="col-md-12 profile-actions">
    <?php if($s->_get('user')) : ?>
    <ul>
        <li><a href="<?=$config['url']['base_path']?>/newsfeed.php"><span class="glyphicon glyphicon-home"></span> News Feed</a></li>
        <li><a href="<?=$config['url']['base_path']?>/profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
        <li><a href="<?=$config['url']['base_path']?>/bookings.php"><span class="glyphicon glyphicon-book"></span> My Bookings</a></li>
    </ul>
    <h4>Account Settings</h4>
    <ul>
        <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=info"><span class="glyphicon glyphicon-pencil"></span> Edit Account</a></li>
        <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=security"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
        <li><a href="<?=$config['url']['base_path']?>/profile.php?action=edit&type=pic"><span class="glyphicon glyphicon-camera"></span> Change Profile Picture</a></li>
    </ul>
    <?php if($s->_get('user')['level'] > 0) : ?>
    <h4>Admin Settings</h4>
    <ul>
        <li class="active"><a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=users"><span class="glyphicon glyphicon-user"></span> Users</a></li>
        <li><a href="<?=$config['url']['base_path']?>/admin.php?action=view&type=ads"><span class="glyphicon glyphicon-flag"></span> Ads</a></li>
        <li><a href="<?=$config['url']['base_path']?>/posts.php"><span class="glyphicon glyphicon-list-alt"></span> Pending Posts</a></li>
    </ul>
    <h4>Agency Settings</h4>
    <ul>
        <li><a href="<?=$config['url']['base_path']?>/places.php"><span class="glyphicon glyphicon-map-marker"></span> Places</a></li>
        <li><a href="<?=$config['url']['base_path']?>/gallery.php"><span class="glyphicon glyphicon-picture"></span> Gallery</a></li>
        <li><a href="<?=$config['url']['base_path']?>/packages.php"><span class="glyphicon glyphicon-briefcase"></span> Tour Packages</a></li>
        <li><a href="<?=$config['url']['base_path']?>/admin.bookings.php"><span class="glyphicon glyphicon-book"></span> Bookings</a></li>
        <li><a href="<?=$config['url']['base_path']?>/inquiries.php"><span class="glyphicon glyphicon-list-alt"></span> Inquiries</a></li>
        <li><a href="<?=$config['url']['base_path']?>/flight.schedules.php"><span class="glyphicon glyphicon-globe"></span> Flight Schedules</a></li>
        <li><a href="<?=$config['url']['base_path']?>/airlines.php"><span class="glyphicon glyphicon-plane"></span> Airlines</a></li>
        <li><a href="<?=$config['url']['base_path']?>/airports.php"><span class="glyphicon glyphicon-plane"></span> Airports</a></li>
        <li><a href="<?=$config['url']['base_path']?>/hotels.php"><span class="glyphicon glyphicon-hotel"></span> Hotels</a></li>
    </ul>
    <?php endif; ?>
    <hr>
    <ul>
        <li><a href="<?=$config['url']['base_path']?>/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul>
    <?php else: ?>
    <ul>
        <li><a href="<?=$config['url']['base_path']?>/newsfeed.php"><span class="glyphicon glyphicon-home"></span> News Feed</a></li>
        <li><a href="<?=$config['url']['base_path']?>/profile.php"><span class="glyphicon glyphicon-user"></span> Destinations</a></li>
        <li><a href="<?=$config['url']['base_path']?>/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
    <?php endif; ?>
</div>