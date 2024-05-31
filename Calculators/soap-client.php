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
    $result = $client->Multiply(array('a' => 5, 'b' => 3));
    echo "Multiply Result: " . $result->result . "\n";
    $result = $client->Divide(array('a' => 5, 'b' => 3));
    echo "Divide Result: " . $result->result . "\n";
    $result = $client->Subtract(array('a' => 5, 'b' => 3));
    echo "Subtract Result: " . $result->result . "\n";
    $result = $client->Modulo(array('a' => 5, 'b' => 3));
    echo "Modulo Result: " . $result->result . "\n";
    $result = $client->Cociente(array('a' => 5, 'b' => 3));
    echo "Cociente Result: " . $result->result . "\n";

} catch (SoapFault $fault) {
    echo "Error: {$fault->faultcode}, {$fault->faultstring}";
}
?>
