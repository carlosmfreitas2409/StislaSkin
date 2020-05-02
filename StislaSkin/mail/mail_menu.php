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

    $item = MailData::checkformail();
    $items = $item->total;
?>

<style>
    .danger {
        box-shadow: 0 2px 6px #fd9b96;
        color: #fff;
        background-color: #fc544b;
    }
</style>

<div class="section-header">
	<h1>AirMail</h1>
    <div class="section-header-button">
        <button type="button" data-toggle="modal" data-target="#composeForm" class="btn btn-icon icon-left btn-primary">
            <i class="far fa-edit"></i>
            Compose Message
        </button>
    </div>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Paper Work</a></div>
        <div class="breadcrumb-item">AirMail</div>
    </div>
</div>

<div class="section-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<ul class="nav nav-pills">
								<li class="nav-item">
									<a class="nav-link active" href="<?php echo SITE_URL ?>/index.php/Mail">Inbox <span class="badge badge-white"><?php echo $items; ?></span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Mail/newfolder">Create Folder</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Mail/deletefolder">Delete Folder</a>
								</li>
                                <li class="nav-item">
									<a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Mail/settings">Settings</a>
								</li>
                                <li class="nav-item">
									<a class="nav-link" href="<?php echo SITE_URL ?>/index.php/Mail/sent">Sent Messages</a>
								</li>
							</ul>
						</div>

                        <div class="col-sm-6">
							<ul class="nav nav-pills float-right">
                                <?php
                                    if (isset($folders)) {
                                        foreach ($folders as $folder) {
                                            echo '<li style="margin-right: 10px;" class="nav-item"> <a class="nav-link active" href="'.SITE_URL.'/index.php/Mail/getfolder/'.$folder->id.'">'.$folder->folder_title.'</a> </li>';
                                        }
                                    }
                                ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>