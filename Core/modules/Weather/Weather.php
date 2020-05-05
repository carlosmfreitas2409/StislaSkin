<?php
class Weather extends CodonModule  {

	public function index() {
		if($this->post->submit) {
			$this->checkWx(strtoupper($this->post->icao));
		} else {
			$pilotid = Auth::$userinfo->pilotid;
			$currentLocation = FltbookData::getLocation($pilotid);
			if(!$currentLocation) {
				FltbookData::updatePilotLocation($pilotid, Auth::$userinfo->hub);
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://api.checkwx.com/metar/'.$currentLocation->arricao.'/decoded');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-API-Key: '.WeatherData::$api]);

			$result = json_decode(curl_exec($ch), true);
			curl_close($ch);
			
			$this->set('last_location', $currentLocation);
			$this->set('currentMetar', $result);
	
			$this->render('weather/wx_form.php');
		}
    }

    private function checkWx($icao) {
		if (!WeatherData::icaoCheck($icao)) {
			$this->set('message', $icao." is not a valid icao code of an airport.<br/>You will be redirecting to weather page in 5 seconds...");
			$this->render('core_error.php');
			header("refresh:5;url=".url('/weather') );
			return;
		} else {
            if (WeatherData::metarCheck($icao) && WeatherData::tafCheck($icao) && WeatherData::stationCheck($icao)) {
				$this->set('icao', $icao);
				$this->set('station', WeatherData::getStation($icao));
				$this->set('metar', WeatherData::getMetar($icao));
                $this->set('taf', WeatherData::getTaf($icao));
                
				$this->render('weather/wx_result.php');
				
            } elseif (!WeatherData::metarCheck($icao) && !WeatherData::tafCheck($icao) && WeatherData::stationCheck($icao)) {
				$this->set('icao', $icao);
				$this->set('station', WeatherData::getStation($icao));
                
				$this->render('weather/wx_result.php');

			} elseif (WeatherData::metarCheck($icao) && !WeatherData::tafCheck($icao) && !WeatherData::stationCheck($icao)) {
				$this->set('icao', $icao);
                $this->set('metar', WeatherData::getMetar($icao));
                
				$this->render('weather/wx_result.php');

			} elseif (!WeatherData::metarCheck($icao) && WeatherData::tafCheck($icao) && !WeatherData::stationCheck($icao)) {
				$this->set('icao', $icao);
                $this->set('taf', WeatherData::getTaf($icao));
                
				$this->render('weather/wx_result.php');

			} else {
				$this->set('message', 'There is no available information for '.strtoupper($this->post->icao).' right now.<br />You will be redirecting to weather page in 5 seconds...');
				$this->render('core_error.php');
				header("refresh:5;url=".url('/weather') );
				return;
            }
		}
	}
    
}
