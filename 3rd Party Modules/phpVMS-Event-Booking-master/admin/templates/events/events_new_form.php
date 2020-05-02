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

if(isset($event))
{echo '<div id="error">All fields must be filled out</div>'; }
?>

<h4>Create New Event</h4>
<table width="80%">
        <form name="eventform" action="<?php echo SITE_URL; ?>/admin/index.php/events_admin" method="post" enctype="multipart/form-data">
            <tr>
                <td>New Event Title</td>
                <td><input type="text" name="title"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['title'].'"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>New Event Description</td>
                <td><textarea name="description" rows="4" cols="40"><?php
                                if(isset($event))
                                {echo $event['description'];}
                           ?></textarea></td>
            </tr>
            <tr>
                <td>Link To Event Banner Image (Optional)<br />ex: http://www.mysite.com/pic.png</td>
                <td><input type="text" name="image"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['image'].'"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Scheduled Event Date</td>
                <td> 
                    <?php
                    $months = range(1, 12);
                    $days = range (1, 31);
                    $years = range (date('Y'), 2015);
                        echo "Month: <select name='month'>";
                            foreach ($months as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>\n';}
                        echo '</select>';
                        echo "   Day: <select name='day'>";
                            foreach ($days as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>\n';}
                        echo '</select>';
                        echo "   Year: <select name='year'>";
                            foreach ($years as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>\n';}
                        echo '</select>';
                    ?>
                </td>
            </tr>
            <tr>
                <td>Scheduled Event Time</td>
                <td>
                    <?php
                        $start = strtotime('0:00');
                        $end = strtotime('23:30');

                        echo '<select name="time">';
                        for ($i = $start; $i <= $end; $i += 1800)
                            {
                                echo '<option>' . date('H:i', $i).'</option>';
                            }
                        echo '</select>';
                    ?>
                     GMT
                </td>
            </tr>
            <tr>
                <td>Departure Airfield (icao)</td>
                <td><input type="text" name="dep"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['dep'].'"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Arrival Airfield (icao)</td>
                <td><input type="text" name="arr"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['arr'].'"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Airline Schedule #</td>
                <td><input type="text" name="schedule"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['schedule'].'"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Slot Limit (min 1)</td>
                <td><input type="text" name="limit"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['limit'].'"';}
                                else
                                {echo 'value="1"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Slot Interval (1 minute min)</td>
                <td><input type="text" name="interval"
                           <?php
                                if(isset($event))
                                {echo 'value="'.$event['interval'].'"';}
                                else
                                {echo 'value="1"';}
                           ?>
                           ></td>
            </tr>
            <tr>
                <td>Post Event as News Item?</td>
                <td>
                    <select name="postnews">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Active Event?<br />Inactive events will not show in public/pilot listings.</td>
                <td>
                    <select name="active">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="hidden" name="action" value="save_new_event" /><input type="submit" value="Save New Event"></td>
            </tr>
        </form>
    </table>

