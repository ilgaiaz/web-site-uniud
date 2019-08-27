<?php
    session_start();
    require_once('../config/mysql.php');
    
    if(isset($_POST['kvcArray'])){
        $idArray = json_decode($_POST['kvcArray']);
        $id_ser = serialize($idArray);
        $query_id = "SELECT * FROM user_data WHERE user = '".$_SESSION["username"]."';";
        $result = mysqli_query($conn, $query_id);
        $row = mysqli_fetch_assoc($result);
        //Store user ID and all products ID (in one array) if is still present the user update the value
        $query = "INSERT INTO products_stored (userID, productsID_array) VALUES ('".$row["userID"]."','".$id_ser."') 
        ON DUPLICATE KEY UPDATE productsID_array = '".$id_ser."'";
        //ON DUPLICATE KEY UPDATE '".$row["userID"]."'
        if ($conn->query($query) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
?>