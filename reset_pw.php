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
         require 'vendor/autoload.php';
         session_start();
         require_once('config/mysql.php');
         if(isset($_POST["email"]) && (!empty($_POST["email"]))){
            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$email) {
               $error .="<p>Invalid email address please type a valid email address!</p>";
            }else{
               $sel_query = "SELECT * FROM `user_data` WHERE email='".$email."'";
               $results = mysqli_query($conn,$sel_query);
               $row = mysqli_num_rows($results);
               if ($row==""){
                  $error .= "<p>No user is registered with this email address!</p>";
               }
            }
            if($error!=""){
            ?>
               <div id="container-resetpw" class=" container">
                  <div class="jumbotron">
                     <div class="form-container">
                        <div class="col-sm">
                           <div class="alert alert-error">
                              <p> <?=$error ?></p>
                              <br><a href='javascript:history.go(-1)'>Torna indietro</a>";
                           </div>  
                        </div>
                     </div>
                  </div>
               </div>
            <?php
            }else{
               $expFormat = mktime(
               date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));

               /*Create the  email's message and save into db*/
               $expDate = date("Y-m-d H:i:s",$expFormat);
               $key = md5(2418*2+$email);
               $addKey = substr(md5(uniqid(rand(),1)),3,10);
               $key = $key . $addKey;
               // Insert Temp Table
               $conn->query("INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) 
                  VALUES ('".$email."', '".$key."', '".$expDate."');");
               
               $output='<p>Dear user,</p>';
               $output.='<p>Please click on the following link to reset your password.</p>';
               $output.='<p>-------------------------------------------------------------</p>';
               $output.='<p><a href="https://web-application-uniud.herokuapp.com/pwrecovery.php?
               key='.$key.'&email='.$email.'&action=reset" target="_blank">
               https://web-application-uniud.herokuapp.com/pwrecovery.php
               ?key='.$key.'&email='.$email.'&action=reset</a></p>';
               $output.='<p>-------------------------------------------------------------</p>';
               $output.='<p>Please be sure to copy the entire link into your browser.
               The link will expire after 1 day for security reason.</p>';
               $output.='<p>If you did not request this forgotten password email, no action 
               is needed, your password will not be reset. However, you may want to log into 
               your account and change your security password as someone may have guessed it.</p>';   
               $output.='<p>Thanks,</p>';
               $output.='<p>Uniud Team</p>';
            
               //Email's data
               $body = $output; 
               $subject = "Password Recovery";
               $from = new SendGrid\Email(null, "app142461076@heroku.com");
               $to = new SendGrid\Email(null, $email);
               $content = new SendGrid\Content("text/html", $output);
               $mail = new SendGrid\Mail($from, $subject, $to, $content);
               
               $apiKey = getenv('SENDGRID_API_KEY');
               $sg = new \SendGrid($apiKey);
               try {
                  $response = $sg->client->mail()->send()->post($mail);
                  /*echo $response->statusCode();
                  echo $response->body();
                  echo $response->headers();*/
               } finally {
               ?>
                  <div id="container-resetpw" class=" container">
                     <div class="jumbotron">
                        <div class="form-container">
                           <div class="col-sm">
                              <div class="alert alert-success">
                                 <p>Una mail è stata inviata al tuo indirizzo con un link per aggiornare la password</p>
                              </div>  
                           </div>
                        </div>
                     </div>
                  </div>
               <?php
               }
            }
         }else{
      ?>
            <div class="container">
	            <div class="jumbotron">
                  <div id="container-resetpw" class="form-container container">
                     <div id="login-error" class="error-warning col-sm">
                     </div>
                     <form id="form-resetpw" class = "form-horizontal was-validated" action="reset_pw.php" method = "post">
                        <div class="col-sm">
                           <h2>Inserire credenziali:</h2>
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
               </div>
            </div> 
      <?php } ?>  
   </body>
</html>