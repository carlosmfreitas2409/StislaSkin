<div class="row mt-2">
	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
            <?php if(isset($folder)) { ?>
            <div class="card-header">
                <h4><?php echo $folder->folder_title; ?> Folder</h4>
                <div class="card-header-action">
                    <a href="<?php echo SITE_URL.'/index.php/Mail/editfolder/'.$folder->id; ?>" class="btn btn-info">Edit Folder</a>
                </div>
            </div>
            <?php } ?>
            <div class="card-body">
                <div class="card-contact">
                    <?php
                        if(!$mail) {
                            echo '<div class="alert alert-primary">You have no messages.</div>';
                        } else {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="table-1">
                            <thead>                                 
                                <tr>
                                    <th width="5px" class="text-center">Status</th>
                                    <th width="40%">Subject</th>
                                    <th>From</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php
                                    foreach($mail as $data) {
                                        if ($data->read_state=='0') {
                                            $status = '<div class="badge badge-info">Unread</div>' ;
                                        } else {
                                            $status = '<div class="badge badge-success">Read</div>';
                                        }
        
                                        $user = PilotData::GetPilotData($data->who_from); 
                                        $pilot = PilotData::GetPilotCode($user->code, $data->who_from);
                                ?>
                                <tr>
                                    <td align="center">
                                        <?php echo $status; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo SITE_URL ?>/index.php/Mail/item/<?php echo $data->thread_id;?>"><?php echo $data->subject; ?></a>
                                    </td>
                                    <td>
                                        <img alt="image" src="<?php echo PilotData::getPilotAvatar($pilot); ?>" class="rounded-circle" width="35" data-toggle="tooltip" title="<?php echo "$user->firstname $user->lastname ($pilot)"; ?>">
                                    </td>
                                    <td>
                                        <?php echo date('M-d @ H:ia', strtotime($data->date)); ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="<?php echo SITE_URL ?>/index.php/Mail/delete/<?php echo $data->id;?>">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } ?>

                    <center><a class="mt-3 btn btn-danger" href="<?php echo url('/mail/delete_all/').$data->reciever_folder; ?>" onclick="return confirm('Delete All Inbox Messages?')">Delete All</a></center>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>