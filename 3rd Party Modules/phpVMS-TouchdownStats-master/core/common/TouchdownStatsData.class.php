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

class TouchdownStatsData extends CodonData  {

    public static function get_all_stats() {
        $query = "SELECT pilotid, code, flightnum, depicao, arricao, aircraft, landingrate, submitdate FROM `".TABLE_PREFIX."pireps`
                    WHERE landingrate < '0'
                    ORDER BY landingrate DESC";

        return DB::get_results($query);
    }

     public static function get_stats($howmany) {
        $query = "SELECT pilotid, code, flightnum, depicao, arricao, aircraft, landingrate, submitdate FROM `".TABLE_PREFIX."pireps`
                    WHERE landingrate < '0'
                    ORDER BY landingrate DESC
                    LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function get_airline_stats($airline) {
        $query = "SELECT * FROM `".TABLE_PREFIX."pireps`
                    WHERE landingrate < '0'
                    AND code = '$airline'
                    ORDER BY landingrate DESC";

        return DB::get_results($query);
    }

    public static function get_worst_stats($howmany) {
        $query = "SELECT pilotid, code, flightnum, depicao, arricao, aircraft, landingrate, submitdate FROM `".TABLE_PREFIX."pireps`
                    WHERE landingrate < '0'
                    ORDER BY landingrate ASC
                    LIMIT $howmany";

        return DB::get_results($query);
    }

    public static function get_stats_by_aircraft($aircraftId) {
    $query = "SELECT pilotid, code, flightnum, depicao, arricao, aircraft, landingrate, submitdate FROM `".TABLE_PREFIX."pireps`
                WHERE landingrate < '0'
                AND aircraft = $aircraftId
                ORDER BY landingrate DESC";

                return DB::get_results($query);
    }

    public static function pilot_stats($pilotid)   {
        $query = "SELECT pilotid, code, flightnum, depicao, arricao, aircraft, landingrate, submitdate FROM `".TABLE_PREFIX."pireps`
                    WHERE landingrate < '0'
                    AND pilotid = '$pilotid'
                    ORDER BY landingrate DESC";

        return DB::get_results($query);
    }

    public static function pilot_average($pilotid) {
        $stats = self::pilot_stats($pilotid);
        $total = 0;
        $count = 0;
        if(!empty($stats))
        {
            foreach ($stats as $stat)
                {
                $total = $total + $stat->landingrate;
                $count++;
            }
            return $total / $count;
        }
        else
        {return '0';}
    }

    public static function airline_average() {
        $stats = self::get_all_stats();
        $total = 0;
        $count = 0;

        foreach ($stats as $stat)
            {
            $total = $total + $stat->landingrate;
            $count++;
        }
        $average = $total / $count;

        return $average;
    }

}