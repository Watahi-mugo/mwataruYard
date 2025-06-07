<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $feet = $_POST["feet"];
    $type = $_POST["type"];
    $dimensions = $_POST["dimensions"];  // fixed name
    $price = $_POST["price"];

    try {
        // Connect to DB
        require_once "connect.php";

        // Prepare SQL with named placeholders
        $stmt = $connect->prepare("INSERT INTO sales (feet, type, dimensions, price) VALUES (:feet, :type, :dimensions, :price)");

        // Bind parameters
        $stmt->bindParam(':feet', $feet);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':dimensions', $dimensions);
        $stmt->bindParam(':price', $price);
        $stmt->execute();

        // Close
        $stmt = null;
        $connect = null;

        echo "success"; // Send response for AJAX
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Query failed: " . $e->getMessage();
    }
} else {
    http_response_code(403); // Not allowed
    echo "Invalid request method.";
};

// This line is just to ensure the script doesn't continue after sending a response
echo "File reached!";
exit;


?>
