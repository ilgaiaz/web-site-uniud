<div>
    <table class="table table-striped table-hover">
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
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Nome</th>
                    <th>Cognome</th>
                    <th>Data di nascita</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$data['user'];?></td>
                        <td><?=$data['name'];?></td>
                        <td><?=$data['surname'];?></td>
                        <td><?=$data['dateOfBirth'];?></td>
                        <td><?=$data['email'];?></td>
                    </tr>
                    </tbody>
            <?php
            }
        ?>
    </table>
</div>