<?php
$options = array(
    'location' => 'http://localhost/T-picos-en-software-/Calculators/soap-server.php',
    'uri' => 'http://localhost/T-picos-en-software-/Calculators/calculator',
    'trace' => 1,
    'soap_version' => SOAP_1_2,
);
$client = new SoapClient('calculator.wsdl', $options);

try {
    // Add operation
    $result = $client->Add(array('a' => 5, 'b' => 3));
    echo "Add Result: " . $result->result . "\n";

    // Subtract operation
    $result = $client->Subtract(array('a' => 5, 'b' => 3));
    echo "Subtract Result: " . $result->result . "\n";

    // Multiply operation
    $result = $client->Multiply(array('a' => 5, 'b' => 3));
    echo "Multiply Result: " . $result->result . "\n";

    // Divide operation
    $result = $client->Divide(array('a' => 5, 'b' => 3));
    echo "Divide Result: " . $result->result . "\n";

    // Modulus operation
    $result = $client->Modulus(array('a' => 5, 'b' => 3));
    echo "Modulus Result: " . $result->result . "\n";

    // Power operation
    $result = $client->Power(array('a' => 5, 'b' => 3));
    echo "Power Result: " . $result->result . "\n";
    
} catch (SoapFault $fault) {
    echo "Error: {$fault->faultcode}, {$fault->faultstring}\n";
}
?>
