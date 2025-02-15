<?php

require_once __DIR__ . '/..' . '/config.php';

try {

    $orderId = 124;

    $responsePayment = $ipagClient->payment()->cancelByOrderId($orderId);
    $data = $responsePayment->getData();

    $statusPayment = $responsePayment->getParsedPath('attributes.status.code');
    $amount = $responsePayment->getParsedPath('attributes.amount');

    // Verifica o status retornado do pagamento
    switch ($statusPayment) {
        case Ipag\Sdk\Core\Enums\PaymentStatus::CANCELED:
            // Faça algo aqui...
            break;
        default:
        // Faça algo aqui...
    }

    echo "Status do Pagamento: {$statusPayment}" . PHP_EOL;
    echo "Valor do Pagamento: {$amount}" . PHP_EOL;

    echo "<pre>" . PHP_EOL;
    print_r($data);
    echo "</pre>" . PHP_EOL;

} catch (Ipag\Sdk\Exception\HttpException $e) {
    $code = $e->getResponse()->getStatusCode();
    $errors = $e->getErrors();

    echo "<pre>" . PHP_EOL;
    var_dump($code, $errors);
    echo "</pre>" . PHP_EOL;

} catch (Exception $e) {
    $error = $e->getMessage();

    echo "<pre>" . PHP_EOL;
    var_dump($error);
    echo "</pre>" . PHP_EOL;

}