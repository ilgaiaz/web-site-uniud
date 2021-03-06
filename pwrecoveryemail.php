<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>PW Recovery</title>
      <meta name="description" content="Login to your profile"/>
      <meta name="author" content="Michele Gaiarin"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
   </head>
   <body> 
      <!--Navbar show -->
      <div class="container" id="nav-placeholder">
         <script>
            $(function(){
               $("#nav-placeholder").load("includes/navbar.php", {navID: "nav-login"});
            });
         </script>
      </div>
      <!-- End Navbar -->
      <?php
         session_start();
         require_once('config/mysql.php');
         //retrieve info from the link stored in the link and check email and key
         if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
         && ($_GET["action"]=="reset") && !isset($_POST["action"])) { 
            $key = $_GET["key"];
            $email = $_GET["email"];
            $curDate = date("Y-m-d H:i:s");
            $sql = "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($query);
            //read value from db and check key and expiration date
            if ($row==""){
               $error .= '<h2>Link non valido</h2>
               <p>Il link utilizzato non è valido o è scaduto</p>';
            }else{
               $row = mysqli_fetch_assoc($query);
               $expDate = $row['expDate'];
               if ($expDate >= $curDate){
      ?>
                  <div class="container"> 
                     <div class="jumbotron">
                        <div id="container-resetpw-emal" class="form-container container">   
                           <form id="form-resetpw" class = "form-horizontal was-validated" action="" method = "post" name="update"
                                 oninput='confirm_password.setCustomValidity(confirm_password.value != password.value ? "La password non combacia" : "")'>
                              <input type="hidden" name="action" value="update" />
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
                              <input type="hidden" name="email" value="<?php echo $email;?>"/>
                              <div class="form-group">        
                                 <div class="col-sm-offset-2 col-sm">
                                    <input id="submit-signin" type="submit" class="btn btn-primary" name="reset" value="Reset">
                                 </div>
                              </div>
                           </form> 
                        </div>
                     </div>
                  </div>
      <?php
               } else {
                  $error .= "<h2>Link Expired</h2>
                  <p>The link is expired. You are trying to use the expired link which 
                  as valid only 24 hours (1 days after request).<br /><br /></p>";
               }
            }
         }
         if($error!=""){
      ?>
            <div id="container-email-error" class=" container">
               <div class="jumbotron">
                  <div class="form-container">
                     <div class="col-sm">
                        <div class="alert alert-error"><?=$error ?></div>  
                     </div>
                  </div>
               </div>
            </div>
      <?php
         } else {
            //If everything is ok update the password
            if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
               $pass = password_hash($_POST["password"], PASSWORD_ARGON2I);
               $query = "UPDATE user_data SET PASSWORD = '".$pass."'WHERE email ='".$_POST["email"]."';";
               mysqli_query($conn,$query);
               $remove = "DELETE FROM password_reset_temp WHERE email ='".$_POST["email"]."';";
               mysqli_query($conn,$remove);
               header("Location: pwreset_success.html");
            }
         }
      ?>
   </body>
</html>