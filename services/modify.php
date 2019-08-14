<?php
    session_start();
    require_once('config/mysql.php');
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $query = "UPDATE user_data SET user = '".$_POST["username"]."', name = '".$_POST["name"]."', surname = '".$_POST["surname"]."',
    email = '".$email."', dateOfBirth = '".$_POST["date"]."' WHERE user ='".$_SESSION["username"]."';";
    if ($conn->query($query) === TRUE) {
        //echo "Record update  successfully";
        $_SESSION["username"] = $_POST["username"];
        //header("Location: index.php")
    } else {
        //echo "Error: " . $query . "<br>" . $conn->error;
        //header("Location: signin.php")
    }
?>