<?php
    session_start();
    require_once('../config/mysql.php');
    
    if(isset($_POST["delete"])){
        $query = "DELETE FROM user_data WHERE userID = '".$_SESSION["userID"]."' ";
        $result = mysqli_query($conn,$query);
        session_destroy();
        if($result){
            ?>
            <script>
                window.alert("Account eliminato");
                document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.href = "../index.php";
            </script>
            <?php
        }else{
            echo "ELSE";
        }
    }
?>