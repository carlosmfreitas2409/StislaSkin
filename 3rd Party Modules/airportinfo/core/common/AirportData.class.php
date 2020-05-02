<?php
class AirportData extends CodonData {
    static function getdeptflights($icao)  {
        $sql = 'SELECT pirepid FROM '.TABLE_PREFIX.'pireps WHERE depicao="'.$icao.'"';
        $result = DB::get_results($sql);        
        return (is_array($result) ? count($result) : 0);
    }

    static function getarrflights($icao)  {
        $sql = 'SELECT pirepid FROM '.TABLE_PREFIX.'pireps WHERE arricao="'.$icao.'"';
        $result = DB::get_results($sql);
        return (is_array($result) ? count($result) : 0);
    }
 }