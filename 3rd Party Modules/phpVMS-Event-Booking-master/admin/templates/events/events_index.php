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

echo 'Click On Event Title For Details/Editing<hr />';

echo '<h4>Upcoming Events</h4><hr />';
    if(!$events)
    {echo 'No Scheduled Events';}
    else
    {
    echo '<table width="100%">';
    echo '<tr><td width="30%"><u>Event Title</u></td><td width="60%"><u>Decription</u></td><td><u>Event Date</u></td></tr>';

    foreach($events as $event)
    {
        echo '<tr><td><a href="'.SITE_URL.'/admin/index.php/Events_admin/get_event?id='.$event->id.'">'.$event->title.'</a></td>';
        echo '<td>'.$event->description.'</td><td>'.date(DATE_FORMAT, strtotime($event->date)).'</td></tr>';
    }
    echo '</table>';
    }
echo '<hr /><h4>Past Events</h4><hr />';
if(!$history)
    {echo 'No Past Events';}
    else
    {
    echo '<table width="100%">';
    echo '<tr><td width="30%"><u>Event Title</u></td><td width="60%"><u>Decription</u></td><td><u>Event Date</u></td></tr>';

    foreach($history as $event)
    {
        echo '<tr><td><a href="'.SITE_URL.'/admin/index.php/Events_admin/get_event?id='.$event->id.'">'.$event->title.'</a></td>';
        echo '<td>'.$event->description.'</td><td>'.date(DATE_FORMAT, strtotime($event->date)).'</td></tr>';
    }
    echo '</table>';
    }
?>