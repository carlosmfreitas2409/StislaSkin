<?php
class FltbookData extends CodonData {
	 public static function findschedules($arricao, $depicao, $airline, $aircraft) {
	      $sql = "SELECT ".TABLE_PREFIX."schedules.*,
			 ".TABLE_PREFIX."aircraft.name AS aircraft,
			 ".TABLE_PREFIX."aircraft.id AS aircraftid,
			 ".TABLE_PREFIX."aircraft.icao AS aircrafticao,
			 ".TABLE_PREFIX."aircraft.registration
		     FROM ".TABLE_PREFIX."schedules, ".TABLE_PREFIX."aircraft
		      WHERE ".TABLE_PREFIX."schedules.depicao LIKE '$depicao'
		      AND ".TABLE_PREFIX."schedules.arricao LIKE '$arricao'
		      AND ".TABLE_PREFIX."schedules.code LIKE '$airline'
		      AND ".TABLE_PREFIX."schedules.aircraft LIKE '$aircraft'
		      AND ".TABLE_PREFIX."aircraft.id LIKE '$aircraft'
		      AND ".TABLE_PREFIX."schedules.enabled = '1'
		     ORDER BY ".TABLE_PREFIX."schedules.code ASC, ".TABLE_PREFIX."schedules.flightnum ASC";
	      return DB::get_results($sql);
	 }

	 public static function findschedule($arricao, $depicao, $airline) {
		$sql = "SELECT ".TABLE_PREFIX."schedules.*,
			".TABLE_PREFIX."aircraft.name AS aircraft,
			".TABLE_PREFIX."aircraft.registration,
			".TABLE_PREFIX."aircraft.id AS aircraftid,
			".TABLE_PREFIX."aircraft.icao AS aircrafticao,
			".TABLE_PREFIX."aircraft.ranklevel AS aircraftlevel
			FROM ".TABLE_PREFIX."schedules, ".TABLE_PREFIX."aircraft
			WHERE ".TABLE_PREFIX."schedules.depicao LIKE '$depicao'
			AND ".TABLE_PREFIX."schedules.arricao LIKE '$arricao'
			AND ".TABLE_PREFIX."schedules.code LIKE '$airline'
			AND ".TABLE_PREFIX."aircraft.id LIKE ".TABLE_PREFIX."schedules.aircraft";

		return DB::get_results($sql);
  	 }

	 public static function getAllAircraftFltbook($airline, $aicao) {
		  $sql = "SELECT * FROM ".TABLE_PREFIX."aircraft
			WHERE `icao` = '$aicao'
			AND `airline` = '$airline'
			ORDER BY icao, registration ASC";

		  $all_aircraft = DB::get_results($sql);
		  if(!$all_aircraft) { $all_aircraft = array(); }

		  return $all_aircraft;
	 }

	 public static function findaircraft($aircraft) {
		$sql = "SELECT id FROM ".TABLE_PREFIX."aircraft WHERE icao = '$aircraft'";
		return DB::get_results($sql);
	 }

	 public static function findCountries() {
		$sql = "SELECT DISTINCT country FROM ".TABLE_PREFIX."airports";
		return DB::get_results($sql);
	 }

	  public static function routeaircraft($icao) {
		$sql = "SELECT DISTINCT aircraft FROM ".TABLE_PREFIX."schedules WHERE depicao = '$icao'";
		return DB::get_results($sql);
	  }

	  public static function getAircraftByIcao($icao) {
		$sql = "SELECT * FROM ".TABLE_PREFIX."aircraft WHERE icao ='$icao'";
		return DB::get_row($sql);
	  }

	  public static function arrivalairport($icao) {
		$sql = "SELECT DISTINCT arricao FROM ".TABLE_PREFIX."schedules WHERE depicao = '$icao'";
		return DB::get_results($sql);
	  }

	  public static function getAircraftByID($id) {
		$sql = "SELECT * FROM ".TABLE_PREFIX."aircraft WHERE id ='$id'";
		return DB::get_row($sql);
	  }

	  public static function jumpseatpurchase($pilotid, $cost, $total, $arricao) {
		$sql = "UPDATE ".TABLE_PREFIX."pilots SET totalpay = '$total' WHERE pilotid = '$pilotid'";
		DB::query($sql);

		self::updatePilotLocation($pilotid, $arricao);

		// Update the pay column in the table in case we need to reset pilot pay after, then only a hook is needed
		$data = DB::get_row("SELECT * FROM fltbook_location WHERE `pilot_id` = '$pilotid'");
		$total = $data->total_jumpseat_pay + $cost;
		$sql = "UPDATE fltbook_location SET `total_jumpseat_pay` = '$total' WHERE `pilot_id` = '$pilotid'";
		DB::query($sql);
	  }

