<div class="aligner login-wrapper">
    <div class="aligner-item">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Reset Password</h3>
            </div>
            <div class="panel-body">
                <?php if(httpGet('error') == 'register') : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Username is already taken
                </div>
                <?php endif; ?>
                <form action="<?=$config['url']['base_path']?>/forgot.php" method="POST" data-toggle="validator" role="form">
                    <input type="hidden" name="email" value="<?=httpGet('email')?>" />
                    <input type="hidden" name="hash" value="<?=httpGet('hash')?>" />
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">New Password</label>
                        <div class="form-inline row">
                            <div class="form-group col-sm-6">
                                <input type="password" name="password" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                                <div class="help-block">Minimum of 6 characters</div>
                            </div>
                            <div class="form-group col-sm-6">
                                <input type="password" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, password don't match" placeholder="Confirm" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Reset</button> | <a href="<?=$config['url']['base_path']?>">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>