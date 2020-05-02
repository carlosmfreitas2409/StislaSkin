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
	<h1>Flight <?php echo $pirep->code . $pirep->flightnum; ?></h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">PIREPs List</a></div>
        <div class="breadcrumb-item">Flight <?php echo $pirep->code . $pirep->flightnum; ?></div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Flight</h4>
                <div class="card-header-action">
                    <ul class="nav nav-pills" id="myTab3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="false">Log</a>
                        </li>
                    </ul>
				</div>
            </div>
            <div class="card-body">
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Pilot:</strong>
                                        <a href="<?php echo SITE_URL.'/index.php/profile/view/'.$pirep->pilotid?>"><?php echo $pirep->firstname.' ('.PilotData::GetPilotCode($pirep->code, $pirep->pilotid).')'; ?></a>
                                    </li>
                                    <li>
                                        <strong>Aircraft:</strong>
                                        <a href="<?php echo SITE_URL; ?>/index.php/fleet/view/<?php echo $pirep->aircraftid; ?>" data-toggle="tooltip" data-placement="bottom" title="More informations"><?php echo $pirep->aircraft." ($pirep->registration)"?></a>
                                    </li>
                                    <li>
                                        <strong>Departure:</strong>
                                        <a href="<?php echo SITE_URL; ?>/index.php/airports/get_airport?icao=<?php echo $pirep->depicao; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $pirep->depicao; ?> - More informations"><?php echo $pirep->depname; ?></a>
                                    </li>
                                    <li>
                                        <strong>Source:</strong>
                                        <?php echo ucfirst($pirep->source); ?>
                                    </li>

                                    <br>

                                    <li>
                                        <strong>Flight Time:</strong>
                                        <?php echo $pirep->flighttime_stamp; ?>
                                    </li>
                                    <li>
                                        <strong>Distance:</strong>
                                        <?php echo $pirep->distance; ?>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <strong>Rank:</strong>
                                        <?php echo $pirep->rank; ?>
                                    </li>
                                    <li>
                                        <strong>Callsign:</strong>
                                        <?php echo $pirep->code . $pirep->flightnum; ?>
                                    </li>
                                    <li>
                                        <strong>Arrival:</strong>
                                        <a href="<?php echo SITE_URL; ?>/index.php/airports/get_airport?icao=<?php echo $pirep->arricao; ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $pirep->arricao; ?> - More informations"><?php echo $pirep->arrname; ?></a>
                                    </li>
                                    <li>
                                        <strong>PIREP Filed:</strong>
                                        <?php echo date("M-d Y", $pirep->submitdate);?>
                                    </li>

                                    <br>

                                    <li>
                                        <strong>Landing Rate:</strong>
                                        <?php echo $pirep->landingrate; ?>
                                    </li>
                                    <li>
                                        <strong>Status:</strong>
                                        <?php
                                            if($pirep->accepted == PIREP_ACCEPTED)
                                                echo '<span class="text-success">Accepted</span>';
                                            elseif($pirep->accepted == PIREP_REJECTED)
                                                echo '<span class="text-danger">Rejected</span>';
                                            elseif($pirep->accepted == PIREP_PENDING)
                                                echo '<span class="text-warning">Pending</span>';
                                            elseif($pirep->accepted == PIREP_INPROGRESS)
                                                echo '<span class="text-info">Flight in Progress</span>';
                                        ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="log" role="tabpanel" aria-labelledby="log-tab">
                        <pre style="overflow-y: scroll; height: 300px;"><?php if(!$pirep->log) { echo 'There is no log for this flight'; } else { $pirep->log; } ?></pre>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($pirep->pilotid != Auth::$pilot->pilotid) { } else {?>
        <div class="card">
            <div class="card-header">
                <h4>Comments</h4>
            </div>
            <div class="card-body">
                <div class="comments">
                    <?php 
                        $comments = PIREPData::GetComments($pirep->id);
                        if(!$comments) {
                            echo 'There are no comments for this PIREP.<br/><br/>';
                        } else {
                            foreach($comments as $comment) {
                    ?>
                    <strong><?php echo $comment->firstname. ' '. $comment->lastname ?>:</strong> 
                    <?php echo $comment->comment; ?> <br/><br/>
                    <?php } } ?>
                </div>

                <form action="<?php echo url('/pireps/viewpireps');?>" method="post">
                    <div class="form-group">
                        <textarea name="comment" rows="1" style="height: 39px !important;" class="form-control" placeholder="Add PIREP Comments"></textarea>
                    </div>

                    <input type="hidden" name="action" value="addcomment" />
                    <input type="hidden" name="pirepid" value="<?php echo $pirep->pirepid?>" />
                    <input type="submit" name="submit" style="width: 100%" class="btn btn-primary" value="Add Comment" />
                </form>
            </div>
        </div>
        <?php } ?>

        <div class="card">
            <div class="card-header">
                <h4>Flight Details</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Gross Revenue: <br /> 
                            (<?php echo $pirep->load;?> load / <?php echo FinanceData::FormatMoney($pirep->price);?> per unit</th>
                        <td align="right"><?php echo FinanceData::FormatMoney($pirep->load * $pirep->price);?></td>
                    </tr>
                    <tr>
                        <th>Fuel Cost: <br />
                            (<?php echo $pirep->fuelused;?> fuel used @ <?php echo $pirep->fuelunitcost?> / unit)</th>
                        <td align="right"><?php echo FinanceData::FormatMoney($pirep->fuelused * $pirep->fuelunitcost);?></td>
                    </tr>
                </table>
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
                        if(!$pirep->route) {
                            echo 'This route don\'t have a route';
                        } else {
                            echo $pirep->route;
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
                <?php require 'route_map.php'; ?>
            </div>
        </div>
    </div>
</div>