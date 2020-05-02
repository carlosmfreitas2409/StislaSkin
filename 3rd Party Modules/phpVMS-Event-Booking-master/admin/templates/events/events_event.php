<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

$this->show('events/events_header.tpl');
echo '<h4>'.$event->title.'</h4><hr />';
echo 'Event Image:  ';
if ($event->image == 'none')
        {echo 'No Image Posted<hr />';}
     else
        {echo '<img src="'.$event->image.'" alt="Event Image" /><hr />';}
echo 'Scheduled Date: <b>'.date(DATE_FORMAT, strtotime($event->date)).'</b><hr />';
echo 'Description: <b>'.$event->description.'</b><hr />';
echo 'Departure Field: <b>'.$event->dep.'</b><hr />';
echo 'Arrival Field: <b>'.$event->arr.'</b><hr />';
echo 'Company Schedule: <b>'.$event->schedule.'</b><hr />';
echo 'Start Time (GMT): <b>'.date('G:i', strtotime($event->time)).'</b><hr />';
echo 'Slot Limit: <b>'.$event->slot_limit.'</b><hr />';
echo 'Slot Interval (minutes): <b>'.$event->slot_interval.'</b><hr />';
echo 'Current Signups: <br /><b>';
    if (!$signups)
    {
        echo 'No Signups';
    }
    else
    {
        foreach ($signups as $signup)
        {
            $pilot = PilotData::getPilotData($signup->pilot_id);
            echo date('G:i', strtotime($signup->time)).' - ';
            echo PilotData::GetPilotCode($pilot->code, $pilot->pilotid).' - ';
            echo $pilot->firstname.' '.$pilot->lastname;
            echo ' - <a href="'.SITE_URL.'/admin/index.php/events_admin/remove_signup?id='.$signup->pilot_id.'&event='.$event->id.'">Remove Pilot Signup</a><br />';
        }
    }
echo '</b><hr />';
echo '<a href="'.SITE_URL.'/admin/index.php/events_admin/edit_event?id='.$event->id.'"><b>Edit Event</b></a><br /><hr />';
echo '<a href="'.SITE_URL.'/admin/index.php/events_admin/delete_event?id='.$event->id.'"><b>Delete Event</b></a> - This will delete the event and any associated signups from the datbase permanently!<br /><hr />';
?>