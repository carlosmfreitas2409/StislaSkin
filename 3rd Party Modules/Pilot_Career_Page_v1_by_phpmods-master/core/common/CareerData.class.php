<?php
///////////////////////////////////////////////
///  Pilot Career Page v1.2 by php-mods.eu  ///
///            Author php-mods.eu           ///
///           Packed at 25/05/2016          ///
///     Copyright (c) 2016, php-mods.eu     ///
///////////////////////////////////////////////

class CareerData extends CodonData {
	
	public static function getgenaward() {
		$sql = "SELECT * FROM ".TABLE_PREFIX."awards";
		return DB::get_results($sql);
	}
	public static function getranks() {
		$sql = "SELECT * FROM ".TABLE_PREFIX."ranks ORDER BY minhours";
		return DB::get_results($sql);
	}
	public static function getaircrafts($rankid) {
		$sql= "SELECT distinct icao FROM ".TABLE_PREFIX."aircraft WHERE minrank='$rankid'";
		return DB::get_results($sql);
	}
}