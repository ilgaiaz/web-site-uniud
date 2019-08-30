<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Sign Up</title>
        <meta name="description" content="Web application final project"/>
        <meta name="author" content="Michele Gaiarin"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <link rel="icon" href="images/icon.png"/>
        <link rel="stylesheet" type="text/css" href="style.css"/>
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
        <script type="text/javascript" src="js/script.js?v=2"></script>
        <script type="text/javascript" src="js/cookie.js?v=2"></script>
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
            if(isset($_POST["username"], $_POST["password"], $_POST["name"], $_POST["surname"], $_POST["email"]) ) {             
                require_once('config/mysql.php');
                $query = "SELECT * FROM user_data WHERE email='".$_POST["email"]."';";
                $result = mysqli_query($conn,$query);
                //if there is already that username show error message otherside save data
                if (!$result->num_rows >= 1) {
                    $query = "SELECT * FROM user_data WHERE user='".$_POST["user"]."';";
                    $result = mysqli_query($conn,$query);
                    //if there is already that username show error message otherside save data
                    if (!$result->num_rows >= 1) {
                        $email = $_POST["email"];
                        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                        if(!$email){
                            ?>
                                <script>
                                    $(document).ready(function(){
                                        showDiv("#signin-error");
                                        errorMessage("#signin-error", "<strong>Errore: </strong>Email non valida");
                                    });
                                </script>
                            <?php
                        } else {
                            require_once("services/insert.php");
                            header("Location: signup_success.html");
                        }
                    } else {
                        ?>
                            <script>
                                $(document).ready(function(){
                                    showDiv("#signin-error");
                                    errorMessage("#signin-error", "<strong>Errore: </strong>Username già presente");
                                });
                            </script>
                        <?php
                    }
            } else { 
                //if there is already the email return error
                ?>
                    <script>
                        $(document).ready(function(){
                            showDiv("#signin-error");
                            errorMessage("#signin-error", "<strong>Errore: </strong>Email già presente");
                        });
                    </script>
                <?php 
                }   
            }
        ?>
        <div class="container">
	        <div class="jumbotron">
                <div id="container-signin" class="form-container container">
                    <div class="col-sm">
                        <h2>Registrazione</h2>
                    </div>
                    <!-- Error message if data is wrong -->
                    <div id="signin-error" class="alert alert-danger" style="display: none"></div>
                    <!-- ******** -->
                    <form id="form-signin" class="form-horizontal was-validated" action="signup.php" method="POST" 
                        oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "La password non combacia" : "")'>
                        <!-- Campo nome -->
                        <div class="form-group">
                            <label class="control-label col-sm">Nome</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="name" placeholder="Inserire nome" name="name" value="" required>
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <!-- Campo cognome -->
                        <div class="form-group">
                            <label class="control-label col-sm">Cognome</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="surname" placeholder="Inserire cognome" name="surname" value="" required>
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <!-- Campo data di nascita -->
                        <div class="form-group">
                            <label class="control-label col-sm">Data di nascita</label>
                            <div class="col-sm">
                                <input type="date" class="form-control" id="dateofbirth" name="date">
                            </div>
                        </div>
                        <!-- Campo email -->
                        <div class="form-group">
                            <label class="control-label col-sm">Email</label>
                            <div class="col-sm">
                                <input type="email" class="form-control" id="email" name="email" value="" required>
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div> 
                        <!-- user -->
                        <div class="form-group">
                            <label class="control-label col-sm" for="uname">Username</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" id="uname" placeholder="Inserire username" name="username" value="" required>
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <!-- password -->
                        <div class="form-group">
                            <label class="control-label col-sm" for="pwd">Password (almeno 8 caratteri)</label>
                            <div class="col-sm">
                                <input type="password" class="form-control" id="psw" placeholder="Inserire password" name="password" value="" minlength="8" required>
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">Per favore compila il campo.</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm" for="pwd">Verifica password</label>
                            <div class="col-sm">
                                <input type="password" class="form-control" id="psw-c" placeholder="Inserire password" name="confirm_password" value="">
                                <div class="valid-feedback">Valida.</div>
                                <div class="invalid-feedback">La password non corrisponde.</div>
                                <div id="message"></div>
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-2 col-sm">
                                <input id="submit-signin" type="submit" class="btn btn-primary" name="sub-data" value="Registrati">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>