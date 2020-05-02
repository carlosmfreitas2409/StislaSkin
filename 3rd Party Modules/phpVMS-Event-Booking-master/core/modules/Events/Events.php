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

class Events extends CodonModule
{
    public function index()
    {
        $this->set('events', EventsData::get_upcoming_events());
        $this->set('history', EventsData::get_past_events());
        $this->show('events/events_index.tpl');
    }
    public function get_event()
    {
        $id = DB::escape($_GET['id']);

        $this->set('event', EventsData::get_event($id));
        $this->set('signups', EventsData::get_signups($id));
        $this->show('events/events_event.tpl');
    }
    public function get_past_event()
    {
        $id= DB::escape($_GET['id']);

        $this->set('event', EventsData::get_event($id));
        $this->set('signups', EventsData::get_signups($id));
        $this->show('events/events_past_event.tpl');
    }
    public function signup() //admin
    {
        $eid = DB::escape($_GET['eid']);
        $pid = DB::escape($_GET['pid']);
        $time = DB::escape($_GET['time']);

        EventsData::event_signup($eid, $pid, $time);
        EventsData::add_ranking($pid);

        $this->set('event', EventsData::get_event($eid));
        $this->set('signups', EventsData::get_signups($eid));
        $this->show('events/events_event.tpl');
    }
    public function remove_signup() //public
    {
        $id = $_GET['id'];
        $event = $_GET['event'];

        EventsData::remove_pilot_signup($id, $event);
        EventsData::subtract_ranking($id);

        $this->set('event', EventsData::get_event($event));
        $this->set('signups', EventsData::get_signups($event));
        $this->show('events/events_event.tpl');
    }
    public function get_rankings()
    {
        $this->set('rankings', EventsData::get_rankings());
        $this->show('events/events_rankings.tpl');
    }
}