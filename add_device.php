<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $ip_address = $_POST["ip_address"];

    $insertSql = "INSERT INTO devices (name, ip_address) VALUES ('$name', '$ip_address')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Device added successfully!";
    } else {
        echo "Error adding device: " . $conn->error;
    }
}

$conn->close();
?>