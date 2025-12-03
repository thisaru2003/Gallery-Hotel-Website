<?php

$input = file_get_contents("php://input");
$data = json_decode($input, true);

$amount = $data['amount'];
$merchant_id = "1228204";
$order_id = uniqid();
$merchant_secret = "MjIyNzU2MTUxMjEwMjQyODc2NzkxNjk4ODA0ODEyODA3OTkxOTg=";
$currency = "GBP";

$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($amount, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);

$array = [];

$array ["amount"] = $amount;
$array ["merchant_id"] = $merchant_id;
$array ["order_id"] = $order_id;
$array ["currency"] = $currency;
$array ["hash"] = $hash;

$jsonObj = json_encode($array);

echo $jsonObj;

?>