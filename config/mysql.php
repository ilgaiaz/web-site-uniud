<?php
$servername = "eu-cdbr-west-02.cleardb.net";
$username = "b6df9263765a9a";
$password = "13c81934";
$db = "13c81934";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
