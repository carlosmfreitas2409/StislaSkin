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

class Events_admin extends CodonModule
{
    public function HTMLHead()
    {
        $this->set('sidebar', 'events/sidebar_events.php');
    }

    public function NavBar()
    {
        echo '<li><a href="'.SITE_URL.'/admin/index.php/events_admin">Events</a></li>';
    }

    public function index()
    {
        if($this->post->action == 'save_new_event')
        {
            $this->save_new_event();
        }
        elseif($this->post->action == 'save_edit_event')
        {
            $this->save_edit_event();
        }
        else
        {
            $this->set('events', EventsData::get_upcoming_events());
            $this->set('history', EventsData::get_past_events());
            $this->show('events/events_index');
        }
    }
    public function get_event()
    {
        $id = $_GET[id];
        $this->set('event', EventsData::get_event($id));
        $this->set('signups', EventsData::get_signups($id));
        $this->show('events/events_event');
    }
    public function new_event()
    {
        $this->show('events/events_new_form');
    }
    protected function save_new_event()
    {
        $event = array();

        $event['title'] = DB::escape($this->post->title);
        $event['description'] = DB::escape($this->post->description);
        $event['image'] = DB::escape($this->post->image);
        $event['time'] = DB::escape($this->post->time);
        $event['dep'] = DB::escape($this->post->dep);
        $event['arr'] = DB::escape($this->post->arr);
        $event['schedule'] = DB::escape($this->post->schedule);
        $event['limit'] = DB::escape($this->post->limit);
        $event['interval'] = DB::escape($this->post->interval);
        $event['active'] = DB::escape($this->post->active);
        $event['postnews'] = DB::escape($this->post->postnews);
        $event['month'] = DB::escape($this->post->month);
        $event['day'] = DB::escape($this->post->day);
        $event['year'] = DB::escape($this->post->year);

        if(!$event['image'])
        {$event['image'] = 'none';}

        foreach($event as $test)
        {
            if(empty($test))
            {
                $this->set('event', $event);
                $this->show('events/events_new_form');
                return;
            }
        }

        $event['date'] = $event['year'].'-'.$event['month'].'-'.$event['day'];

        EventsData::save_new_event($event['date'], 
                                    $event['time'],
                                    $event['title'],
                                    $event['description'],
                                    $event['image'],
                                    $event['dep'],
                                    $event['arr'],
                                    $event['schedule'],
                                    $event['limit'],
                                    $event['interval'],
                                    $event['active']);

        if($event['postnews'] == '1')
            {SiteData::AddNewsItem($event['title'], $event['description']);}

        $this->set('events', EventsData::get_upcoming_events());
        $this->set('history', EventsData::get_past_events());
        $this->show('events/events_index');
    }
    public function edit_event() {
            $id = $_GET[id];
            $event = array();
            $event = EventsData::get_event($id);
            $this->set('event', $event);
            $this->show('events/events_edit_form');
    }
    protected function save_edit_event()
    {
        $event = array();

        $event['title'] = DB::escape($this->post->title);
        $event['description'] = DB::escape($this->post->description);
        $event['image'] = DB::escape($this->post->image);
        $event['time'] = DB::escape($this->post->time);
        $event['dep'] = DB::escape($this->post->dep);
        $event['arr'] = DB::escape($this->post->arr);
        $event['schedule'] = DB::escape($this->post->schedule);
        $event['limit'] = DB::escape($this->post->limit);
        $event['interval'] = DB::escape($this->post->interval);
        $event['active'] = DB::escape($this->post->active);
        $event['id'] = DB::escape($this->post->id);
        $event['month'] = DB::escape($this->post->month);
        $event['day'] = DB::escape($this->post->day);
        $event['year'] = DB::escape($this->post->year);

        $event['date'] = $event['year'].'-'.$event['month'].'-'.$event['day'];

        EventsData::save_edit_event($event['date'],
                                    $event['time'],
                                    $event['title'],
                                    $event['description'],
                                    $event['image'],
                                    $event['dep'],
                                    $event['arr'],
                                    $event['schedule'],
                                    $event['limit'],
                                    $event['interval'],
                                    $event['active'],
                                    $event['id']);

        $id = $event['id'];
        $this->set('event', EventsData::get_event($id));
        $this->set('signups', EventsData::get_signups($id));
        $this->show('events/events_event');
    }
    public function remove_signup()
    {
        $id = $_GET[id];
        $event = $_GET[event];

        EventsData::remove_pilot_signup($id, $event);
        EventsData::subtract_ranking($id);

        $this->set('event', EventsData::get_event($event));
        $this->set('signups', EventsData::get_signups($event));
        $this->show('events/events_event');
    }
    public function delete_event()
    {
        $id = $_GET[id];

        EventsData::delete_event($id);

        $this->set('events', EventsData::get_upcoming_events());
        $this->set('history', EventsData::get_past_events());
        $this->show('events/events_index');
    }
}