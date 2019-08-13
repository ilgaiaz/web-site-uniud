<table border="1">
    <?php
        session_start();
        require_once('config/mysql.php');
        $query="SELECT * FROM user_data WHERE user = '".$_SESSION["username"]."';";
        $result = mysqli_query($conn,$query);
        $data = mysqli_fetch_assoc($query);
        if(!$result->num_rows > 0) {
            echo "Error";
        } else {
            echo "<table><tr><th>Username</th><th>Nome</th><th>Cognome</th><th>Data di nascita</th><th>Emal</th></tr>";
            echo "<tr><td>".$data['User']."</td></tr>";
            //Loop and create table 
            while ($row = $result->fetch_assoc()) {
                // var_dump($data);
                echo "<tr><td>".$data['user']."</td><td>".$data['name']."</td>
                <td>".$data['surname']."</td><td>".$data['dateOfBrith']."</td><td>".$data['email']."</td></tr>";
            }
        }
    ?>
</table>