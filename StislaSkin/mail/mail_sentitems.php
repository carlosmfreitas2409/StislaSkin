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
                <h4>Sent Messages</h4>
            </div>
            <div class="card-body">
                <div class="card-contact">
                    <?php
                        if(!$mail) {
                            echo '<div class="alert alert-primary">You have no sent messages.</div>';
                        } else {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-1">
                            <thead>                                 
                                <tr>
                                    <th width="5px" class="text-center">Status</th>
                                    <th width="40%">Subject</th>
                                    <th>To</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                    foreach($mail as $thread) {
                                        if($thread->read_state=='0'){
                                            if($thread->deleted_state == '0') {
                                                $status = '<div class="badge badge-info">Unread</div>';
                                            } else {
                                                $status = '<div class="badge badge-danger">Unread & Deleted</div>';
                                            }
                                        } else {
                                            if($thread->deleted_state == '0') {
                                                $status = '<div class="badge badge-success">Read</div>';
                                            } else {
                                                $status = '<div class="badge badge-warning">Read & Deleted</div>';
                                            }
                                        }
        
                                        $user = PilotData::GetPilotData($thread->who_to); 
                                        $pilot = PilotData::GetPilotCode($user->code, $thread->who_to);
                                ?>
                                <tr>
                                    <td align="center">
                                        <?php echo $status; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITE_URL ?>/index.php/Mail/item/<?php echo $thread->thread_id.'/'.$thread->who_to;?>"><?php echo $thread->subject; ?></a>
                                    </td>
                                    <td>
                                        <?php
                                            if ($thread->notam=='1') {
                                                echo 'NOTAM (All Pilots)';
                                            }
                                            else {
                                                echo '<img alt="image" src="'.PilotData::getPilotAvatar($pilot).'" class="rounded-circle" width="35" title="'.$user->firstname.' '.$user->lastname .' ('.$pilot.')" data-toggle="tooltip">';
                                            } 
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo date('M-d @ H:ia', strtotime($thread->date)); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="<?php echo SITE_URL ?>/index.php/Mail/sent_delete/?mailid=<?php echo $thread->id;?>">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>

                    <center><a class="mt-3 btn btn-danger" href="<?php echo url('/mail/delete_allsent'); ?>" onclick="return confirm('Delete All Sent Messages From View?')">Delete All</a></center>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>