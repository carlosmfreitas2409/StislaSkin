<?php

	// -- Class Name : FleetData
	// -- Purpose : Gathers Detailed Information on VA Aircrafts
	// -- Created On : 10/27/2013
	// -- Last Revised On : 10/27/2013
	// -- Version : 1.0
	class FleetData extends CodonData
	{
		public static

		// -- Function Name : GetAllAircrafts
		// -- Params : 
		// -- Purpose : 
		function GetAllAircrafts()
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'aircraft WHERE `enabled` = 1';
			return DB::get_results($sql);
		}

		public static

		// -- Function Name : getBasicInfo
		// -- Params : $id
		// -- Purpose : 
		function getBasicInfo($id)
		{
			//get basic info
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'aircraft WHERE `enabled` = 1 AND id='.$id;
			$basicinfo = DB::get_row($sql);
			return $basicinfo;
		}

		public static

		// -- Function Name : getDateOfPurchase
		// -- Params : $id
		// -- Purpose : 
		function getDateOfPurchase($id)
		{
			//get date of purchase
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'aircraft WHERE `enabled` = 1 AND id='.$id;
			$basicinfo = DB::get_row($sql);
			$planestr = $basicinfo->name;
			$planestr .= ' - '. $basicinfo->registration;
			$stringToLocate = 'Added the aircraft "'.$planestr.'"';
			$sql2 = 'SELECT * FROM `phpvms_adminlog` WHERE message LIKE \''. $stringToLocate.'\'';
			$dateofPurchase = DB::get_row($sql2);
			return $dateofPurchase;
		}

		public static

		// -- Function Name : getFirstFlight
		// -- Params : $id
		// -- Purpose : 
		function getFirstFlight($id)
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'pireps WHERE aircraft='.$id.' AND `accepted` = 1 ORDER BY pirepid ASC LIMIT 1';
			$firstFlight = DB::get_row($sql);
			return $firstFlight;
		}

		public static

		// -- Function Name : getLastFlight
		// -- Params : $id
		// -- Purpose : 
		function getLastFlight($id)
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'pireps WHERE aircraft='.$id.' AND `accepted` = 1 ORDER BY pirepid DESC LIMIT 1';
			$lastFlight = DB::get_row($sql);
			return $lastFlight;
		}

		public

		// -- Function Name : getAircraftTotals
		// -- Params : $id
		// -- Purpose : 
		function getAircraftTotals($id)
		{
			//find all pireps
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'pireps WHERE aircraft='.$id.' AND accepted = 1';
			$allAircraftPireps = DB::get_results($sql);
			$c = 0;
			
			if($allAircraftPireps != null)
			{
				foreach($allAircraftPireps as $allAircraftPireps)
				{
					$c++;
					$fuelUse += $allAircraftPireps->fuelused;
					$miles += $allAircraftPireps->distance;
					$revenue += $allAircraftPireps->revenue;
					$expenses += $allAircraftPireps->expenses;
					//$flighttime += $pirep->expenses;
				}

				$aircraftinfo['AvgFuel'] = $fuelUse/$c;
				$aircraftinfo['totalFuel'] = $fuelUse;
				$aircraftinfo['fuelConsumption'] = $fuelUse/$miles;
				$aircraftinfo['AvgFlightDistance'] = $miles/$c;
				$aircraftinfo['TotalFlightDistance'] = $miles;
				$aircraftinfo['AvgRevenue'] = $revenue/$c;
				$aircraftinfo['totalRevenue'] = $revenue;
				$aircraftinfo['totalExpenses'] = $expenses;
				return $aircraftinfo;
			}
			else
			{
				return 0;
			}

		}

		public

		// -- Function Name : get5MostRecentFlights
		// -- Params : $id
		// -- Purpose : 
		function get5MostRecentFlights($id)
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'pireps WHERE aircraft='.$id.' AND accepted = 1 ORDER BY pirepid DESC LIMIT 5';
			$allAircraftPireps = DB::get_results($sql);
			return $allAircraftPireps;
		}

		public

		// -- Function Name : getAllScheduledFlights
		// -- Params : $id
		// -- Purpose : 
		function getAllScheduledFlights($id)
		{
			$sql = 'SELECT * FROM '.TABLE_PREFIX.'schedules WHERE aircraft='.$id.'';
			$allAircraftSchedules = DB::get_results($sql);
			return $allAircraftSchedules;
		}

	}