<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<?php
    //simpilotgroup addon module for phpVMS virtual airline system
    //
    //simpilotgroup addon modules are licenced under the following license:
    //Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
    //To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
    //
    //@author David Clark (simpilot)
    //@copyright Copyright (c) 2009-2010, David Clark
    //@license http://creativecommons.org/licenses/by-nc-sa/3.0/
?>

<div class="section-header">
	<h1>Leaderboard</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item">Leaderboard</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>All Time Greats</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-primary">Top Pilots All Time (Flights Flown)</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Pilots</th>
                                    <th scope="row">Flights Flown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $all_flights = TopPilotData::alltime_flights(5);
                                    foreach($all_flights as $all) {
                                        $pilot = PilotData::GetPilotData($all->pilotid);
                                ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $all->totalflights; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <div class="alert alert-primary">Top Pilots All Time (Hours Flown)</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Pilots</th>
                                    <th scope="row">Hours Flown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $all_hours = TopPilotData::alltime_hours(5);
                                    foreach($all_hours as $all) {
                                        $pilot = PilotData::GetPilotData($all->pilotid);
                                ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $all->totalhours; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Current Month Stats</h4>
            </div>
            <div class="card-body">
                <?php
                    $topflights = TopPilotData::top_pilot_flights($today['mon'], $today['year'], 5);

                    if(!$topflights) {
                        $month = date( 'F', mktime(0, 0, 0, $today['mon'])); 
                        echo '<div class="alert alert-primary">No Pireps Filed For '.$month.' '.$today['year'].'</div>';
                    } else {
                        $month_name = date( 'F', mktime(0, 0, 0, $topflights[0]->month) );
                        $tophours = TopPilotData::top_pilot_hours($today['mon'], $today['year'], 5);
                        $topmiles = TopPilotData::top_pilot_miles($today['mon'], $today['year'], 5);
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-primary">Top Pilot for <?php echo $month_name.' '.$topflights[0]->year; ?> (Flights Flown)</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Pilots</th>
                                    <th scope="row">Flights Flown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($topflights as $top) {
                                        $pilot = PilotData::GetPilotData($top->pilot_id);
                                ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $top->flights; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <div class="alert alert-primary">Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> (Hours Flown)</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Pilots</th>
                                    <th scope="row">Hours Flown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($tophours as $top) {
                                        $pilot = PilotData::GetPilotData($top->pilot_id);
                                ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $top->hours; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <div class="alert alert-primary">Top Pilot for <?php echo $month_name.' '.$tophours[0]->year; ?> (Miles Flown)</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="row">Pilots</th>
                                    <th scope="row">Miles Flown</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($topmiles as $top) {
                                        $pilot = PilotData::GetPilotData($top->pilot_id);
                                ?>
                                <tr>
                                    <td><?php echo $pilot->firstname.' '.$pilot->lastname.' - '.PilotData::GetPilotCode($pilot->code, $pilot->pilotid); ?></td>
                                    <td><?php echo $top->miles; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Historical Stats</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <?php
                        while ($startyear <= $today['year']): {
                            $month_name = date( 'F', mktime(0, 0, 0, $startmonth) );
                    ?>
                    <tr>
                        <td><?php echo $month_name.' - '.$startyear; ?></td>
                        <td><a href="<?php echo url('/TopPilot/get_old_stats?month='.$startmonth.'&year='.$startyear.''); ?>">View</a></td>
                    </tr>
                    <?php
                            //advance dates
                            if ($startmonth == $today['mon'] && $startyear == $today['year']) {break;}
                            if ($startmonth == 12) {
                                $startyear++; $startmonth = 01;
                            } else {
                                $startmonth++;
                            }
                        } endwhile;
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
