<?php
$servername = "localhost";
$username = "university";
$password = "";
$db = "applicazioni_web";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
