<?php
//AIRMail3
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2011, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>
<div class="row mt-2">
	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Compose Message</h4>
            </div>
            <div class="card-body">
                <div class="card-contact">
                    <form action="<?php echo url('/Mail');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Recipient</label>
                            <select name="who_to" class="form-control select2">
                                <option value="">Select a pilot</option>
                                <?php if(PilotGroups::group_has_perm(Auth::$usergroups, ACCESS_ADMIN)) { ?>
                                    <option value="all">NOTAM (All Pilots)</option>
                                <?php 
                                    } foreach($allpilots as $pilots) {
                                        echo '<option value="'.$pilots->pilotid.'">'.$pilots->firstname.' '.$pilots->lastname.' - '.PilotData::GetPilotCode($pilots->code, $pilots->pilotid).'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" placeholder="Subject" name="subject">
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="summernote"></textarea>
                        </div>

                        <input type="hidden" name="who_from" value="<?php echo Auth::$userinfo->pilotid; ?>" />
                        <input type="hidden" name="action" value="send" />
                        <input type="submit" class="btn btn-primary" value="Send">
                    </form>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>