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

	.input-group-btn input[type="submit"] {
        position: relative; 
        font-family: "Font Awesome 5 Free";
    }
</style>

<div class="section-header">
	<h1><?php echo $icao; ?> Weather</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><?php echo $icao; ?> Weather</div>
    </div>
</div>

<div class="section-body">
    <h2 class="section-title"><?php echo $station['data'][0]['name']; ?></h2>
    <p class="section-lead">
		<?php echo $station['data'][0]['city'].', '.$station['data'][0]['country']['name']; ?>
		<img src="<?php echo SITE_URL;?>/lib/images/countries/<?php echo strtolower($station['data'][0]['country']['code']); ?>.png" alt="<?php echo $station['data'][0]['country']['code']; ?>" style="height: 13px; margin-bottom: 3px; margin-left: 4px;"/>
	</p>
	
	<div class="row">
		<div class="col-12">
			<div class="card mb-0">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-9">
							<ul class="nav nav-pills" id="wxTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="airport-tab" data-toggle="tab" href="#airportTab" role="tab" aria-controls="airport" aria-selected="true">Airport</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="metar-tab" data-toggle="tab" href="#metarTab" role="tab" aria-controls="metar" aria-selected="false">METAR</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="taf-tab" data-toggle="tab" href="#tafTab" role="tab" aria-controls="tafs" aria-selected="false">TAF</a>
								</li>
							</ul>
						</div>

						<div class="col-sm-3" style="align-self: center;">
							<form method="post" action="<?php echo url('/weather'); ?>">
								<div class="input-group">
									<input type="text" name="icao" class="form-control" placeholder="Search for Airport ICAO" style="border-radius: 30px 0 0 30px !important; height: 36px;">
									<div class="input-group-btn">
										<input type="hidden" name="loggedin" value="<?php echo (Auth::LoggedIn())?'true':'false'?>" />
										<input type="submit" name="submit" class="btn btn-primary" value="&#xf002;" style="border-radius: 0 30px 30px 0 !important; padding: 4.6px 15px; padding-left: 13px !important; padding-right: 13px !important;">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row mt-4">
	<div class="col-lg-12 col-md-12 col-12 col-sm-12">
		<div class="tab-content" id="wxTabContent">
			
			<div class="tab-pane fade show active" id="airportTab" role="tabpanel" aria-labelledby="airport-tab">
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div class="card-contact">
									<div class="contact-item">
										<h6>ICAO</h6>
										<span class="float-right"><?php echo $station['data'][0]['icao']; ?></span>
									</div>
									<div class="contact-item">
										<h6>IATA</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['iata']; ?></span>
									</div>
									<div class="contact-item">
										<h6>Latitude</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['latitude']['degrees'].'<br/>'.$station['data'][0]['latitude']['decimal']; ?></span>
									</div>
									<div class="contact-item">
										<h6>Longitude</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['longitude']['degrees'].'<br/>'.$station['data'][0]['longitude']['decimal']; ?></span>
									</div>
									<div class="contact-item">
										<h6>Elevation</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['elevation']['feet']; ?>'</span>
									</div>
									<div class="contact-item">
										<h6>Facility</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['type']; ?></span>
									</div>
									<div class="contact-item">
										<h6>Status</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['status']; ?></span>
									</div>
								</div>
							</div>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="card-contact">
									<div class="contact-item">
										<h6>Timezone</h6>
										<span class="float-right"><?php echo $station['data'][0]['timezone']['tzid']; ?></span>
									</div>
									<div class="contact-item">
										<h6>GMT Offset</h6>
										<span class="float-right align-right"><?php echo $station['data'][0]['timezone']['dst']; ?> hours</span>
									</div>
									<div class="contact-item">
										<h6>Current Time</h6>
										<span class="float-right align-right">
											<?php
												$date = new DateTime("now", new DateTimeZone($station['data'][0]['timezone']['tzid']));
												echo $date->format('M-d H:i');
											?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Sunrise</h6>
										<span class="float-right align-right">
											<?php echo date_sunrise(time(), SUNFUNCS_RET_STRING, $station['data'][0]['latitude']['decimal'], $station['data'][0]['longitude']['decimal']); ?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Sunset</h6>
										<span class="float-right align-right">
											<?php echo date_sunset(time(), SUNFUNCS_RET_STRING, $station['data'][0]['latitude']['decimal'], $station['data'][0]['longitude']['decimal']); ?>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<div id="airportmap" style="border-radius: 9px; width: 100%; height: 540px; position: relative; overflow: hidden;"></div>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="metarTab" role="tabpanel" aria-labelledby="metar-tab">
				<div class="row">
					<div class="col-md-4">
						<div class="card">
							<div class="card-body">
								<div style="text-align: center; border-radius: 18px; padding: 5px; margin-bottom: 1.5rem; font-weight: 620;" class="alert alert-primary">
									<?php echo $metar['data'][0]['raw_text']; ?>
								</div>

								<div class="card-contact">
									<div class="contact-item">
										<h6>Observed</h6>
										<span class="float-right">
											<?php 
												$condition = $metar['data'][0]['observed']; 
												$date = new DateTime($condition);
												echo $date->format("M-d @ H:i");
											?>
											UTC
										</span>
									</div>
									<div class="contact-item">
										<h6>Wind</h6>
										<span class="float-right align-right"><?php echo $metar['data'][0]['wind']['degrees'].'º at '.$metar['data'][0]['wind']['speed_kts'].' KTS'; ?></span>
									</div>
									<div class="contact-item">
										<h6>Visibility</h6>
										<span class="float-right align-right">
											<?php
												$visibility = $metar['data'][0]['visibility']['meters'];
												if($visibility > "10000") {
													echo "10,000+ meters";
												} else {
													echo $visibility.' meters';
												}
											?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Flight Rules</h6>
										<span class="float-right align-right">
											<?php
												$flrules = $metar['data'][0]['flight_category'];
												if($flrules == "VFR") {
													echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-success">'.$flrules.'</div>';
												} elseif($flrules == "IFR") {
													echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-danger">'.$flrules.'</div>';
												} elseif($flrules == "MVFR") {
													echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-info">'.$flrules.'</div>';
												} elseif($flrules == "LIFR") {
													echo '<div style="margin-bottom: 6px;" class="badge badge-pill badge-warning">'.$flrules.'</div>';
												}
											?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Cloud Levels</h6>
										<span class="float-right align-right">
											<?php 
												foreach($metar['data'][0]['clouds'] as $cloud) {
													if($cloud['text'] == "Clear skies") {
														echo $cloud['text'];
													} else {
														echo $cloud['text'].' at '.$cloud['base_feet_agl'].'\' AGL <br/>';
													}
												}
											?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Temperature</h6>
										<span class="float-right align-right">
											<?php echo $metar['data'][0]['temperature']['celsius'].'ºC / '.$metar['data'][0]['temperature']['fahrenheit']; ?>ºF
										</span>
									</div>
									<div class="contact-item">
										<h6>Dewpoint</h6>
										<span class="float-right align-right">
											<?php echo $metar['data'][0]['dewpoint']['celsius'].'ºC / '.$metar['data'][0]['dewpoint']['fahrenheit']; ?>ºF
										</span>
									</div>
									<div class="contact-item">
										<h6>Humidity</h6>
										<span class="float-right align-right">
											<?php echo $metar['data'][0]['humidity']['percent']; ?>%
										</span>
									</div>
									<div class="contact-item">
										<h6>Altimeter</h6>
										<span class="float-right align-right">
											<?php echo $metar['data'][0]['barometer']['hg'].'" Hg'; ?>
										</span>
									</div>
									<div class="contact-item">
										<h6>Pressure</h6>
										<span class="float-right align-right">
											<?php echo $metar['data'][0]['barometer']['mb'].' hPa'; ?>
										</span>
									</div>

									<?php if(isset($metar['data'][0]['conditions']) && count($metar['data'][0]['conditions']) > 0) { ?>
									<div class="contact-item">
										<h6>Conditions</h6>
										<span class="float-right align-right">
											<?php 
												foreach($metar['data'][0]['conditions'] as $cond) {
													echo $cond['text'];
												}
											?>
										</span>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-8">
						<iframe style="width: 100%; height: 540px; border-radius: 8px;" src="https://embed.windy.com/embed2.html?lat=<?php echo $station['data'][0]['latitude']['decimal']; ?>&lon=<?php echo $station['data'][0]['longitude']['decimal']; ?>&zoom=10&level=surface&overlay=wind&menu=&message=&marker=&calendar=&pressure=&type=map&location=coordinates&detail=&detailLat=-25.988&detailLon=-46.626&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe>
					</div>
				</div>
			</div>

			<div class="tab-pane fade" id="tafTab" role="tabpanel" aria-labelledby="taf-tab">
				<div class="row">
					<div class="col-md-12">
						<div class="card">
							<div class="card-body">
								<div style="text-align: center; border-radius: 18px; padding: 5px; margin-bottom: 1.5rem; font-weight: 620;" class="alert alert-primary">
									<?php echo $taf['data'][0]['raw_text']; ?>
								</div>

								<div class="card-contact">
									<div class="row">
										<?php
											// Get current time
											$currentTime = new DateTime();

											// DateTime if timestamp JSON
											$dtFrom = new DateTime($taf['data'][0]['timestamp']['from']);
											$dtfTo = new DateTime($taf['data'][0]['timestamp']['to']);

											// Diference between current time and timestamp
											$diffFrom = time() - strtotime($taf['data'][0]['timestamp']['from']);
											$diffTo = strtotime($taf['data'][0]['timestamp']['to']) - time();
										?>
										<div class="col-12 col-md-4">
											<div class="contact-item">
												<h6>Wind</h6>
												<span class="float-right align-right"><?php echo $taf['data'][0]['forecast'][0]['wind']['degrees'].'º at '.$taf['data'][0]['forecast'][0]['wind']['speed_kts'].' KTS'; ?></span>
											</div>
											<div class="contact-item">
												<h6>Cloud Levels</h6>
												<span class="float-right align-right">
													<?php 
														foreach($taf['data'][0]['forecast'][0]['clouds'] as $tafcloud) {
															if($tafcloud['text'] == "Clear skies") {
																echo $tafcloud['text'];
															} else {
																echo $tafcloud['text'].' at '.$tafcloud['base_feet_agl'].'\' AGL <br/>';
															}
														}
													?>
												</span>
											</div>
										</div>

										<div class="col-12 col-md-4">
											<div style="border-bottom: 1px solid #dee2e6;" class="contact-item">
												<h6>Valid Time From</h6>
											</div>
											<p>
												<?php echo $dtFrom->format("M-d @ H:i");  ?> UTC
												<br/>
												<?php echo date("j \\d\a\y\, G \\h\o\u\\r\s\, i \\m\i\\n\s \\a\g\o", $diffFrom); ?>
											</p>
										</div>

										<div class="col-12 col-md-4">
											<div style="border-bottom: 1px solid #dee2e6;" class="contact-item">
												<h6>Valid Time To</h6>
											</div>
											<p>
												<?php echo $dtfTo->format("M-d @ H:i");  ?> UTC
												<br/>
												<?php echo date("j \\d\a\y\, G \\h\o\u\\r\s\, i \\m\i\\n\s \\f\\r\o\m\ \\n\o\w", $diffTo); ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo SITE_URL?>/lib/js/base_map.js"></script>
<script type="text/javascript">
	const map = createMap ({
		render_elem: 'airportmap',
		provider: '<?php echo Config::Get("MAP_TYPE"); ?>',
		zoom: 14,
		center: L.latLng("<?php echo $station['data'][0]['latitude']['decimal']; ?>", "<?php echo $station['data'][0]['longitude']['decimal']; ?>")
	});

	L.marker(["<?php echo $station['data'][0]['latitude']['decimal']; ?>", "<?php echo $station['data'][0]['longitude']['decimal']; ?>"]).addTo(map)
</script>