	  public static function getAllAirports_icao() {
		$sql = "SELECT * FROM ".TABLE_PREFIX."airports ORDER BY icao ASC";
		return DB::get_results($sql);
	  }

	  public static function getPilotID($pilot) {
		$sql = "SELECT * FROM fltbook_location WHERE pilot_id = '$pilot'";
		DB::get_row($sql);
	  }

	  public static function getLocation($pilotid) {
	    $sql = "SELECT * FROM fltbook_location WHERE pilot_id = '$pilotid'";

	    $real_location = DB::get_row($sql);
	    $pirep_location = PIREPData::getLastReports($pilotid, 1, '');

	    if($real_location->last_update > $pirep_location->submitdate) {
			return $real_location;
	    } else {
			// Update location if they've filed a PIREP previously, keeps things in sync
			self::updatePilotLocation($pilotid, $pirep_location->arricao);
			return $pirep_location;
	    }
	  }

	  public static function updatePilotLocation($pilotid, $icao, $admin = false) {
		$pilotid = intval($pilotid);
		$icao = DB::escape($icao);

		$sql = "SELECT * FROM fltbook_location WHERE pilot_id = '$pilotid'";
		$check = DB::get_row($sql);

		if($admin === true) {
			# Has an admin moved the pilot?
			if(!$check) {
				$sql1 = "INSERT INTO fltbook_location (pilot_id, arricao, jumpseats, last_update)
					VALUES ('$pilotid', '$icao', '0', NOW())";
			} else {
				$sql1 = "UPDATE fltbook_location SET arricao = '$icao', last_update = NOW() WHERE pilot_id = '$pilotid'";
			}
		} else {
			if(!$check) {
				$sql1 = "INSERT INTO fltbook_location (pilot_id, arricao, jumpseats, last_update)
					VALUES ('$pilotid', '$icao', '1', NOW())";
			} else {
				$jumpseats = $check->jumpseats + 1;
				$sql1 = "UPDATE fltbook_location SET arricao = '$icao', jumpseats = '$jumpseats', last_update = NOW() WHERE pilot_id = '$pilotid'";
			}
		}

		 DB::query($sql1);
	  }

	 public static function getBidByAircraft($aircraftid) {
		$aircraftid = DB::escape($aircraftid);
		$sql = "SELECT * FROM ".TABLE_PREFIX."bids WHERE `aircraftid` = '$aircraftid'";
		return DB::get_row($sql);
	 }

	 /* Merged + Edited from SchedulesData.class.php */
	 public static function addBid($pilotid, $routeid, $aircraftid) {
		$pilotid 	  = DB::escape($pilotid);
		$routeid 	  = DB::escape($routeid);
		$aircraftid 	  = DB::escape($aircraftid);

		if(DB::get_row('SELECT bidid FROM '.TABLE_PREFIX.'bids WHERE pilotid='.$pilotid.' AND routeid = '.$routeid.' AND aircraftid = '.$aircraftid)) {
			return false;
		}

		$pilotid 	  = DB::escape($pilotid);
		$routeid 	  = DB::escape($routeid);
		$aircraftid 	  = DB::escape($aircraftid);

		$sql = "INSERT INTO ".TABLE_PREFIX."bids (pilotid, routeid, aircraftid, dateadded)
			VALUES({$pilotid}, {$routeid}, {$aircraftid}, NOW())";
		DB::query($sql);

		// Set Bid On Schedule
		SchedulesData::setBidOnSchedule($routeid, DB::$insert_id);

		// Any Errors?
		if(DB::errno() != 0) {
		    return false;
		}

		return true;
	 }

	 /* Bids => Merge from SchedulesData.class.php */
	 public static function getBidsForPilot($pilotid) {
		$pilotid = DB::escape($pilotid);
		$sql = 'SELECT s.*, b.bidid, a.name as aircraft, a.registration, a.id as aircraftid
				FROM ' . TABLE_PREFIX . 'schedules s, 
			 		 ' . TABLE_PREFIX . 'bids b,
					 ' . TABLE_PREFIX . 'aircraft a
				WHERE b.routeid = s.id AND b.aircraftid = a.id AND b.pilotid=' . $pilotid;

		return DB::get_results($sql);
	 }

