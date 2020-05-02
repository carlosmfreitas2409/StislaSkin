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
                <h4>Delete Folder</h4>
            </div>
            <div class="card-body">
                <div class="card-contact">
                    <?php 
                        $folders = MailData::checkforfolders(Auth::$userinfo->pilotid);
                        if(!$folders) {
                            echo '<div class="alert alert-primary">There are no folders to delete.</div>';
                        } else {
                    ?>
                    <form action="<?php echo url('/Mail');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Select Folder</label>
                            <select class="form-control" name="folder_id">
                                <?php foreach ($folders as $folder) {echo '<option value="'.$folder->id.'">'.$folder->folder_title.'</option>';}?>
                            </select>
                        </div>

                        <p><b>Note: </b>All AIRMail contained in the folder being deleted will be moved to the default AIRMail Inbox.</p>
                        
                        <input type="hidden" name="action" value="confirm_delete_folder" />
                        <input type="submit" class="btn btn-primary" value="Delete Folder">
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>