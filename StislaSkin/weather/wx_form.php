<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
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

    .input-group-append input[type="submit"] {
        position: relative; 
        font-family: "Font Awesome 5 Free";
    }
</style>

<div class="section-header">
	<h1>Weather</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">Weather</div>
    </div>
</div>

<div class="section-body">
    <h2 class="section-title">Locations Worldwide</h2>
    <p class="section-lead">
        Reports come from airports, military bases or permanent weather observation stations and are generated once an hour or half-hour, unless conditions change significantly.
    </p>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Airport Search</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo url('/weather'); ?>">
                    <div class="input-group">
                        <input type="text" name="icao"  class="form-control" placeholder="Search for Airport ICAO...">
                        <div class="input-group-append">
                            <input type="hidden" name="loggedin" value="<?php echo (Auth::LoggedIn())?'true':'false'?>" />
                            <input type="submit" name="submit" value="&#xf002;" class="btn btn-primary" />
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Current Location Weather</h4>
            </div>
            <div class="card-body">
                <?php 
                    if(!$last_location) {
                        echo "<div class='alert alert-primary alert-has-icon'><div class='alert-icon'><i class='far fa-lightbulb'></i></div><div class='alert-body'><div class='alert-title'>Oh... What?</div>You're at home! We only know the weather on airports!</div></div>";
                    } else { 
                ?>
                <div class="col-md-9" style="float: none; margin: auto;">
                    <div style="text-align: center; border-radius: 18px; padding: 5px; margin-bottom: 1.5rem; font-weight: 620;" class="alert alert-primary">
                        <?php echo $currentMetar['data'][0]['raw_text']; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h5 style="text-align: center; margin-bottom: 15px;">
                            <?php echo $currentMetar['data'][0]['icao'].' - '.$currentMetar['data'][0]['station']['name']; ?>
                        </h5>
                        <div class="contact-item">
                            <h6>Observed</h6>
                            <span class="float-right">
                                <?php 
                                    $currentCondition = $currentMetar['data'][0]['observed']; 
                                    $currentDate = new DateTime($currentCondition);
                                    echo $currentDate->format("M-d @ H:i");
                                ?>
                                UTC
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Wind</h6>
                            <span class="float-right align-right"><?php echo $currentMetar['data'][0]['wind']['degrees'].'º at '.$currentMetar['data'][0]['wind']['speed_kts'].' KTS'; ?></span>
                        </div>
                        <div class="contact-item">
                            <h6>Visibility</h6>
                            <span class="float-right align-right">
                                <?php
                                    $currentVisibility = $currentMetar['data'][0]['visibility']['meters'];
                                    if($currentVisibility > "10000") {
                                        echo "10,000+ meters";
                                    } else {
                                        echo $currentVisibility.' meters';
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Flight Rules</h6>
                            <span class="float-right align-right">
                                <?php
                                    $currentFlrules = $currentMetar['data'][0]['flight_category'];
                                    if($currentFlrules == "VFR") {
                                        echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-success">'.$currentFlrules.'</div>';
                                    } elseif($currentFlrules == "IFR") {
                                        echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-danger">'.$currentFlrules.'</div>';
                                    } elseif($currentFlrules == "MVFR") {
                                        echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-info">'.$currentFlrules.'</div>';
                                    } elseif($currentFlrules == "LIFR") {
                                        echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-warning">'.$currentFlrules.'</div>';
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Cloud Levels</h6>
                            <span class="float-right align-right">
                                <?php 
                                    foreach($currentMetar['data'][0]['clouds'] as $currentCloud) {
                                        if($currentCloud['text'] == "Clear skies") {
                                            echo $currentCloud['text'];
                                        } else {
                                            echo $currentCloud['text'].' at '.$currentCloud['base_feet_agl'].'\' AGL <br/>';
                                        }
                                    }
                                ?>
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Temperature</h6>
                            <span class="float-right align-right">
                                <?php echo $currentMetar['data'][0]['temperature']['celsius'].'ºC / '.$currentMetar['data'][0]['temperature']['fahrenheit']; ?>ºF
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Dewpoint</h6>
                            <span class="float-right align-right">
                                <?php echo $currentMetar['data'][0]['dewpoint']['celsius'].'ºC / '.$currentMetar['data'][0]['dewpoint']['fahrenheit']; ?>ºF
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Humidity</h6>
                            <span class="float-right align-right">
                                <?php echo $currentMetar['data'][0]['humidity']['percent']; ?>%
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Altimeter</h6>
                            <span class="float-right align-right">
                                <?php echo $currentMetar['data'][0]['barometer']['hg'].'" Hg'; ?>
                            </span>
                        </div>
                        <div class="contact-item">
                            <h6>Pressure</h6>
                            <span class="float-right align-right">
                                <?php echo $currentMetar['data'][0]['barometer']['mb'].' hPa'; ?>
                            </span>
                        </div>

                        <?php if(isset($currentMetar['data'][0]['conditions']) && count($currentMetar['data'][0]['conditions']) > 0) { ?>
                        <div class="contact-item">
                            <h6>Conditions</h6>
                            <span class="float-right align-right">
                                <?php 
                                    foreach($currentMetar['data'][0]['conditions'] as $currentCond) {
                                        echo $currentCond['text'];
                                    }
                                ?>
                            </span>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <iframe style="width: 100%; height: 500px; border-radius: 8px;" src="https://embed.windy.com/embed2.html?lat=<?php echo $currentMetar['data'][0]['location']['coordinates'][1]; ?>&lon=<?php echo $currentMetar['data'][0]['location']['coordinates'][0]; ?>&zoom=10&level=surface&overlay=wind&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=-25.988&detailLon=-46.626&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>