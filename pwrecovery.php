<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>PW Recovery page</title>
      <meta name="description" content="Login to your profile"/>
      <meta name="author" content="Michele Gaiarin"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
      <script type="text/javascript" src="js/cookie.js?v=2"></script>
   </head>
   <body> 
      <!--Navbar show -->
      <div class="container" id="nav-placeholder">
         <script>
            $(function(){
               $("#nav-placeholder").load("includes/navbar.php");
            });
         </script>
      </div>
      <!-- End Navbar -->
      <?php
         session_start();
         if(isset($_POST["password"]) && isset($_POST["confirm_password"]) && (!empty($_POST["reset"]))){
            require_once('config/mysql.php');
            $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            $query = "UPDATE user_data SET PASSWORD = '".$pass."'WHERE user ='".$_SESSION["username"]."';";
            mysqli_query($conn,$query);
            header("Location: pwreset_success.html");
         }
      ?>
      <div class="container"> 
         <div class="jumbotron">
            <div id="container-resetpw" class="form-container container">   
               <form id="form-resetpw" class = "form-horizontal was-validated" action="pwrecovery.php" method = "post"
                     oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "La password non combacia" : "")'>
                  <div class="col-sm">
                     <h1>Modifica password:</h1>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm" for="pwd">Nuova Password</label>
                     <div class="col-sm">
                        <input type="password" class="form-control" id="psw1" placeholder="Inserire nuova password" name="password" value="" minlength="8" required>
                           <div class="valid-feedback">Valida.</div>
                           <div class="invalid-feedback">Per favore compila il campo.</div>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="control-label col-sm" for="pwd">Verifica nuova password</label>
                     <div class="col-sm">
                        <input type="password" class="form-control" id="psw1check" placeholder="Conferma password" name="confirm_password" value="">
                        <div class="valid-feedback">Valida.</div>
                        <div class="invalid-feedback">La password non corrisponde.</div>
                        <div id="message"></div>
                     </div>
                  </div>
                  <div class="form-group">        
                     <div class="col-sm-offset-2 col-sm">
                        <input id="submit-signin" type="submit" class="btn btn-primary" name="reset" value="Reset">
                     </div>
                  </div>
               </form> 
            </div>
         </div>
      </div>
   </body>
</html>