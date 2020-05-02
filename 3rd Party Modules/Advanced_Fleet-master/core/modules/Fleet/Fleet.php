<?php
/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: http://www.phpvms.net/forum
 *	Documentation: http://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit http://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link http://www.phpvms.net
 * @license http://creativecommons.org/licenses/by-nc-sa/3.0/
 */
 
class Fleet extends CodonModule {

	public function index() {
		$this->set('aircrafts', FleetData::GetAllAircrafts());
		$this->render('fleet/fleet_list.php');
		
	}
	
    public function view($aircraftid) {
		$this->set('basicinfo', FleetData::getBasicInfo($aircraftid));
		$this->set('purchasedate', FleetData::getDateOfPurchase($aircraftid));
		$this->set('firstflight', FleetData::getFirstFlight($aircraftid));
		$this->set('lastflight', FleetData::getLastFlight($aircraftid));
		$this->set('detailedinfo', FleetData::getAircraftTotals($aircraftid));
		$this->set('recentflights', FleetData::get5MostRecentFlights($aircraftid));
		$this->set('scheduledflights', FleetData::getAllScheduledFlights($aircraftid));
		$this->render('fleet/fleet_view.php');
		
	}
}