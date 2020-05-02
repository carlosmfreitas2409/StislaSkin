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

    $month_name = date( 'F', mktime(0, 0, 0, $month) );
?>

<div class="section-header">
	<h1><?php echo $month_name.' '.$year; ?> Stats</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Pilot Administration</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Leaderboard</a></div>
        <div class="breadcrumb-item"><?php echo $month_name.' '.$year; ?> Stats</div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <?php 
                    if(!$topflights) {
                        echo '<div class="alert alert-primary">No Pireps Filed.</div>';
                    } else { 
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <?php $month_name = date('F', mktime(0, 0, 0, $topflights[0]->month)); ?>
                        <div class="alert alert-primary">Top Pilots for <?php echo $month_name.' '.$topflights[0]->year; ?> (Flights Flown)</div>
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
                        <div class="alert alert-primary">Top Pilots for <?php echo $month_name.' '.$tophours[0]->year; ?> (Hours Flown)</div>
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
                        <div class="alert alert-primary">Top Pilots for <?php echo $month_name.' '.$tophours[0]->year; ?> (Miles Flown)</div>
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

        <center>
            <form method="link" action="<?php echo url('TopPilot'); ?>">
                <input type="submit" class="mail btn btn-primary" value="Current Month">
            </form>
		</center>
    </div>
</div>