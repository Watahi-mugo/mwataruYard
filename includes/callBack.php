<?php

header("Content-Type: application/json");


$callbackJSONData = file_get_contents('php://input');


$logFile = "mpesa_callback.log";
file_put_contents($logFile, $callbackJSONData . PHP_EOL, FILE_APPEND);

$data = json_decode($callbackJSONData, true);

$resultCode = $data['Body']['stkCallback']['ResultCode'] ?? null;

if ($resultCode === 0) {
   
    $metadata = $data['Body']['stkCallback']['CallbackMetadata']['Item'];
    $transaction = [];

    foreach ($metadata as $item) {
        $transaction[$item['Name']] = $item['Value'] ?? null;
    }

    $amount     = $transaction['Amount'] ?? 0;
    $receipt    = $transaction['MpesaReceiptNumber'] ?? '';
    $phone      = $transaction['PhoneNumber'] ?? '';
    $timestamp  = $transaction['TransactionDate'] ?? '';
    
    $formattedTime = date('Y-m-d H:i:s', strtotime(substr($timestamp, 0, 8) . ' ' . substr($timestamp, 8)));

    require_once "connect.php";

    $stmt = $connect->prepare("INSERT INTO payments (amount, receipt, phone, transaction_time) VALUES (?, ?, ?, ?)");
    $stmt->execute([$amount, $receipt, $phone, $formattedTime]);
}

http_response_code(200);
echo json_encode(["ResultCode" => 0, "ResultDesc" => "Callback received successfully"]);


