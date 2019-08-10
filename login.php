<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Login Page</title>
        <meta name="description" content="Login to your profile"/>
        <meta name="author" content="Michele Gaiarin"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <link rel="icon" href="images/icon.png"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script type="text/javascript" src="script.js"></script>
        <script
        src="https://code.jquery.com/jquery-3.4.0.js"
        integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
        crossorigin="anonymous">
        </script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <!--Navbar show -->
        <div class="container" id="nav-placeholder">
        </div>
        <script>
            $(function(){
            $("#nav-placeholder").load("includes/navbar.php");
            });
        </script>
        <!-- End Navbar -->
        <?php
            session_start();
            if(isset($_POST["username"]) && isset($_POST["password"])) {
                require_once('config/mysql.php');
                $pass = md5($_POST["password"]);
                $result = $conn->query("SELECT * FROM user_data WHERE user='".$_POST["username"]."' AND password='".$pass."';");
                if ($result->num_rows) {
                    $_SESSION["username"] = $_POST["username"];
                    header("Location: index.html");
                } else { 
                //if there are't that data in DB show an error message
                ?>
                    <script>
                        $(function(){
                            $("#login-error").append("<p>Username o password errato</p>");
                        });
                    </script>
                <?php
                }
            }   
        ?>
        <div class="container">
	        <div class="jumbotron">
                <div id="container-login" class="form-container container">
                    <div >
                        <h2>Inserire i dati:</h2>
                    </div>
                    <!-- Error message if data is wrong -->
                    <div id="login-error" class="error-warning col-sm">
                    </div>
                    <!-- ******** -->
                    <form id="form-login" class="form-horizontal was-validated" action="login.php" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm" for="uname">Username</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="uname" placeholder="Inserire username" name="username" value="" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm" for="pwd">Password</label>
                            <div class="col-sm">
                                <!-- 
                                <input type="password" class="form-control" id="pwd" placeholder="Inserire password" name="pswd" required>
                                -->
                                <input type="password" class="form-control" id="psw" placeholder="Inserire password" name="password" value="" required>
                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm">
                                <input type="submit" class="btn btn-primary" name="button" value="Accedi">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>