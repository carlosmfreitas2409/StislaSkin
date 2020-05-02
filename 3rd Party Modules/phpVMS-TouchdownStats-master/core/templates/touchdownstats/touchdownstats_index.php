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
?>
<table width="100%" border="1px">
    <tr>
        <td>Pilot</td>
        <td>Aircraft</td>
        <td>Arrival Field</td>
        <td>Landing Rate</td>
        <td>Date Posted</td>
    </tr>
<?php
    foreach($stats as $stat)
    {
        $pilot = PilotData::getPilotData($stat->pilotid);
        $aircraft = OperationsData::getAircraftInfo($stat->aircraft);
        echo '<tr>';
        echo '<td>'.PilotData::getPilotCode($pilot->code, $pilot->pilotid).' - '.$pilot->firstname.' '.$pilot->lastname.'</td>';
        echo '<td>'.$aircraft->fullname.'</td>';
        echo '<td>'.$stat->arricao.'</td>';
        echo '<td>'.$stat->landingrate.'</td>';
        echo '<td>'.date(DATE_FORMAT, strtotime($stat->submitdate)).'</td>';
        echo '</tr>';
    }
?>
</table>