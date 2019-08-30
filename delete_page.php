<html>
   <head>
   <meta charset="utf-8">
   <title>Delete user</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="icon" href="images/icon.png"/>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.js"></script>
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
      <div id="container-resetpw" class=" container">
         <div class="jumbotron">
            <div class="form-container">
               <div class="col-sm">
                  <div class="alert alert-danger">
                     <p><strong>Attenzione!</strong><br>Sicuro di voler eliminare il proprio account?</p>
                  </div> 
                  <form action="services/delete.php" method="POST">
                     <input type="submit" class="btn btn-primary" name="delete" value="Elimina utente" />
                  </form> 
               </div>
            </div>
         </div>
      </div>
   </body>
</html>