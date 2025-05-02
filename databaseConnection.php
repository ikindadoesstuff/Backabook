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
    return $connection->prepare($sql);
}
?>