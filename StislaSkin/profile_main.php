<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php 
    $pilotCode = PilotData::getPilotCode(Auth::$userinfo->code, Auth::$userinfo->pilotid);
    $userinfo = Auth::$userinfo;

    $hrs = intval($userinfo->totalhours);
    $min = ($userinfo->totalhours - $hrs) * 100;

    $last_location = FltbookData::getLocation($userinfo->pilotid);
    $last_name = OperationsData::getAirportInfo($last_location->arricao);
    if(!$last_location) {
        FltbookData::updatePilotLocation($pilotid, Auth::$userinfo->hub);
    }

    $percentage = ($pilot_hours/$nextrank->minhours) * 100;
    $round = round($percentage);

    $pireps = PIREPData::getAllReportsForPilot($userinfo->pilotid);
    $pirep_list = PIREPData::getAllReportsForPilot(Auth::$pilot->pilotid);
?>
<style>
    .contact-item:first-child {
		border: none;
		padding-top: 0;
		margin-top: 0;
	}

	.contact-item {
		color: #5b636a;
		align-items: flex-start;
		flex-wrap: wrap;
		padding: 10px 0 2px 0;
		display: flex;
		justify-content: space-between;
		margin-bottom: 0;
		font-size: 13px;
		border-top: 1px solid #dee2e6;
	}

	.contact-item:last-child{
		padding-bottom: 0;
	}

	.align-right {
		text-align: right;
	}
</style>

<div class="section-header">
    <h1>Profile</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
    </div>
</div>

<div class="section-body">
    <h2 class="section-title">Hi, <?php echo $userinfo->firstname;?>!</h2>
    <p class="section-lead">Here you can find some information and data about yourself.</p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">                     
                    <img alt="image" src="<?php echo PilotData::getPilotAvatar($pilotCode); ?>" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Flights</div>
                            <div class="profile-widget-item-value"><?php echo $userinfo->totalflights; ?></div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Miles</div>
                            <div class="profile-widget-item-value"><?php echo StatsData::TotalPilotMiles($userinfo->pilotid); ?></div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Hours</div>
                            <div class="profile-widget-item-value"><?php echo $hrs.'h '.$min.'m';?></div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name"><?php echo $userinfo->firstname.' '.$userinfo->lastname; ?>
                        <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $userinfo->email; ?></div>
                    </div>
                    <div class="contact-item">
                        <h6>Location</h6>
                        <span class="float-right align-right">
                            <?php echo Countries::getCountryName(Auth::$userinfo->location); ?>
                            <img style="margin-left: 7px;" src="<?php echo Countries::getCountryImage(Auth::$userinfo->location); ?>" alt="<?php echo Countries::getCountryName($userinfo->location); ?>">
                        </span>
                    </div>
                    <div class="contact-item">
                        <h6>Status</h6>
                        <span class="float-right align-right">
                            <?php
                                if($pilot->retired == 0) {
                                    echo '<p class="text-success">Active</p>';
                                } elseif($pilot->retired == 1) {
                                    echo '<p class="text-danger">Inactive</p>';
                                } else {
                                    echo '<p class="text-primary">On Leave</p>';
                                }
                            ?>
                        </span>
                    </div>

                    <div class="text-center">
                        <a href="<?php echo SITE_URL; ?>/index.php/profile/editprofile" class="btn btn-icon icon-left btn-primary btn-round">
                            <i class="far fa-edit"></i>
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <ul style="margin-bottom: 0;" class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                        <li class="media">
                            <img alt="image" class="mr-3" style="align-self: center;" width="50" src="<?php echo $nextrank->rankimage; ?>">
                            <div class="media-body">
                                <div class="media-title"><?php echo $nextrank->rank; ?></div>
                                <div class="text-job text-muted"><?php echo $nextrank->minhours - $pilot_hours; ?> hours left</div>
                            </div>
                            <div class="media-progressbar">
                                <div class="progress-text"><?php echo $round ?>%</div>
                                    <div class="progress" data-height="6" style="height: 6px;">
                                    <div class="progress-bar bg-primary" data-width="<?php echo $round; ?>%" style="width: <?php echo $round; ?>%;"></div>
                                </div>
                            </div>
                            <div class="media-cta">
                                <a href="#" class="btn btn-outline-primary">More</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h4>Flights Map</h4>
                    <div class="card-header-action">
                        <a data-toggle="modal" href="logbook_modal.php" data-target="#logbook" class="btn btn-info">Pilot Logbook</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php
                        if(!$pireps) {
                            echo "
                            <div class='card-body'>
                                <div class='alert alert-primary mb-2' role='alert'>
                                    <strong>Opss!</strong> You don't have any flights!
                                </div>
                            </div>
                            ";
                        } else {
                            require 'flown_routes_map.php';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="statistic-details">
                        <div class="statistic-details-item">
                            <div class="detail-value text-primary">
                                <?php if($settings['search_from_current_location'] == 1) { ?>
                                <?php echo $last_name->icao; ?>
                                <?php } else { ?>
                                <?php echo $last_name->icao; ?>
                                <?php } ?>
                            </div>
                            <div class="detail-name">Current Location</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="detail-value text-danger"><?php echo $userinfo->hub; ?></div>
                            <div class="detail-name">HUB</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="detail-value text-info">
                                <?php
                                    $pireps = PIREPData::findPIREPS(array('p.pilotid' => Auth::$userinfo->pilotid));
                                    if(!$pireps) {
                                        echo 'NO PIREPs!';
                                    } else {
                                        echo date("M dS, Y", strtotime($userinfo->lastpirep));
                                    }
                                ?>
                            </div>
                            <div class="detail-name">Last PIREP</div>
                        </div>
                        <div class="statistic-details-item">
                            <div class="detail-value text-warning"><?php echo date("M dS, Y", strtotime($userinfo->joindate)); ?></div>
                            <div class="detail-name">Joined</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>