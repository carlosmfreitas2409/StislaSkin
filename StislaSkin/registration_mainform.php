<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="<?php echo SITE_URL?>/lib/skins/StislaSkin/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
                <div class="card-header"><h4>Register</h4></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo url('/registration');?>">
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="frist_name">First Name</label>
                                <input id="frist_name" type="text" class="form-control" name="firstname" value="<?php echo Vars::POST('firstname');?>" autofocus>
                                <?php
                                    if($firstname_error == true)
                                        echo '<p class="error">Please enter your first name</p>';
                                ?>
                            </div>
                            <div class="form-group col-6">
                                <label for="last_name">Last Name</label>
                                <input id="last_name" type="text" class="form-control" name="lastname" value="<?php echo Vars::POST('lastname');?>">
                                <?php
                                    if($lastname_error == true)
                                        echo '<p class="error">Please enter your last name</p>';
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo Vars::POST('email');?>">
                            <div class="invalid-feedback"></div>
                            <?php
                                if($email_error == true)
                                    echo '<p class="error">Please enter your email address</p>';
                            ?>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="password" class="d-block">Password</label>
                                <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password1">
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group col-6">
                                <label for="password2" class="d-block">Password Confirmation</label>
                                <input id="password2" type="password" class="form-control" name="password2">
                                <?php
                                    if($password_error != '')
                                        echo '<p class="error">'.$password_error.'</p>';
                                ?>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-6">
                                <label>Airline</label>
                                <select name="code" id="code" class="form-control selectric">
                                    <?php
                                        foreach($airline_list as $airline) {
                                            echo '<option value="'.$airline->code.'">'.$airline->code.' - '.$airline->name.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>Hub</label>
                                <select name="hub" id="hub" class="form-control selectric">
                                    <?php
                                        foreach($hub_list as $hub) {
                                            echo '<option value="'.$hub->icao.'">'.$hub->icao.' - ' . $hub->name .'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Location</label>
                            <select name="location" class="form-control selectric">
                                <?php
                                    foreach($country_list as $countryCode=>$countryName) {
                                        if(Vars::POST('location') == $countryCode) {
                                            $sel = 'selected="selected"';
                                        } else {
                                            $sel = '';
                                        }

                                        echo '<option value="'.$countryCode.'" '.$sel.'>'.$countryName.'</option>';
                                    }
                                ?>
                            </select>
                            <?php
                                if($location_error == true) {
                                    echo '<p class="error">Please enter your location</p>';
                                }
                            ?>
                        </div>

                        <?php
                            //Put this in a seperate template. Shows the Custom Fields for registration
                            Template::Show('registration_customfields.tpl');
                        ?>

                        <div class="form-group">
                            <label>reCaptcha</label>
                            <?php if(isset($captcha_error)){echo '<p class="error">'.$captcha_error.'</p>';} ?>
                            <div class="g-recaptcha" data-sitekey="<?php echo $sitekey;?>"></div>
                            <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang;?>"></script>
                        </div>


                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                                <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary btn-lg btn-block" value="Register!" />
                        </div>
                    </form>
                </div>
            </div>

            <div class="simple-footer">Copyright &copy; <?php echo SITE_NAME; ?> <?php echo date("Y"); ?></div>
        </div>
    </div>
</div>