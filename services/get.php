<table border="1">
    <?php
        require_once('../config/mysql.php');
        $query='SELECT * FROM user_data';
        $result = $conn->query($query);
        if(!$result) {
            echo "Error";
        }
        //Loop and create table 
        while ($data = $result->fetch_array()) {
            // var_dump($data);
            echo "<tr><td>".$data['User']."</td></tr>";
        }
    ?>
</table>