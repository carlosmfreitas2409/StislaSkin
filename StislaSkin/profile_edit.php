<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    @media (min-width: 992px) {
        .col-md-offset-3 {
            margin-left: 15%;
        }
    }
</style>

<div class="section-header">
    <h1>Profile Edit</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Profile</a></div>
        <div class="breadcrumb-item">Profile Edit</div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-md-offset-3">
        <div class="card">
			<div class="card-body">
                <form action="<?php echo url('/profile');?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="<?php echo $userinfo->firstname.' '.$userinfo->lastname;?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Airline</label>
                        <input type="text" class="form-control" placeholder="<?php echo $userinfo->code?>" disabled>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $userinfo->email;?>">
                        <?php
                            if(isset($email_error) && $email_error == true)
                                echo '<p class="text-danger">Please enter your email address</p>';
                        ?>
                    </div>

                    <div class="form-group">
                        <label>Location</label>
                        <select name="location" class="form-control">
                            <?php
                                foreach($countries as $countryCode=>$countryName) {
                                    if($pilot->location == $countryCode)
                                        $sel = 'selected="selected"';
                                    else	
                                        $sel = '';
                                    
                                    echo '<option value="'.$countryCode.'" '.$sel.'>'.$countryName.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Signature Background</label>
                        <select name="bgimage" class="form-control">
                            <?php
                                foreach($bgimages as $image) {
                                    if($pilot->bgimage == $image)
                                        $sel = 'selected="selected"';
                                    else	
                                        $sel = '';
                                    
                                    echo '<option value="'.$image.'" '.$sel.'>'.$image.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <?php
                        if($customfields) {
                            foreach($customfields as $field) {
                                echo '<div class="form-group">';
                                echo '<label>'.$field->title.'</label>';
                                
                                if($field->type == 'dropdown') {
                                    $field_values = SettingsData::GetField($field->fieldid);				
                                    $values = explode(',', $field_values->value);
                                    
                                    
                                    echo "<select class='form-control' name=\"{$field->fieldname}\">";
                                
                                    if(is_array($values)) {		
                                        
                                        foreach($values as $val) {
                                            $val = trim($val);
                                            
                                            if($val == $field->value)
                                                $sel = " selected ";
                                            else
                                                $sel = '';
                                            
                                            echo "<option value=\"{$val}\" {$sel}>{$val}</option>";
                                        }
                                    }
                                    
                                    echo '</select>';
                                } elseif($field->type == 'textarea') {
                                    echo '<textarea name="'.$field->fieldname.'" class="form-control customfield_textarea">'.$field->value.'</textarea>';
                                } else {
                                    echo '<input type="text" class="form-control" name="'.$field->fieldname.'" value="'.$field->value.'" />';
                                }
                                
                                echo '</div>';
                            }
                        }
                    ?>

                    <div class="form-group">
                        <label>Avatar</label>
                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo Config::Get('AVATAR_FILE_SIZE');?>" />
                        <input type="file" name="avatar" size="40" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Current Avatar</label>
                        <?php	
                            if(!file_exists(SITE_ROOT.AVATAR_PATH.'/'.$pilotcode.'.png')) {
                                echo '<br/>None selected';
                            } else {
                        ?>
                        <br/>
                        <img src="<?php	echo SITE_URL.AVATAR_PATH.'/'.$pilotcode.'.png';?>" /></dd>
                        <?php } ?>
                    </div>

                    <input type="hidden" name="action" value="saveprofile" />
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="Save Changes" />
                </form>
			</div>
		</div>
    </div>

    <div class="col-md-4 ">
        <div class="card">
			<div class="card-header">
				<h4>Change Password</h4>
			</div>
			<div class="card-body">
                <form action="<?php echo url('/profile');?>" method="post">
                    <div class="form-group">
                        <label>Old Password</label>
                        <input type="password" class="form-control" name="oldpassword" placeholder="Old Password">
                    </div>

                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" class="form-control" id="password" name="password1" placeholder="New Password" value="">
                    </div>

                    <div class="form-group">
                        <label>New Password again</label>
                        <input type="password" class="form-control" name="password2" placeholder="Confirm Password" value="">
                    </div>

                    <input type="hidden" name="action" value="changepassword" />
                    <input type="submit" name="submit" class="btn btn-primary float-right" value="Save Password" />
                </form>
            </div>
        </div>
    </div>
</div>