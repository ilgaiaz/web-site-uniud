<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Reset Password Page</title>
      
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
      <!--   PHP script password recovery-->
      <?php
      
      session_start();
      
      if(!empty($_POST["passbtn"]))
      {
         require_once('config/mysql.php');
         
         $query = "SELECT * from user_data WHERE user = '".$_POST["username"]."' AND email = '".$_POST["email"]."'; ";
         $result = mysqli_query($conn,$query);
         $user = mysqli_fetch_array($result);
         
         if(!empty($user))  //check if user is in database
         {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["email"] = $_POST["email"];
            header("Location: pwrecovery.php");
         }
         else
         {
         ?> <script>
               $(function(){
                  $("#login-error").append("<p>Utente non presente nel database</p>");
               });
            </script>
         <?php
         }   
      }
      
      ?>
      <div id="container-resetpw" class="form-container container">
         <div id="login-error" class="error-warning col-sm">
         </div>
         <form id="form-resetpw" class = "form-horizontal was-validated" action="reset_pw.php" method = "post">
            <div class="col-sm">
               <h2>Inserire credenziali:</h2>
            </div>
            
            <div class="form-group">
               <label class="control-label col-sm" for="uname">Username</label>
               <div class="col-sm">
                  <input type="text" class="form-control" id="uname" placeholder="Inserire username" name="username" value="" required>
                     <div class="valid-feedback">Valido.</div>
                     <div class="invalid-feedback">Per favore compila il campo.</div>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm" for="email">E-mail</label>
               <div class="col-sm">
                  <!-- 
                  <input type="password" class="form-control" id="pwd" placeholder="Inserire password" name="pswd" required>
                  -->
                  <input type="email" class="form-control" id="email" placeholder="Inserire E-mail" name="email" value="" required>
                  <div class="valid-feedback">Valida.</div>
                  <div class="invalid-feedback">Per favore compila il campo.</div>
               </div>
            </div>
            <div class="form-group">        
               <div class="col-sm-offset-2 col-sm">
                  <input type="submit" class="btn btn-primary" name="passbtn" id="passbtn" value="Invia">
               </div>
            </div>
         </form>  
      </div>   
   </body>
</html>