	 # Bidding System => Merge + Edited from SchedulesData.class.php to enable devs to hook into from here
	 public static function getAllBids() {
	    $sql = 'SELECT  p.*, s.*,
		b.bidid as bidid, b.dateadded, a.name as aircraft, a.registration
	    FROM ' . TABLE_PREFIX . 'schedules s,
	       ' . TABLE_PREFIX . 'bids b,
	       ' . TABLE_PREFIX . 'aircraft a,
	       ' . TABLE_PREFIX . 'pilots p
	    WHERE b.routeid = s.id AND b.aircraftid=a.id AND p.pilotid = b.pilotid
	    ORDER BY b.bidid DESC';

	    return DB::get_results($sql);
	 }

	/**
	 * Get the latest bids
	 */

	public static function getLatestBids($limit = 5) {
	    $sql = 'SELECT  p.*, s.*,
		b.bidid as bidid, a.name as aircraft, a.registration
	    FROM ' . TABLE_PREFIX . 'schedules s,
	       ' . TABLE_PREFIX . 'bids b,
	       ' . TABLE_PREFIX . 'aircraft a,
	       ' . TABLE_PREFIX . 'pilots p
	    WHERE b.routeid = s.id AND b.aircraftid=a.id AND p.pilotid = b.pilotid
	    ORDER BY b.bidid DESC
	    LIMIT ' . $limit;

	    return DB::get_results($sql);
	}

	public function getLatestBid($pilotid) {
	    $pilotid = DB::escape($pilotid);

	    $sql = 'SELECT s.*, b.bidid, a.id as aircraftid, a.name as aircraft, a.registration, a.maxpax, a.maxcargo
	    FROM ' . TABLE_PREFIX . 'schedules s,
	       ' . TABLE_PREFIX . 'bids b,
	       ' . TABLE_PREFIX . 'aircraft a
	    WHERE b.routeid = s.id
	      AND b.aircraftid=a.id
	      AND b.pilotid=' . $pilotid . '
	    ORDER BY b.bidid ASC LIMIT 1';

	    return DB::get_row($sql);
	}

	/**
	 * Get a specific bid with route information
	 *
	 * @param unknown_type $bidid
	 * @return unknown
	 */
	public static function getBid($bidid) {
	    $bidid = DB::escape($bidid);

	    $sql = 'SELECT s.*, b.bidid, b.pilotid, b.routeid,
		a.name as aircraft, a.registration as registration
	    FROM ' . TABLE_PREFIX . 'schedules s, ' . TABLE_PREFIX . 'bids b,
	      ' . TABLE_PREFIX . 'aircraft a
	    WHERE b.routeid = s.id
		AND b.aircraftid=a.id
		AND b.bidid=' . $bidid;

	    return DB::get_row($sql);
	}

	/**
	 * Get find a bid for the pilot based on ID,
	 *	the airline code for the flight, and the flight number
	 */
	public static function getBidWithRoute($pilotid, $code, $flightnum) {
	    if ($pilotid == '') return;

	    $sql = 'SELECT b.bidid
	    FROM ' . TABLE_PREFIX . 'bids b, ' . TABLE_PREFIX . 'schedules s
	    WHERE b.pilotid=' . $pilotid . '
	      AND b.routeid=s.id
	      AND s.code=\'' . $code . '\'
	      AND s.flightnum=\'' . $flightnum . '\'';

	    return DB::get_row($sql);
	}

	/* Searches where depicao is anything (i.e. search from current location is disabled) */
	public static function routeaircraft_depnothing() {
		$sql = "SELECT DISTINCT icao, name FROM ".TABLE_PREFIX."aircraft";
		return DB::get_results($sql);
	}

	/* Manually update the locaton of an aircraft */
	public static function updateAircraftLocation($aircraftid, $location) {
		$sql = 'UPDATE '.TABLE_PREFIX.'aircraft SET location = "'.$location.'" WHERE id = '.$aircraftid;
		DB::query($sql);

		// Debugger
		// $code = DB::errno();
		// if ($code != 0){
		// 	$message = DB::error();
		// 	throw new Exception($message, $code);
		// }
	}

	/* Settings */
	public static function getAllSettings() {
		$sql = "SELECT * FROM `fltbook_settings`";
		return DB::get_results($sql);
	}

	public static function getSettingByID($id) {
		$id = intval($id);
		$sql = "SELECT * FROM `fltbook_settings` WHERE `name` = '$id'";
		return DB::get_row($sql);
	}

	public static function getSettingByName($name) {
		$name = DB::escape($name);
		$sql = "SELECT * FROM `fltbook_settings` WHERE `name` = '$name'";
		return DB::get_row($sql);
	}

	public static function editSettings($data) {
		foreach($data as $key => $value) {
			$sql = "UPDATE `fltbook_settings` SET `value` = '$value' WHERE `name` = '$key'";
			DB::query($sql);
		}
	}
}
