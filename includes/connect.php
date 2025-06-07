<?php
$host ='localhost';
$dbname ='mwataru_db';
$username ='root';
$password ='';

try {
    // PDO connection to database
    $connect= new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    //catch error and display them
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // connect success message
    echo "connected to Database";
} catch(PDOException $e) {
    echo "connection to Database failed: ". $e->getMessage();
}