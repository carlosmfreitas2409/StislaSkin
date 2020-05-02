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

class EventsData extends CodonData
{
    public static function get_events()
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events
                    ORDER BY date ASC";

        return DB::get_results($query);
    }
    public static function get_upcoming_events()
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events
                WHERE date >= NOW()
                ORDER BY date ASC";

        return DB::get_results($query);
    }
    public static function get_past_events()
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events
                WHERE date < NOW()
                ORDER BY date DESC";

        return DB::get_results($query);
    }
    public static function get_event($id)
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events WHERE id='$id'";

        return DB::get_row($query);
    }
    public static function get_signups($id)//probably dont need!
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events_signups WHERE event_id='$id' ORDER BY time ASC";

        return DB::get_results($query);
    }
    public static function save_new_event($date, $time, $title, $description, $image, $dep, $arr, $schedule, $slot_limit, $slot_interval, $active)
    {
        $query = "INSERT INTO ".TABLE_PREFIX."events (date, time, title, description, image, dep, arr, schedule, slot_limit, slot_interval, active)
                VALUES ('$date', '$time', '$title', '$description', '$image', '$dep', '$arr', '$schedule', '$slot_limit', '$slot_interval', '$active')";

        DB::query($query);
    }
     public static function save_edit_event($date, $time, $title, $description, $image, $dep, $arr, $schedule, $slot_limit, $slot_interval, $active, $id)
    {
        $query = "UPDATE ".TABLE_PREFIX."events SET
         date='$date',
         time='$time',
         title='$title',
         description='$description',
         image='$image',
         dep='$dep',
         arr='$arr',
         schedule='$schedule',
         slot_limit='$slot_limit',
         slot_interval='$slot_interval',
         active='$active'
         WHERE id='$id'";

        DB::query($query);
    }
    public static function event_signup($eid, $pid, $time)
    {
        $query = "INSERT INTO ".TABLE_PREFIX."events_signups (event_id, pilot_id, time)
                    VALUES('$eid', '$pid', '$time')";

        DB::query($query);
    }
    public static function signup_time($eid, $time)
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events_signups
                    WHERE event_id='$eid'
                    AND time='$time'";

        return DB::get_row($query);
    }
    public static function check_signup($pid, $eid)
    {
        $query = "SELECT COUNT(*) AS total
                    FROM ".TABLE_PREFIX."events_signups
                    WHERE event_id='$eid'
                    AND pilot_id='$pid'";

        return DB::get_row($query);
    }
    public static function remove_signup($id)
    {
        $query = "DELETE FROM ".TABLE_PREFIX."events_signups
                    WHERE id='$id'";

        DB::query($query);
    }
    public static function remove_pilot_signup($id, $event)
    {
        $query = "DELETE FROM ".TABLE_PREFIX."events_signups
                    WHERE pilot_id='$id'
                    AND event_id='$event'";

        DB::query($query);
    }
    public static function delete_event($id)
    {
        $query = "DELETE FROM ".TABLE_PREFIX."events
                    WHERE id='$id'";

        DB::query($query);

        $query2 = "DELETE FROM ".TABLE_PREFIX."events_signups
                    WHERE event_id='$id'";

        DB::query($query2);
    }
    public static function add_ranking($pilot_id)
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events_pilotranks
                    WHERE pilot_id='$pilot_id'";

        $data = DB::get_row($query);

        if(!$data)
            {
            $query2 = "INSERT INTO ".TABLE_PREFIX."events_pilotranks (pilot_id, ranking)
                        VALUES ('$pilot_id', '1')";

            DB::query($query2);
            }
        else
            {
            $ranking = $data->ranking + 1;
            $query3 = "UPDATE ".TABLE_PREFIX."events_pilotranks
                        SET ranking='$ranking'
                        WHERE pilot_id='$pilot_id'";

            DB::query($query3);
        }
    }
    public static function subtract_ranking($pilot_id)
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events_pilotranks
                    WHERE pilot_id='$pilot_id'";

        $data = DB::get_row($query);

        if($data->ranking <= '1')
        {
            $query2 = "DELETE FROM ".TABLE_PREFIX."events_pilotranks
                        WHERE pilot_id='$pilot_id'";

            DB::query($query2);
        }
        else
        {
            $ranking = $data->ranking - 1;
            $query3 = "UPDATE ".TABLE_PREFIX."events_pilotranks
                        SET ranking='$ranking'
                        WHERE pilot_id='$pilot_id'";

            DB::query($query3);
        }
    }
    public static function get_rankings()
    {
        $query = "SELECT * FROM ".TABLE_PREFIX."events_pilotranks
                    ORDER BY ranking DESC";

        return DB::get_results($query);
    }
}