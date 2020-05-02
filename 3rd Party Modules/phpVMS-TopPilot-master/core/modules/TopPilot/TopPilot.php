<?php
//simpilotgroup addon module for phpVMS virtual airline system
//
//simpilotgroup addon modules are licenced under the following license:
//Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
//To view full icense text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
//
//@author David Clark (simpilot)
//@copyright Copyright (c) 2009-2010, David Clark
//@license http://creativecommons.org/licenses/by-nc-sa/3.0/

class TopPilot extends CodonModule {

    public $title = 'Top Pilots';

    public function __construct() {
        CodonEvent::addListener('TopPilot', array('pirep_filed'));
    }
    public function EventListener($eventinfo) {
        if($eventinfo[0] == 'pirep_filed') {
            self::refresh_pilot_stats();
        }
    }

    public function index() {

        if($this->post->action == 'get_old_stats') {
            $this->get_old_stats();
        }
        else    {
        $start = StatsData::GetStartDate();
        $this->set('startmonth', date('m', strtotime($start->submitdate)));
        $this->set('startyear', date('Y', strtotime($start->submitdate)));
        $this->set('today', getdate());
        $this->render('toppilot/tp_index');
        }
    }

    public function refresh_pilot_stats() {

        TopPilotData::clear_table();

        $start = StatsData::GetStartDate();
        $startmonth = date('m', strtotime($start->submitdate));
        $startyear = date('Y', strtotime($start->submitdate));
        $today = getdate();

        while ($startyear <= $today['year'] ) {

            $pilots = PilotData::getAllPilots();
            $month_stats = TopPilotData::get_monthly_stats($startmonth, $startyear);

            foreach ($pilots as $pilot) {
                $totaltime=0;
                $totalflights=0;
                $totalmiles=0;
                if(isset($month_stats)) {
                    foreach ($month_stats as $pirep) {
                        if ($pilot->pilotid == $pirep->pilotid /* && $pirep->accepted == 1 */ ) {
                            $totaltime = $totaltime + $pirep->flighttime;
                            $totalflights++;
                            $totalmiles = $totalmiles + $pirep->distance;
                        }
                    }
                }
                if($totalflights > 0) {
                    TopPilotData::record_stats($pilot->pilotid, $totalflights, $totaltime, $totalmiles, $startmonth, $startyear);
                }
            }
            if ($startmonth == 12) {$startyear++; $startmonth = 1;}
            else {$startmonth++;}
        }
    }

    public function get_old_stats() {
        $month = $_GET['month'];
        $year = $_GET['year'];

        $this->set('month', $month);
        $this->set('year', $year);
        $this->set('topflights', TopPilotData::top_pilot_flights($month, $year, 5));
        $this->set('tophours',  TopPilotData::top_pilot_hours($month, $year, 5));
        $this->set('topmiles',  TopPilotData::top_pilot_miles($month, $year, 5));
        $this->render('toppilot/tp_previous');
    }
}