<?php
class WeatherService {
    private $db;

    public function __construct() {
        $this->db = new mysqli('localhost', 'root', 'anyelina2010', 'weather_db');
        if ($this->db->connect_error) {
            throw new SoapFault("Server", "Database connection error: " . $this->db->connect_error);
        }
    }

    public function GetWeather($parameters) {   
        $location = $this->db->real_escape_string($parameters->location);
        $query = "SELECT temperature, humidity, state FROM weather WHERE location='$location' LIMIT 1";
        $result = $this->db->query($query);
        if ($result->num_rows == 0) {
            throw new SoapFault("Server", "No weather data found for location: " . $location);
        }
        $weatherData = $result->fetch_assoc();
        return array(
            'temperature' => $weatherData['temperature'],
            'humidity' => $weatherData['humidity'],
            'state' => $weatherData['state'],
        );
    }
}

$options = array(
    'uri' => 'http://localhost/T-picos-en-software-/climate/weather',
    'soap_version' => SOAP_1_2,
);

$server = new SoapServer('weather.wsdl', $options);
$server->setClass('WeatherService');
$server->handle();
?>