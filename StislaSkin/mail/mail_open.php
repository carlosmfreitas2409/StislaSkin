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

    date_default_timezone_set('UTC');
?>
<div class="row mt-2">
	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <?php 
                    foreach ($mail as $data) {
                        if($data->who_to == Auth::$userinfo->pilotid){
                            $user = PilotData::GetPilotData($data->who_from);
                            $pilot = PilotData::GetPilotCode($user->code, $data->who_from);
                        }
                        if($data->who_from == Auth::$userinfo->pilotid){
                            $user = PilotData::GetPilotData($data->who_to);
                            $pilot = PilotData::GetPilotCode($user->code, $data->who_to);
                        }
                ?>
                <div class="tickets">
                    <div class="ticket-content" style="width: 100%">
                        <div class="ticket-header">
                            <div class="ticket-sender-picture img-shadow">
                                <img alt="image" src="<?php echo PilotData::getPilotAvatar($pilot); ?>">
                            </div>
                            <div class="ticket-detail">
                                <div class="ticket-title">
                                    <h4><?php echo $data->subject; ?></h4>
                                </div>
                                <div class="ticket-info">
                                    <div class="font-weight-600"><?php echo $user->firstname.' '. $user->lastname.' '.$pilot; ?></div>
                                    <div class="bullet"></div>
                                    <div class="text-primary font-weight-600"><?php echo MailData::timeago($data->date); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="ticket-description">
                            <?php echo nl2br($data->message); ?>

                            <div class="ticket-divider" style="margin-bottom: 15px; margin-top: 20px;"></div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="ticket-form" style="margin-top: 10px;">
                    <div class="form-group">
                        <a href="<?php echo SITE_URL ?>/index.php/Mail/move_message/<?php echo $data->id;?>" class="btn btn-primary btn-lg">Move to Folder</a>
                        <a href="<?php echo SITE_URL ?>/index.php/Mail/reply/<?php echo $data->thread_id;?>" class="btn btn-primary btn-lg float-right">Reply</a>
                    </div>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>