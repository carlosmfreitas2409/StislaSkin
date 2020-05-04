<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php if(Auth::LoggedIn()) { ?>
<?php
	$userinfo = Auth::$userinfo;

	$hrs = intval($userinfo->totalhours);
	$min = ($userinfo->totalhours - $hrs) * 100;

	$touchstats = TouchdownStatsData::pilot_average($userinfo->pilotid);

	$events = EventsData::get_upcoming_events();

	$config = json_decode(file_get_contents(SITE_URL.'/lib/skins/StislaSkin/config.json'));

	if($config->dashboard == "1" || $config->dashboard == null) {
?>

<div class="section-header">
	<h1>Dashboard</h1>
</div>

<div class="row">
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-primary">
				<i class="fas fa-user"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Pireps Filed</h4>
				</div>
				<div class="card-body"><?php echo $userinfo->totalflights; ?></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-danger">
				<i class="fas fa-user"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Miles Earned</h4>
				</div>
				<div class="card-body"><?php echo StatsData::TotalPilotMiles($userinfo->pilotid); ?></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-info">
				<i class="fas fa-user"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Time Flown</h4>
				</div>
				<div class="card-body"><?php echo $hrs.'h '.$min.'m';?></div>
			</div>
		</div>
	</div>
	<div class="col-lg-3 col-md-6 col-sm-6 col-12">
		<div class="card card-statistic-1">
			<div class="card-icon bg-success">
				<i class="fas fa-user"></i>
			</div>
			<div class="card-wrap">
				<div class="card-header">
					<h4>Landing Average</h4>
				</div>
				<div class="card-body"><?php echo substr($touchstats, 0, 4); ?> FPM</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Live Map</h4>
			</div>
			<div class="card-body p-0">
				<?php require 'acarsmap.php'; ?>
			</div>
		</div>

		<?php
			$lastbids = SchedulesData::GetAllBids();
			$countBids = (is_array($lastbids) ? count($lastbids) : 0);
		?>
		<div class="card">
			<div class="card-header">
				<h4>Upcoming Departure</h4>
				<div class="card-header-action">
					<?php if(!$countBids) { ?>
					<a href="javascript::" class="btn btn-info">No Departures</a>
					<?php } else { ?>
					<a href="javascript::" class="btn btn-success">Upcoming</a>
					<?php } ?>
				</div>
			</div>
			<div class="card-body">
				<?php if(!$countBids) { ?>
				<div class="alert alert-danger">
					<div class="alert-title">Oops</div>
					Looks like there are no upcoming departures at the moment, do you feel like flying? Click <a href="<?php echo SITE_URL?>/index.php/fltbook">here</a> to bid a flight!
				</div>
				<?php } else { ?>

				<table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                <div align="center">Flight #</div>
                            </th>
                            <th>
                                <div align="center">Pilot</div>
                            </th>
                            <th>
                                <div align="center">Slot added on</div>
                            </th>
                            <th>
                                <div align="center">Slot Expires on</div>
                            </th>
                            <th>
                                <div align="center">Departure</div>
                            </th>
                            <th>
                                <div align="center">Arrival</div>
                            </th>
                            <th>
                                <div align="center">Registration</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							foreach($lastbids as $lastbid) {
								$flightid = $lastbid->id
						?>
						<tr>
							<td height="25" width="10%" align="center"><font face="Bauhaus"><span><?php echo $lastbid->code; ?><?php echo $lastbid->flightnum; ?></span></font></td>
							<?php
								$params = $lastbid->pilotid;

								$pilot = PilotData::GetPilotData($params);
								$pname = $pilot->firstname;
								$psurname = $pilot->lastname;
								$now = strtotime(date('d-m-Y',strtotime($lastbid->dateadded)));
								$date = date("d-m-Y", strtotime('+48 hours', $now));
							?>
							<td height="25" width="10%" align="center"><span><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Pilot Information!" href="  '.SITE_URL.'/index.php/profile/view/'.$pilot->pilotid.'">'.$pname.'</a>';?></span></td>
							<td height="25" width="10%" align="center"><span class="text-success"><?php echo date('d-m-Y',strtotime($lastbid->dateadded)); ?></span></td>
							<td height="25" width="10%" align="center"><span class="text-danger"><?php echo $date; ?></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="  '.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->depicao.'">'.$lastbid->depicao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><font face=""><?php echo '<a class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Airport Information!" href="'.SITE_URL.'/index.php/airports/get_airport?icao='.$lastbid->arricao.'">'.$lastbid->arricao.'</a>';?></font></span></td>
							<td height="25" width="10%" align="center"><span><a class="btn btn- btn-sm" data-toggle="tooltip" data-placement="top" title="Click to view Aircraft Information!" href="<?php echo SITE_URL?>/index.php/Fleet/view/<?php echo '' . $lastbid->id . ''; ?>"><?php echo $lastbid->aircraft; ?></a></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php } ?>
			</div>
		</div>
	</div>

	<div class="col-lg-4 col-md-12 col-12 col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4>Airline NOTAMs</h4>
				<div class="card-header-action">
					<a data-collapse="#collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
				</div>
			</div>
			<div class="collapse show" id="collapse">
				<div class="card-body">
					<?php MainController::Run('News', 'ShowNewsFront', 1); ?>
				</div>
			</div>
		</div>

		<div class="card">
			<div class="card-header">
				<h4>Top Pilots</h4>
				<div class="card-header-action">
					<a class="btn btn-icon btn-primary" href="javascript::">By Hours</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="row">Pilots</th>
								<th scope="row">Flights</th>
								<th scope="row">Miles</th>
								<th scope="row">Hours</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$all_hours = TopPilotData::alltime_hours(5);
								foreach($all_hours as $all) {
									$pilot = PilotData::GetPilotData($all->pilotid);
							?>
							<tr>
								<td><a href="<?php echo SITE_URL.'/index.php/profile/view/'.$pilot->pilotid?>"><?php echo $pilot->firstname.' ('.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?>)</a></td>
								<td><?php echo $pilot->totalflights; ?></td>
								<td><?php echo StatsData::TotalPilotMiles($pilot->pilotid); ?></td>
								<td><b><?php echo $all->totalhours; ?></b></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<?php
			if($config->discordID) {
		?>
		<div class="card">
		<iframe src="https://discordapp.com/widget?id=<?php echo $config->discordID; ?>&theme=dark" height="400" allowtransparency="true" frameborder="0"></iframe>
			</div>
		<?php } ?>

		<?php
			if($event) {
				foreach($events as $event) {
		?>
		<div class="card">
			<div class="card-header">
				<h4>Upcoming Events</h4>
				<div class="card-header-action">
					<a href="<?php echo SITE_URL.'/index.php/events/get_event?id='.$event->id; ?>" class="btn btn-info"><?php echo $event->title; ?></a>
				</div>
			</div>
			<div class="card-body p-0">
				<a href="<?php echo SITE_URL.'/index.php/events/get_event?id='.$event->id; ?>">
					<img class="img-fluid" src="<?php echo $event->image; ?>" alt="<?php echo $event->title; ?>">
				</a>
			</div>
		</div>
		<?php break; } } ?>
	</div>
</div>
<?php
		} else {
			require 'frontpage_main_two.php';
		}
	} else {
		header('Location:'.SITE_URL.'/index.php/login');
	}
?>
