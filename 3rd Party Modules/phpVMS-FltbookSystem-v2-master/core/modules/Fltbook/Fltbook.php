<?php
class Fltbook extends CodonModule {

	# Title & Module Settings
	public $title = 'Flight Booking';

	# Index
	public function index() {
		if(!Auth::LoggedIn()) {
			$this->set('message', 'You must be logged in to access this feature!');
			$this->show('core_error');
			return;
		} else {
			if(isset($this->post->action)) {
				switch(DB::escape($this->post->action)) {
					case 'search':
					$this->search();
					break;
				}
			} else {
				$this->set('settings', $this->getSettings());
				$this->set('airports', OperationsData::GetAllAirports());
				$this->set('airlines', OperationsData::getAllAirlines());
				$this->set('aircrafts', OperationsData::getAllAircraft('true'));
				$this->show('fltbook/search_form');
			}
		}
	}

	# Search Function
	public function search() {
		$settings = $this->getSettings();
		$arricao = DB::escape($this->post->arricao);
		if($settings['search_from_current_location'] == 1) {
			$depicao = FltbookData::getLocation(Auth::$userinfo->pilotid)->arricao;
		} else {
			$depicao = DB::escape($this->post->depicao);
		}
		$airline = DB::escape($this->post->airline);
		$aircraft = DB::escape($this->post->aircraft);

		if(!$airline) { $airline = '%'; }
		if(!$arricao) { $arricao = '%'; }
		if(!$depicao) { $depicao = '%'; }
		if($aircraft == !'') {
		$aircrafts = FltbookData::findaircraft($aircraft);
			foreach($aircrafts as $aircraft) {
			    $route = FltbookData::findschedules($arricao, $depicao, $airline, $aircraft->id);
			    if(!$route) { $route = array(); }
			    if(!$routes) { $routes = array(); }
			    $routes = array_merge($routes, $route);
			}
		} else {
			$routes = FltbookData::findschedule($arricao, $depicao, $airline);
		}

		$this->set('settings', $this->getSettings());
		$this->set('allroutes', $routes);
		$this->show('fltbook/search_results');
	}

	# Shows aircraft selection when booking
	public function confirm() {
		$routeid = DB::escape($this->get->id);
		$airline = DB::escape($this->get->airline);
		$aicao   = DB::escape($this->get->aicao);

		$this->set('settings', $this->getSettings());
		$this->set('aicao', $aicao);
		$this->set('airline', $airline);
		$this->set('routeid', $routeid);
		$this->render('fltbook/confirmbid');
	}

	# Retrieves Jumpseat Cost
	public function get_jumpseat_cost() {
		$settings = $this->getSettings();
		if($_SERVER['REQUEST_METHOD'] !== 'POST') {
			header('Location: '.url('/Fltbook'));
			exit;
		}

		$depicao = OperationsData::getAirportInfo(DB::escape($this->post->depicao));
		$arricao = OperationsData::getAirportInfo(DB::escape($this->post->arricao));

		$distance = round(SchedulesData::distanceBetweenPoints($depicao->lat, $depicao->lng, $arricao->lat, $arricao->lng), 0);
		$jumpseat_cost = $settings['jumpseat_cost'];
		$total_cost = ($jumpseat_cost * $distance);

		$pilot = PilotData::getPilotData(DB::escape($this->post->pilotid));
		if($pilot->totalpay < $total_cost) {
			echo json_encode(array('error' => 'pilotpay_less_than_cost',));
		} else {
			// Set these in the session for cross-page reference
			unset($_SESSION['jumpseat_arricao']);
			$_SESSION['jumpseat_cost'] = $total_cost;
			echo json_encode(array('distance' => $distance, 'total_cost' => $total_cost,));
		}
	}

	# Show Jumpseat Confirmation Ticket
	public function jumpseat() {
		// Check that search for current location is disabled
		// To prevent pilots jumpseating themselves
		$settings = $this->getSettings();
		if($settings['search_from_current_location'] == 0) {
			header('Location: '.url('/Fltbook'));
		}

		if(!Auth::LoggedIn()) {
			$this->set('message', 'You must be logged in to access this feature!');
			$this->show('core_error');
			return;
		} else {
			$icao = DB::escape($this->post->depicao);
			$this->set('settings', $this->getSettings());
			$this->set('airport', OperationsData::getAirportInfo($icao));
			$this->set('cost', $_SESSION['jumpseat_cost']);
			$this->show('fltbook/jumpseatticket');
		}
	}

	# Actually purchase the jumpseat
	public function jumpseatPurchase() {
		// Check that search for current location is disabled
		// To prevent pilots jumpseating themselves
		$settings = $this->getSettings();
		if($settings['search_from_current_location'] == 0) {
			header('Location: '.url('/Fltbook'));
		}

		$cost 				  = DB::escape($_SESSION['jumpseat_cost']);
		$pilot_total 		= (Auth::$userinfo->totalpay - $cost);
		FltbookData::jumpseatpurchase(Auth::$userinfo->pilotid, $cost, $pilot_total, DB::escape($this->post->arricao));

		// Remove the cost from the session and redirect back
		unset($_SESSION['jumpseat_cost']);
		header('Location: '.url('/Fltbook'));
	}

	# Merged from 'Schedules' Module
	public function addbid($routeid = '') {
		if(!Auth::LoggedIn()) return;

		$routeid    = DB::escape($this->post->routeid);
		$aircraftid = DB::escape($this->post->aircraftid);

		if($routeid == '') {
			echo 'No Route Passed!';
			return;
	 	}

		// See if this is a valid route
		$route = SchedulesData::findSchedules(array('s.id' => $routeid));
		if(!is_array($route) && !isset($route[0])) {
			echo 'Invalid Route!';
			return;
		}

		CodonEvent::Dispatch('bid_preadd', 'Schedules', $routeid, $aircraftid);

		/* Block any other bids if they've already made a bid */
		if(Config::Get('DISABLE_BIDS_ON_BID') == true) {
			$bids = SchedulesData::getBids(Auth::$userinfo->pilotid);

			# They've got somethin goin on
			if(count($bids) > 0) {
				echo 'Bid Exists!';
				return;
			}
		}

		$ret = FltbookData::addBid(Auth::$userinfo->pilotid, $routeid, $aircraftid);
		CodonEvent::Dispatch('bid_added', 'Schedules', $routeid, $aircraftid);

		if($ret == true) {
			$this->set('message', 'Bid Added!');
			$this->render('core_success.php');
		} else {
			$this->set('message', 'Already In Bids!');
			$this->render('core_error.php');
		}
	}

	public function bids() {
		$this->show('fltbook/schedule_bids');
	}

	public function getSettings() {
		return array(
			'disabled_ac_allow_book'       => FltbookData::getSettingByName('disabled_ac_allow_book')->value,
			'disabled_ac_sched_show'       => FltbookData::getSettingByName('disabled_ac_sched_show')->value,
			'show_ac_if_booked' 	       => FltbookData::getSettingByName('show_ac_if_booked')->value,
			'lock_aircraft_location' 	   => FltbookData::getSettingByName('lock_aircraft_location')->value,
			'search_from_current_location' => FltbookData::getSettingByName('search_from_current_location')->value,
			'jumpseat_cost'		      	   => FltbookData::getSettingByName('jumpseat_cost')->value,
			'pagination_enabled'	       => FltbookData::getSettingByName('pagination_enabled')->value,
			'show_details_button'	       => FltbookData::getSettingByName('show_details_button')->value,
		);
	}
}
