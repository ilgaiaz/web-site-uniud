<!doctype html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Software</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="images/icon.png">
		<script
			src="https://code.jquery.com/jquery-3.4.0.js"
			integrity="sha256-DYZMCC8HTC+QDr5QNaIcfR7VSPtcISykd+6eSmBW5qo="
			crossorigin="anonymous">
		</script>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/script.js?v=2"></script>
		<script type="text/javascript" src="js/cookie.js?v=2"></script>
		<script type="text/javascript" src="js/products.js?v=2"></script>
		<script type="text/javascript" src="js/table_search.js?v=2"></script>
	</head>
	<body>
		<div class="container" id="nav-placeholder">
				<script>
					$(function(){
						$("#nav-placeholder").load("includes/navbar.php", {navID: "nav-software"});
					});
				</script>
			</div>
		<div id="container-mod-data" class="container">
			<div class="jumbotron">
				<input type="text" id="myInput_l" class="tab_input" onkeyup="search('myInput_l','products-table',0)" placeholder="Cerca linguaggio.." title="Type in a name">
				<input type="text" id="myInput_c" class="tab_input" onkeyup="search('myInput_c','products-table',1)" placeholder="Cerca componente.." title="Type in a name">
				<div class="table-responsive">
					<div class="table-responsive">
						<table id="products-table" class="table table-hover">				
							<?php				
								require_once("config/mysql.php");
								//Create a query who get info from product and software and group the component who use the same sw
								//Then order everything by sw name
								$query = "SELECT GROUP_CONCAT(products.product_name), software.name, software.description, software.link 
								FROM products JOIN hw_sw ON hw_sw.hwID = products.id JOIN software ON hw_sw.swID = software.softwareID
								GROUP BY software.name ORDER BY software.name ASC";
								$result = mysqli_query($conn,$query);
								if($result->num_rows)
								{
									?>
										<tr>
											<th>Software</th>
											<th>Prodotto associato</th>
											<th>Descrizione</th>
											<th>Link utili</th>
										</tr>
									<?php
									while($row = mysqli_fetch_assoc($result)){
										?>
											<tr class="text">										
												<td><?php echo $row["name"]?></td>	
												<td>
													<div class="long-text"><?php echo $row["GROUP_CONCAT(products.product_name)"]?></div>
												</td>
												<td><div class="long-text"> <?php echo utf8_encode($row["description"])?> </div> </td>
												<td class="long-link">
													<?php echo '<a target="_blank" rel="noopener noreferrer" href="'.$row["link"].'">'.$row["link"].'</a>' ?>
												</td>
											</tr>
										<?php									
									}								
								}
							?>					
						</table>
					</div>
				</div>
			</div>
		</div>	
	</body>
</html>