<?php if(!defined('IN_PHPVMS') && IN_PHPVMS !== true) { die(); } ?>
<div class="section-header">
	<h1><?php echo SITE_NAME; ?> Event</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo SITE_URL; ?>">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Flight Operations</a></div>
        <div class="breadcrumb-item"><a href="javascript::">Events</a></div>
        <div class="breadcrumb-item"><?php echo SITE_NAME; ?> Event</div>
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
                        <td scope="col" width="25%">Event:</td>
                        <td width="75%" align="left"><b><?php echo $event->title; ?></b></td>
                    </tr>
                    <tr>
                        <td scope="col">Description:</td>
                        <td align="left"><?php echo $event->description; ?></td>
                    </tr>
                    <tr>
                        <td scope="col">Scheduled Date:</td>
                        <td align="left"><?php echo date('m/d/Y', strtotime($event->date)); ?></td>
                    </tr>
                    <tr>
                        <td scope="col">Scheduled Start Time: (GMT)</td>
                        <td align="left"><?php echo date('G:i', strtotime($event->time)); ?></td>
                    </tr>
                    <tr>
                        <td scope="col">Departure Field:</td>
                        <td align="left"><?php echo $event->dep; ?></td>
                    </tr>
                    <tr>
                        <td scope="col">Arrival Field:</td>
                        <td align="left"><?php echo $event->arr; ?></td>
                    </tr>
                    <tr>
                        <td scope="col">Company Schedule:</td>
                        <td align="left"><?php echo $event->schedule; ?></td>
                    </tr>

                    <?php if(!Auth::LoggedIn()) { ?>
                    <tr>
                        <td>Current Signups:</td>
                        <td align="left">
                            <?php
                                $count=0;
                                if (!$signups) {
                                    echo 'No Signups';
                                } else {
                                    foreach ($signups as $signup) {
                                        $pilot = PilotData::getPilotData($signup->pilot_id);
                                        echo date('G:i', strtotime($signup->time)).' - ';
                                        echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                        echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                        $count++;
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                    <?php } else { ?>
                    <tr>
                        <?php
                            $check = EventsData::check_signup(Auth::$userinfo->pilotid, $event->id);
                            if($check->total >= '1') {
                                echo '<td>You Are Already Signed Up For This Event</td>';

                                echo '<td align="left">';
                                    $slot_time = strtotime($event->time);
                                    $slots=1;
                                    while ($slots <= $event->slot_limit):
                                        $test = date('G:i',$slot_time);
                                        $check2 = EventsData::signup_time($event->id, $test);
                                        if(!$check2) {
                                            echo date('G:i', $slot_time).' - Open<br />';
                                            $slots++;
                                        } else {
                                            $pilot = PilotData::getPilotData($check2->pilot_id);
                                            echo date('G:i', $slot_time).' - ';
                                            echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                            echo $pilot->firstname.' '.$pilot->lastname;
                                            if($pilot->pilotid == Auth::$pilotid) {echo ' <a href="'.SITE_URL.'/index.php/events/remove_signup?id='.$pilot->pilotid.'&event='.$event->id.'">- Remove</a>';}
                                            echo '<br />';
                                        }
                                        $slot_time = $slot_time + ($event->slot_interval * 60);
                                    endwhile;
                                    echo '</td>';
                            } else {
                                echo '<td scope="col">Available Signups</td>';

                                echo '<td style="margin-top: 10px; margin-bottom: 10px;" align="left">';
                                    $slot_time = strtotime($event->time);
                                    $slots=1;
                                    while ($slots <= $event->slot_limit):
                                        $test = date('G:i',$slot_time);
                                        $check2 = EventsData::signup_time($event->id, $test);
                                        if(!$check2) {
                                            echo date('G:i', $slot_time).' - <a href="'.SITE_URL.'/index.php/events/signup?eid='.$event->id.'&pid='.Auth::$userinfo->pilotid.'&time='.date('G:i', $slot_time).'">Open</a><br />';
                                            $slots++;
                                        } else {
                                            $pilot = PilotData::getPilotData($check2->pilot_id);
                                            echo date('G:i', $slot_time).' - ';
                                            echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
                                            echo $pilot->firstname.' '.$pilot->lastname.'<br />';
                                        }
                                        $slot_time = $slot_time + ($event->slot_interval * 60);
                                    endwhile;
                                echo '</td>';
                            }
                        ?>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>

        <?php if($event->image !='none') { ?>
        <img src="<?php echo $event->image; ?>" class="img-fluid" alt="Event Image" />
        <?php } ?>
    </div>
</div>