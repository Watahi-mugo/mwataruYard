<?php
// Get the JSON response from M-Pesa
$data = json_decode(file_get_contents('php://input'), true);

// Extract data
$name = $data['FirstName'] ?? 'Unknown';
$code = $data['TransID'];
$amount = $data['TransAmount'];
$date = date("Y-m-d H:i:s");

// Connect to DB and insert payment
$conn = new mysqli("localhost", "root", "", "your_database");
$stmt = $conn->prepare("INSERT INTO mpesa_payments (name, mpesa_code, amount, payment_date) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $name, $code, $amount, $date);
$stmt->execute();