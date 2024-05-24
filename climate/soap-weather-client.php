<?php
$options = array(
    'location' => 'http://localhost/T-picos-en-software-/climate/soap-weather-server.php',
    'uri' => 'http://localhost/T-picos-en-software-/climate/weather',
    'trace' => 1,
    'soap_version' => SOAP_1_2,
);

$client = new SoapClient('weather.wsdl', $options);

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $a = $_GET["location"];

    try {
        $result = $client->GetWeather(array('location' => $a));
        echo "Location: " . $a . "<br/>";
        echo "Temperature: " . $result->temperature . "°C<br/>";
        echo "Humidity: " . $result->humidity . "%<br/>";
        echo "State: " . $result->state . "<br/>";
    } catch (SoapFault $fault) {
        echo "Error: {$fault->faultcode}, {$fault->faultstring}";
    }
}
?>