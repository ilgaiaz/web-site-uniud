<script>  
  /*Function for update nav active*/
  var el = document.getElementById("<?php echo $_POST["navID"]; ?>")
  if(el !== null){
    //document.getElementById("nav-home").classList.remove('active');
    el.classList.add('active');
  }
</script>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	  
	<!-- Toggler/collapsibe Button -->
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>
	
	<!-- Navbar links -->
	<div class="collapse navbar-collapse" id="collapsibleNavbar">
		<!--<a class="navbar-brand navbar-right" href="../index.html">
            <img id="logo" src="../images/logo.png" alt="logo">
    	</a>-->
		<ul class="navbar-nav">
			<li id="nav-home" class="nav-item">
			  <a class="nav-link" href="index.php">Home</a>
			</li>
			<li id="nav-component" class="nav-item">
			  <a  class="nav-link" href="projects.php">Componenti</a>
			</li>
			<li id="nav-software" class="nav-item">
			  <a class="nav-link" href="software.php">Software</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
        <!--Check login and set links -->
        <?php
            session_start();
            //Check login. If is done show username in navbar
            if(isset($_SESSION['username'])){
                //require_once('config/mysql.php');
                //$query='SELECT * FROM user_data';
                //$result = $conn->query($query);
        ?>
                <li id="nav-user" class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
        <?php
                //--Print user name --
                echo $_SESSION['username'];
        ?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="products.php">Componenti</a>
                    <a class="dropdown-item" href="profile.php">Visualizza profilo</a>
                    <a class="dropdown-item" href="pwrecovery.php">Cambia Password</a>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
                </li>
        <?php } else { ?>
                <!-- If the the login is't done show signin and login link -->
                <li id="nav-signup" class="nav-item"> 
                    <a id="sign-in" class="nav-link" href="signup.php">Registrati</a>
                </li>
                <li id="nav-login" class="nav-item"> 
                    <a id="login" class="nav-link" href="login.php">Login</a>
                </li>
        <?php } ?>
    </ul>
	</div>
</nav>