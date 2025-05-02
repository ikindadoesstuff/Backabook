<?php
$host = "localhost";
$user = "root";
$pass = "usbw";
$database = "bookstoredb";

$connection = new mysqli($host, $user, $pass, $database);

if ($connection->connect_error) {
    die("Connection Failed: " . $connection->connect_error);
}

// echo "Connected to " . $database . " successfully.";

function queryDB (string $sql) {
    global $connection;
    try {
        return $connection->prepare($sql);
    } 
    catch (mysqli_sql_exception $e) {
        echo $e->getMessage();
        echo '<pre>'; print_r($e->getTrace()); echo '</pre>';
    }
}
?>