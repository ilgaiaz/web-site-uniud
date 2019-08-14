<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Personal info</title>
      
      <meta name="description" content="Show profile data"/>
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
      <script type="text/javascript" src="script.js"></script>
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
      
      <?php
         session_start();
         if(isset($_POST["username"], $_POST["name"], $_POST["surname"], $_POST["email"]) ) {
            require_once('config/mysql.php');
            $error = FALSE;
            $query = "SELECT * FROM user_data WHERE user='".$_SESSION["username"]."';";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result); 
            $old_user = $row["user"];
            $old_email = $row["email"];
            //If user change check if is not still preset inside db
            if($_POST["username"] != $old_user){
               $query_user = "SELECT * FROM user_data WHERE user='".$_POST["username"]."';";
               $result_user = mysqli_query($conn,$query_user);
               $check_user = mysqli_num_rows($result_user);
               if($result_user->num_rows >= 1){
                  $error = TRUE;
                  ?>
                     <script>
                        $(document).ready(function(){
                           showMod();
                           errorMessage("#mod-error", "<strong>Errore: </strong>User non disponibile");
                        });
                    </script>
                  <?php
               }
            }
            //If email change check if is valid and not still preset inside db
            $email = $_POST["email"];
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            if($email != $old_email){
               $query_email = "SELECT * FROM user_data WHERE email='".$email."';";
               $result_email = mysqli_query($conn,$query_email);
               if($result_email->num_rows >= 1){
                  $error = TRUE;
                  ?>
                  <script>
                     $(document).ready(function(){
                        showMod();
                        errorMessage("#mod-error", "<strong>Errore: </strong>Email non disponibile");
                     });
                  </script>
                  <?php
               }
            }
            //If there are no error update the db
            if(!$error){
               require_once('services/modify.php');
               ?>
               <script>
                  $(document).ready(function(){
                     successMessage("#mod-success", "<strong>Successo: </strong>Dati aggiornati!");
                  });
               </script>
               <?php
               //header("Location: profile.php");
            }
         }
      ?>

      <div id="container-mod-data" class="container">
         <div class="jumbotron">
            <div id="show-info" >
               <!--Show table with data from db-->
               <h2>Dati personali</h2>
               <div id="mod-success" class="alert alert-success" style="display: none"></div>
               <?php
                  require_once('services/get.php');
               ?>   
               <div class="form-group">      
                  <button id="submit-mod-data" class="btn btn-primary">Modifica dati</button>
               </div>  
            </div>
            <!--Show table where is posible insert new data-->      
            <div id="mod-info" style="display: none">
               <h2>Modifica dati</h2>
               <div id="mod-error" class="alert alert-danger" style="display: none"></div>
               <form id="form-mod" class="form-horizontal" action="profile.php" method="POST">
                  <div class="table-responsive">
                     <table class="table table-striped table-hover">
                     <tr>
                        <th>Username</th>
                        <td><input type="text" id="uname" 
                        placeholder="Inserire username" name="username" value="<?=$data['user'];?>" required></td>
                     </tr>
                     <tr>
                        <th>Nome</th>
                        <td><input type="text" id="name" 
                        placeholder="Inserire nome" name="name" value="<?=$data['name'];?>" required></td>
                     </tr>
                     <tr>
                        <th>Cognome</th>
                        <td><input type="text" id="surname" 
                        placeholder="Inserire cognome" name="surname" value="<?=$data['surname'];?>" required></td>
                     </tr>
                     <tr>
                        <th>Data di nascita</th>
                        <td><input type="date" id="dateofbirth" 
                        name="date" value="<?=$data['dateOfBirth'];?>"></td>
                     </tr>
                     <tr>
                        <th>Email</th>
                        <td><input type="email" id="email" 
                        name="email" value="<?=$data['email'];?>" required></td>
                     </tr>
                     </table>
                     <div id="input-mod">     
                        <input id="submit-back-mod" type="button" class="btn btn-primary" value="Annulla">
                        <input id="submit-mod" type="submit" class="btn btn-primary" name="sub-data" value="Modifica">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- End Navbar -->
    </body>
</html>