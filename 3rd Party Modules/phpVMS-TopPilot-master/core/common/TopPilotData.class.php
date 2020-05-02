<?php

/**
 * simpilotgroup addon module for phpVMS virtual airline system
 *
 * simpilotgroup addon modules are licenced under the following license:
 * Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 * To view full license text visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author David Clark (simpilot)
 * @copyright Copyright (c) 2009-2014, David Clark
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 * @link https://github.com/DavidJClark/phpVMS-TopPilot
 */

class TopPilotData extends CodonData
{

    public static function get_monthly_stats($month, $year)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pireps WHERE MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year'");
    }

    public static function record_stats($pilot_id, $totalflights, $totaltime, $totalmiles, $startmonth, $startyear)
    {
        DB::query("INSERT INTO " . TABLE_PREFIX . "top_flights (pilot_id, flights, hours, miles, month, year) VALUES('$pilot_id', '$totalflights', '$totaltime', '$totalmiles', '$startmonth', '$startyear')");
    }

    public static function clear_table()
    {
        DB::query("TRUNCATE TABLE " . TABLE_PREFIX . "top_flights");
    }

    public static function top_pilot_flights($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY flights DESC LIMIT $howmany");
    }

    public static function top_pilot_hours($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY hours DESC LIMIT $howmany");
    }

    public static function top_pilot_miles($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "top_flights WHERE month='$month' AND year='$year' ORDER BY miles DESC LIMIT $howmany");
    }

    public static function alltime_flights($howmany)
    {
        return DB::get_results("SELECT pilotid, totalflights FROM " . TABLE_PREFIX . "pilots ORDER BY totalflights DESC LIMIT $howmany");
    }

    public static function alltime_hours($howmany)
    {
        return DB::get_results("SELECT pilotid, totalhours FROM " . TABLE_PREFIX . "pilots ORDER BY totalhours DESC LIMIT $howmany");
    }

    public static function get_monthly_landingrate($month, $year, $howmany)
    {
        return DB::get_results("SELECT * FROM " . TABLE_PREFIX . "pireps WHERE MONTH(submitdate) = '$month' AND YEAR(submitdate) = '$year' ORDER BY landingrate DESC LIMIT '$howmany'");
    }
}
