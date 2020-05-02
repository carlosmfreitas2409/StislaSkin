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
                <h4>Edit Folder (<?php echo $folder->folder_title; ?>)</h4>
            </div>
            <div class="card-body">
                <div class="card-contact">
                    <form action="<?php echo url('/Mail');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>New Folder Name</label>
                            <input type="text" class="form-control" name="folder_title" value="<?php echo $folder->folder_title; ?>"/>
                        </div>
                        
                        <input type="hidden" name="folder_id" value="<?php echo $folder->id; ?>" />
                        <input type="hidden" name="action" value="confirm_edit_folder" />
                        <input type="submit" class="btn btn-primary" value="Edit Folder" />
                    </form>
                </div>
            </div>
        </div>

        <center>AirMail 3 &copy 2011 | <a href="http://www.simpilotgroup.com">simpilotgroup.com</a></center>
    </div>
</div>