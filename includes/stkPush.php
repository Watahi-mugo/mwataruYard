<?php
// Load configuration keys (from config.php)
$config = require('config.php');

// Collect user input from HTML form via POST
$amount = $_POST['amount'];
$phone = $_POST['phoneNumber'];
$accountReference = $_POST['accountReference']; // e.g., Order ID

// Format phone number to Safaricom standard (2547XXXXXXXX)
$phone = preg_replace('/^0/', '254', $phone);

// Step 1: Generate Access Token
$credentials = base64_encode($config['consumerKey'] . ':' . $config['consumerSecret']);

$token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

$ch = curl_init($token_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Basic $credentials"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$token = json_decode($response)->access_token;

// Step 2: Make STK Push Request
$stk_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

$timestamp = date("YmdHis");
$password = base64_encode($config['shortcode'] . $config['passkey'] . $timestamp);

$payload = [
    'BusinessShortCode' => $config['shortcode'],        // 174379 or your Paybill
    'Password' => $password,
    'Timestamp' => $timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $amount,
    'PartyA' => $phone,
    'PartyB' => $config['shortcode'],
    'PhoneNumber' => $phone,
    'CallBackURL' => $config['callbackURL'],
    'AccountReference' => $accountReference,
    'TransactionDesc' => "Payment for order: $accountReference"
];

$ch = curl_init($stk_url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer $token"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);
curl_close($ch);

// Return JSON to frontend
header('Content-Type: application/json');
echo $response;
