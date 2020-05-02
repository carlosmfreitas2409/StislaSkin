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
?>


<h4>Edit Event</h4>
<hr />
<table width="80%">
        <form name="eventform" action="<?php echo SITE_URL; ?>/admin/index.php/events_admin" method="post" enctype="multipart/form-data">
            <tr>
                <td>Event Title</td>
                <td><input type="text" name="title"
                           <?php echo 'value="'.$event->title.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Event Description</td>
                <td><textarea name="description" rows="4" cols="40"><?php echo $event->description; ?></textarea></td>
            </tr>
            <tr>
                <td>Link To Event Banner Image (Optional)<br />ex: http://www.mysite.com/pic.png</td>
                <td><input type="text" name="image"
                           <?php echo 'value="'.$event->image.'"'; ?>
                           ></td>
            </tr>
            <tr>
                <td>Scheduled Event Date</td>
                <td>
                    <?php
                    $months = range(1, 12);
                    $days = range (1, 31);
                    $years = range (2010, 2015);
                        echo "Month: <select name='month'>";
                            echo '<option value="'.date('m', strtotime($event->date)).'">'.date('m', strtotime($event->date)).'</option>';
                            foreach ($months as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>';}
                        echo '</select>';
                        echo "   Day: <select name='day'>";
                            echo '<option value="'.date('d', strtotime($event->date)).'">'.date('d', strtotime($event->date)).'</option>';
                            foreach ($days as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>';}
                        echo '</select>';
                        echo "   Year: <select name='year'>";
                            echo '<option value="'.date('Y', strtotime($event->date)).'">'.date('Y', strtotime($event->date)).'</option>';
                            foreach ($years as $value)
                                {echo '<option value="'.$value.'">'.$value.'</option>';}
                        echo '</select>';
                    ?>

                    <!--
                    <input type="text" name="date" size="20"
                            <?php echo 'value="'.$event->date.'"'; ?><div type="text" id="datepicker"></div> -->
                           </td>
            </tr>
            <tr>
                <td>Scheduled Event Time</td>
                <td>
                    <?php
                        $start = strtotime('0:00');
                        $end = strtotime('23:30');
                        echo '<select name="time">';
                        echo '<option>'.date('G:i', strtotime($event->time)).'</option>';
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
                <td><input type="text" name="dep" <?php echo 'value="'.$event->dep.'"'; ?> ></td>
            </tr>
            <tr>
                <td>Arrival Airfield (icao)</td>
                <td><input type="text" name="arr" <?php echo 'value="'.$event->arr.'"'; ?> ></td>
            </tr>
            <tr>
                <td>Airline Schedule #</td>
                <td><input type="text" name="schedule" <?php echo 'value="'.$event->schedule.'"'; ?> ></td>
            </tr>
            <tr>
                <td>Slot Limit (min 1)</td>
                <td><input type="text" name="limit" <?php echo 'value="'.$event->slot_limit.'"'; ?> ></td>
            </tr>
            <tr>
                <td>Slot Interval (minutes - uneditable)</td>
                <td>
                    <?php echo $event->slot_interval; ?>
                    <input type="hidden" name="interval" <?php echo 'value="'.$event->slot_interval.'"'; ?> >
                </td>
            </tr>
            <tr>
                <td>Active Event?<br />Inactive events will not show in public/pilot listings.</td>
                <td>
                    <select name="active">
                        <?php
                        if($event->active == '0')
                                {
                                    echo '<option value="0">No</option>';
                                    echo '<option value="1">Yes</option>';
                                }
                        else
                                {
                                    echo '<option value="1">Yes</option>';
                                    echo '<option value="0">No</option>';
                                }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
                    <input type="hidden" name="action" value="save_edit_event" />
                    <input type="submit" value="Edit Event"></td>
            </tr>
        </form>
    </table>