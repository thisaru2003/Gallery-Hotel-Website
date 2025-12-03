<?php

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$amount = isset($data['amount']) ? (float)$data['amount'] : 0;
$reservation_id = isset($data['reservation_id']) ? $data['reservation_id'] : null;

if ($amount <= 0 || !$reservation_id) {
    echo json_encode(["error" => "Invalid amount or reservation ID"]);
    exit;
}

$merchant_id = "1228204";  
$merchant_secret = "MjIyNzU2MTUxMjEwMjQyODc2NzkxNjk4ODA0ODEyODA3OTkxOTg=";
$currency = "GBP";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $reservation_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$response = [
    "amount" => number_format($amount, 2, '.', ''),
    "merchant_id" => $merchant_id,
    "reservation_id" => $reservation_id,
    "currency" => $currency,
    "hash" => $hash
];

header('Content-Type: application/json');
echo json_encode($response);

?>
