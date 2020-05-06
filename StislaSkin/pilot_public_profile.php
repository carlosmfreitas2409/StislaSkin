<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    if(!$pilot) {
        echo '
        <div class="section-header">
            <h1>Pilot Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
                <div class="breadcrumb-item">Pilot Profile</div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary">This pilot does not exist!</div>
            </div>
        </div>';
        return;
    }
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
	<h1>Profile for <?php echo $pilot->firstname; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><?php echo $pilot->firstname; ?> Profile</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-5">
        <div class="card profile-widget">
            <div class="profile-widget-header">
		<?php $publicCode = PilotData::getPilotCode($pilot->code, $pilot->pilotid); ?>
                <img alt="image" src="<?php echo PilotData::getPilotAvatar($publicCode); ?>" class="rounded-circle profile-widget-picture">
                <div class="profile-widget-items">
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Flights</div>
                        <div class="profile-widget-item-value"><?php echo $pilot->totalflights?></div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Miles</div>
                        <div class="profile-widget-item-value"><?php echo StatsData::TotalPilotMiles($publicCode); ?></div>
                    </div>
                    <div class="profile-widget-item">
                        <div class="profile-widget-item-label">Hours</div>
                        <div class="profile-widget-item-value"><?php echo Util::AddTime($pilot->totalhours, $pilot->transferhours); ?></div>
                    </div>
                </div>
            </div>
            <div class="profile-widget-description">
                <div class="profile-widget-name"><?php echo $pilot->firstname . ' ' . $pilot->lastname?>
                    <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $publicCode.' - '.$pilot->rank; ?></div>
                </div>
                <div class="contact-item">
                    <h6>Location</h6>
                    <span class="float-right align-right">
                        <?php echo Countries::getCountryName($pilot->location);?>
                        <img style="margin-left: 7px;" src="<?php echo Countries::getCountryImage($pilot->location); ?>" alt="<?php echo Countries::getCountryName($pilot->location); ?>">
                    </span>
                </div>
                <div class="contact-item">
                    <h6>Awards</h6>
                    <span class="float-right align-right">
                        <?php if(is_array($allawards)) { ?>
                        <ul>
                            <?php
                                foreach($allawards as $award) {
                                /* To show the image:
                                    <img src="<?php echo $award->image?>" alt="<?php echo $award->descrip?>" />
                                */
                            ?>
                                <li><?php echo $award->name ?></li>
                            <?php } ?>
                        </ul>
			            <?php } else { echo 'No awards'; } ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4>Flights Map</h4>
            </div>
            <div class="card-body p-0">
                <?php
                    if(!$pireps) {
                        echo "
                        <div class='card-body'>
                            <div class='alert alert-primary mb-2' role='alert'>
                                <strong>Opss!</strong> ".$pilot->firstname." don't have any flights!
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
