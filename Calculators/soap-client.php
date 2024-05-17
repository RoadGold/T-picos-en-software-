<?php
$options = array(
    'location' => 'http://localhost/T-picos-en-software-/Calculators/soap-server.php',
    'uri' => 'http://localhost/T-picos-en-software-/Calculators/calculator',
    'trace' => 1,
    'soap_version' => SOAP_1_2,
);
$client = new SoapClient('calculator.wsdl', $options);
try {
    $result = $client->Add(array('a' => 5, 'b' => 3));
    echo "Add Result: " . $result->result . "\n";
} catch (SoapFault $fault) {
    echo "Error: {$fault->faultcode}, {$fault->faultstring}";
}
?>  