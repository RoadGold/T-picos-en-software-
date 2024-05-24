<?php
class CalculatorService {
    public function Add($parameters) {
        $a = $parameters->a;
        $b = $parameters->b;
        return array('result' => $a + $b);
    }

    public function Subtract($parameters) {
        $a = $parameters->a;
        $b = $parameters->b;
        return array('result' => $a - $b);
    }

    public function Multiply($parameters) {
        $a = $parameters->a;
        $b = $parameters->b;
        return array('result' => $a * $b);
    }

    public function Divide($parameters) {
        $a = $parameters->a;
        $b = $parameters->b;
        if ($b == 0) {
            throw new SoapFault("DivisionByZero", "Cannot divide by zero");
        }
        return array('result' => $a / $b);
    }
}

$options = array(
    'uri' => 'http://localhost/T-picos-en-software-/Calculators/calculator',
    'soap_version' => SOAP_1_2,
);

$server = new SoapServer('calculator.wsdl', $options);
$server->setClass('CalculatorService');
$server->handle();
?>