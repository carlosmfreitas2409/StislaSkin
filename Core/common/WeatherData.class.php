<?php
class WeatherData extends CodonData {
	
	public static $stationurl = 'https://api.checkwx.com/station/';
	public static $metarurl = 'https://api.checkwx.com/metar/';
	public static $tafurl = 'https://api.checkwx.com/taf/';
	
	public static $api = 'API_KEY_HERE';
	
    public static function icaoCheck($icao) {
		if (strlen($icao)==4 && ctype_alpha(substr($icao,0,1))) {
			return true;
		} else {
			return false;
		}
    }

    private static function fileCheck($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-API-Key: '.WeatherData::$api]);

		$result = json_decode(curl_exec($ch), true);
		curl_close($ch);

		if(isset($result['results'])) {
			return true; // Metar finded
		} else {
            echo '<script>console.log("'.$result['statusCode'].' | '.$result['error'].' | '.$result['message'].'")</script>';
			return false; // Metar error
		}
    }
    
    private static function getFile($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-API-Key: '.WeatherData::$api]);

		$result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        return $result;
    }
    
    // Checks
    public static function stationCheck($icao) {
		return WeatherData::fileCheck(WeatherData::$stationurl.$icao);
    }
    
    public static function metarCheck($icao) {
		return WeatherData::fileCheck(WeatherData::$metarurl.$icao.'/decoded');
    }
    
    public static function tafCheck($icao) {
		return WeatherData::fileCheck(WeatherData::$tafurl.$icao.'/decoded');
    }

    // Get informations
    public static function getStation($icao) {
        $data = WeatherData::getFile(WeatherData::$stationurl.$icao);
        
        return $data;
	}
    
    public static function getMetar($icao) {
        $data = WeatherData::getFile(WeatherData::$metarurl.$icao.'/decoded');

        return $data;
	}
	
	public static function getTaf($icao) {
        $data = WeatherData::getFile(WeatherData::$tafurl.$icao.'/decoded');
        
        return $data;
	}
}