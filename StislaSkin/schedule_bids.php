<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<style>
    pre {
        display: block;
        padding: 9.5px;
        margin: 0 0 10px;
        font-size: 13px;
        line-height: 1.4;
        word-break: break-all;
        color: #333;
        background-color: #f5f5f5;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .comments p {
        display: inline;
    }
</style>
<div class="section-header">
	<h1>My Reservations</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item">My Reservations</div>
    </div>
</div>

<div class="row">
    <?php
        $bids = FltbookData::getBidsForPilot(Auth::$userinfo->pilotid);
        if(!$bids) {
            echo '<div class="col-md-12"><div class="alert alert-danger">You have not bid on any flights</div></div>';
        } else {
            foreach($bids as $bid) {
                $depAirport = OperationsData::getAirportInfo($bid->depicao);
                $arrAirport = OperationsData::getAirportInfo($bid->arricao);
    ?>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Flight Informations</h4>
                <div class="card-header-action">
                   <a href="<?php echo SITE_URL;?>/index.php/Weather" target="_blank" class="btn btn-primary">Weather</a>
				</div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Departure:</strong>
                                <a href="javascript::" data-toggle="tooltip" data-placement="bottom" title="<?php echo $depAirport->name; ?>"><?php echo $bid->depicao; ?></a>
                            </li>
                            <li>
                                <strong>Callsign:</strong>
                                <?php echo $bid->code . $bid->flightnum; ?>
                            </li>
                            <li>
                                <strong>Flight Level:</strong>
                                <?php echo $bid->flightlevel;?>
                            </li>
                            <li>
                                <strong>Distance:</strong>
                                <?php echo $bid->distance;?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li>
                                <strong>Arrival:</strong>
                                <a href="javascript::" data-toggle="tooltip" data-placement="bottom" title="<?php echo $arrAirport->name; ?>"><?php echo $bid->arricao; ?></a>
                            </li>
                            <li>
                                <strong>Aircraft:</strong>
                                <?php echo $bid->aircraft; ?> (<?php echo $bid->registration?>)
                            </li>
                            <li>
                                <strong>Price:</strong>
                                <?php echo $bid->price; ?>
                            </li>
                            <li>
                                <strong>Flight Length:</strong>
                                <?php echo date("H:i", strtotime($bid->flighttime));?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Flight Options</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="<?php echo url('/schedules/brief/'.$bid->id);?>" class="btn btn-primary" style="width: 100%">Simbrief OFP</a>
                        <br/><br/>
                        <a href="<?php echo url('/pireps/filepirep/'.$bid->bidid);?>" class="btn btn-warning" style="width: 100%">Manual PIREP</a>
                    </div>
                    <div class="col-md-6">
                        <?php $aircraft = OperationsData::getAircraftByReg($bid->registration); ?>
                        <a target="_blank" href="http://www.vatsim.net/fp/index.php?fpc=&amp;2=<?php echo $bid->code . $bid->flightnum; ?>&amp;3=<?php echo $aircraft->icao; ?>&amp;5=<?php echo $bid->depicao; ?>&amp;7=<?php echo $bid->flightlevel;?>&amp;8=<?php echo $bid->route; ?>&amp;9=KATL&amp;11=<?php echo $bid->registration; ?> OPR/<?php echo preg_replace('#^https?://#', '', SITE_URL); ?>&amp;14=<?php echo Auth::$userinfo->firstname.' '.Auth::$userinfo->lastname; ?>" class="btn btn-primary" style="width: 100%">Vatsim Pre-File</a>
                        <br/><br/>
                        <a id="<?php echo $bid->bidid; ?>" class="deleteitem btn btn-danger" href="<?php echo url('/schedules/removebid');?>" style="width: 100%">Cancel Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Route</h4>
            </div>
            <div class="card-body">
                <blockquote>
                    <?php 
                        if(!$bid->route) {
                            echo 'This route don\'t have a route';
                        } else {
                            echo $bid->route;
                        }  
                    ?>
                </blockquote>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>Flight Map</h4>
            </div>
            <div class="card-body p-0">
                <?php require 'bids_map.php'; ?>
            </div>
        </div>
    </div>
    <?php } } ?>
</div>