<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <?php
                if(isset($message))
                    echo '<div class="alert alert-warning">
                        <div class="alert-title">Warning!</div>
                        Your registration has not yet been checked by an administrator. Please try again later. You will receive an email when your registration has been accepted.</div>';
            ?>

            <div class="mt-5 text-muted text-center">
                Already have an account? <a href="<?php echo url('/login'); ?>">Login Now</a>
            </div>

            <div class="simple-footer">Copyright &copy; <?php echo SITE_NAME; ?> <?php echo date("Y"); ?></div>
        </div>
    </div>
</div>