<?php

$comprador = $_GET['comprador'];
$email = $_GET['email'];
$valor = $_GET['valor'];

$valor = str_replace(',', '.', $valor);

$data['currency'] = 'BRL';
$data['itemId1'] = '1';
$data['itemQuantity1'] = '1';
$data['itemDescription1'] = 'Compra realizada no ecommerce';
$data['itemAmount1'] = $valor;
$data['senderName'] = $comprador;
$data['senderEmail'] = $email;

$emailPagseguro = "fmsystem@gmail.com";
$data['token'] = "8199586BBDF24F9EBF6E78C4121485C8";

$url = 'https://ws.pagseguro.uol.com.br/v2/checkout?email=' .
        $emailPagseguro;

$data = http_build_query($data);

$curl = curl_init();

$headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'
);

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HEADER, false);

$xml = curl_exec($curl);

curl_close($curl);

$xml = simplexml_load_string($xml);

$hashPagamento = $xml->code;

header('Location: https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $hashPagamento);
?>