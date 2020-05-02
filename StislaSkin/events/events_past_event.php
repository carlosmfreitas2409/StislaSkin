<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Past Event</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Events</a></div>
        <div class="breadcrumb-item"><?php echo SITE_NAME; ?> Past Event</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
			<div class="card-header">
				<h4>Event Details</h4>
			</div>
			<div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <td width="25%">Event:</td>
                        <td width="75%" align="left"><b><?php echo $event->title; ?></b></td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td align="left"><?php echo $event->description; ?></td>
                    </tr>
                    <tr>
                        <td>Scheduled Date:</td>
                        <td align="left"><?php echo date('m/d/Y', strtotime($event->date)); ?></td>
                    </tr>
                    <tr>
                        <td>Scheduled Start Time: (GMT)</td>
                        <td align="left"><?php echo date('G:i', strtotime($event->time)); ?></td>
                    </tr>
                    <tr>
                        <td>Departure Field:</td>
                        <td align="left"><?php echo $event->dep; ?></td>
                    </tr>
                    <tr>
                        <td>Arrival Field:</td>
                        <td align="left"><?php echo $event->arr; ?></td>
                    </tr>
                    <tr>
                        <td>Company Schedule:</td>
                        <td align="left"><?php echo $event->schedule; ?></td>
                    </tr>
                    <tr>
                        <td>Participants:</td>
                        <td align="left">
                            <?php
                                if(!$signups) {
                                    echo 'No Participants';
                                } else {
                                    foreach ($signups as $signup) {
                                        $pilot = PilotData::getPilotData($signup->pilot_id);
                                        echo date('G:i', strtotime($signup->time)).' - ';
                                        echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                        echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if($event->image !='none') { ?>
        <img src="<?php echo $event->image; ?>" class="img-fluid" alt="Event Image" />
        <?php } ?>
    </div>
</div>