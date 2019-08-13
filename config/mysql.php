<?php
$servername = "eu-cdbr-west-02.cleardb.net";
$username = "b6df9263765a9a";
$password = "13c81934";
$db = "heroku_1c6bc9375739b50";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
?>
    <div id="container-conn-error" class=" container">
        <div class="jumbotron">
            <div class="form-container">
                <div class="col-sm">
                    <?php
                        die("Connection failed: " . $conn->connect_error);
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
