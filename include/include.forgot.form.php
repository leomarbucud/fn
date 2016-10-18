<?php
if(httpPost('email')) {
    $email = httpPost('email');
}
?>
<div class="aligner login-wrapper">
    <div class="aligner-item">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Forgot Password</h3>
            </div>
            <div class="panel-body">
                <?php if(isset($userExist)) : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Email povided is not registered to Footnote.
                </div>
                <?php endif; ?>
                <?php if(isset($sent)) : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> Please check your email and click the link provided. <a href="<?=$config['url']['base_path']?>/">Login</a>
                </div>
                <?php else : ?>
                <p>Type in your email and we will send a reset password link.</p>
                <form action="<?=$config['url']['base_path']?>/forgot.php" method="POST" data-toggle="validator" role="form">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button> | <a href="<?=$config['url']['base_path']?>/">Login</a> | <a href="<?=$config['url']['base_path']?>/?register=true">Create an account</a>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>