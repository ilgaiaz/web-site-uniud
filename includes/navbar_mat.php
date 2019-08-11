<nav class="navbar navbar-expand-md bg-dark navbar-dark">
	  
<!--
	 Toggler/collapsibe Button 
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
		<span class="navbar-toggler-icon"></span>
	</button>
	
-->
	<!-- Navbar links -->
	<div class="container" id="collapsibleNavbar">
		<a class="navbar-brand navbar-right" href="../index.html">
        <img id="logo" src="../images/logo.png" alt="logo">
    	</a>
		<ul class="navbar-nav">
			<li class="nav-item active">
			  <a class="nav-link" href="../index.html">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="#">Progetti</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="../galleria/index.php">Galleria</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
        <!--Check login and set links -->
        <?php
            session_start();
            //Check login. If is done show username in navbar
            if($_SESSION['logged_in']===TRUE){
                //require_once('config/mysql.php');
                //$query='SELECT * FROM user_data';
                //$result = $conn->query($query);
        ?>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
        <?php
                //--Print user name --
                echo $_SESSION['username'];
        ?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../pwrecovery.php">Cambia Password</a>
                    <a class="dropdown-item" href="#">Informazioni personali</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
                </li>
        <?php } else { ?>
                <!-- If the the login is't done show signin and login link -->
                <li class="nav-item"> 
                    <a id="sign-in" class="nav-link" href="../signin.php">Registrati</a>
                </li>
                <li class="nav-item"> 
                    <a id="login" class="nav-link" href="../login.php">Login</a>
                </li>
        <?php } ?>
    </ul>
	</div>
</nav>