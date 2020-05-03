<?php

class Airports extends CodonModule
{
	public function index()
	{
		$this->set('airports', OperationsData::getAllAirports());
		$this->show('airports/airport_main.php');
		
	}
    public function get_airport() {

        $icao = $_GET['icao'];
        $this->set('name', OperationsData::getAirportInfo($icao));
        $this->show('airports/airport_info.php');
    }
}
