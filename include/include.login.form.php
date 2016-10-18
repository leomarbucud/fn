<div class="aligner login-wrapper">
    <div class="aligner-item">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Login to Footnote</h3>
            </div>
            <div class="panel-body">
                <?php if(httpGet('error') == 'login') : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Invalid username or password
                </div>
                <?php endif; ?>
                <?php if(httpGet('error') == 'nv') : ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oops!</strong> Please avtivate your account first.
                </div>
                <?php endif; ?>
                <?php if(httpGet('action') == 'jr') : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Successfully registered!</strong> Please verify your email address by clicking the link sent to your email.
                </div>
                <?php endif; ?>
                <?php if(httpGet('action') == 'verified') : ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Account successfully acctivated!</strong> You can now login yout account.
                </div>
                <?php endif; ?>
                <form action="<?=$config['url']['base_path']?>/login.php" method="POST" data-toggle="validator" role="form">

                    <div class="form-group">
                        <label for="username">Username <small>(or email)</small></label>
                        <input type="username" name="login" id="username" class="form-control" placeholder="Username or Email" required value="<?=httpGet('username')?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required value="">
                        <div class="help-block"><a href="<?=$config['url']['base_path']?>/forgot.php">Forgot password?</a></div>
                    </div>
                    <div class="checkbox">
                        <label>
                              <input type="checkbox" name="remember" value="1"> Remember me
                            </label>
                    </div>
                    <button type="submit" class="btn btn-success">Login</button> | <a href="<?=$config['url']['base_path']?>/?register=true">Create an account</a>
                </form>
            </div>
        </div>
    </div>
</div>