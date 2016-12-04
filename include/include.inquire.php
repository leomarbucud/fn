<?php

$s = new Session;

$name = "";
$email = "";
$contact = "";

if($s->_get('id')) {
	$name = $s->_get('user')['firstname']." ".$s->_get('user')['lastname'];
	$email = $s->_get('user')['email'];
	$contact = $s->_get('user')['contact'];
}

?>
<div class="login-wrapper" style="min-height: 100%;">
    <div class="container m-t-50" style="max-width: 500px;" >
    	<?php if(isset($inquire)) : if($inquire) : ?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Thank you!</strong> Our admin will review your inquiry and will send an email or text message regarding the availability.
        </div>
        <?php endif; endif; ?>
        <div class="panel panel-success" >
            <div class="panel-heading">
                <h3 class="panel-title">Inquiry Form</h3>
            </div>
            <div class="panel-body">
                <form action="<?=$config['url']['base_path']?>/inquire.php" method="POST" data-toggle="validator" role="form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" required value="<?=$name?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required value="<?=$email?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact Number</label>
                        <input type="text" name="contact" id="contact" class="form-control" placeholder="Contact Number" required value="<?=$contact?>">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="from">Place From</label>
                        <input type="text" name="from" id="from" class="form-control" placeholder="Where you will came from" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="to">Place To Go</label>
                        <input type="text" name="to" id="to" class="form-control" placeholder="Where you will go" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control">
                        	<option value="Flight only">Flight only</option>
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="note">Additional Note</label>
                        <textarea class="form-control" name="note" id="note"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>