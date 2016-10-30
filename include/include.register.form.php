<div class="aligner login-wrapper">
    <div class="aligner-item">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Register a Footnote account</h3>
            </div>
            <div class="panel-body">
                <?php if(httpGet('error') == 'register') : ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Error!</strong> Username is already taken
                </div>
                <?php endif; ?>
                <form action="<?=$config['url']['base_path']?>/register.php" method="POST" data-toggle="validator" role="form">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" data-error="Email address is invalid" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="control-label">Password</label>
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
                        <button type="submit" class="btn btn-success">Register</button> | <a href="<?=$config['url']['base_path']?>?login=true">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>