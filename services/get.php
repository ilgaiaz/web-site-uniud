<div class="table-responsive">
    <table class="table table-striped">
        <?php
            session_start();
            require_once('config/mysql.php');
            $query="SELECT * FROM user_data WHERE user = '".$_SESSION["username"]."';";
            $result = mysqli_query($conn,$query);
            $data = mysqli_fetch_assoc($result);
            $row = mysqli_num_rows($result);
            if($row=="") {
                echo "Error";
            } else {
            ?>
                <tr>
                    <th>Username</th>
                    <td><?=$data['user'];?></td>
                </tr>
                <tr>
                    <th>Nome</th>
                    <td><?=$data['name'];?></td>
                </tr>
                <tr>
                    <th>Cognome</th>
                    <td><?=$data['surname'];?></td>
                </tr>
                <tr>
                    <th>Data di nascita</th>
                    <td><?=$data['dateOfBirth'];?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$data['email'];?></td>
                </tr>
            <?php
            }
        ?>
    </table>
</div>