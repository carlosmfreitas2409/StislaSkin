<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <?php
                if(isset($message))
                    echo '<div class="alert alert-danger">
                        <div class="alert-title">Error!</div>
                        '.$message.'</div>';
            ?>

            <div class="card card-primary">
                <div class="card-header"><h4>Login</h4></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo url('/login');?>" name="loginform" class="needs-validation" novalidate="">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" tabindex="1" required autofocus>
                            <div class="invalid-feedback">
                                Please fill in your email
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-block">
                                <label for="password" class="control-label">Password</label>
                                <div class="float-right">
                                    <a href="<?php echo url('login/forgotpassword'); ?>" class="text-small">
                                        Forgot Password?
                                    </a>
                                </div>
                            </div>
                            <input type="password" name="password" class="form-control" name="password" tabindex="2" required>
                            <div class="invalid-feedback">
                                Please fill in your password
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                <label class="custom-control-label" for="remember-me">Remember Me</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" name="redir" value="" />
                            <input type="hidden" name="action" value="login" />
                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit" value="Login" tabindex="4" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-5 text-muted text-center">
                Don't have an account? <a href="<?php echo SITE_URL?>/index.php/registration">Create One</a>
            </div>

            <div class="simple-footer">Copyright &copy; <?php echo SITE_NAME; ?> <?php echo date("Y"); ?></div>
        </div>
    </div>
</div>
