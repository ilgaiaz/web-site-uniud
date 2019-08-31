<html>
	<head>
		<meta charset="utf-8">
		<title>Store</title>
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
   	</head>

    <body>
        <div class="container" id="nav-placeholder">
		<script>
            $(function(){
                $("#nav-placeholder").load("includes/navbar.php", {navID: "nav-user"});
            });
        </script>
        </div>
        <div id="container-mod-data" class="container">
            <div class="jumbotron">
				<div class="table-responsive">
					<table id="products-table" class="table table-hover">
						<?php
							session_start();
							require_once("config/mysql.php");
							if(isset($_POST['sub-del'])){
								$query_delete = "DELETE FROM products_stored WHERE userID = '".$_SESSION["userID"]."'";
								mysqli_query($conn,$query_delete);
							}
							$query_user = "SELECT * FROM products_stored WHERE userID = '".$_SESSION["userID"]."'";
							$result_user = mysqli_query($conn,$query_user);
							$row_id = mysqli_fetch_assoc($result_user);
							if($result_user->num_rows){
								$product_id = unserialize($row_id["productsID_array"]);
								?>			
								<thead>
									<tr>
										<th>Prodotto</th>
										<th>Nome</th>
										<th>Descrizione</th>
										<th>Potenza</th>
										<th>Prezzo</th>
										<th>Esempi</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$total_p = 0;
								$total_c = 0;
								foreach ($product_id as $value) {
									$query = "SELECT products.path, products.product_name,specs.description,specs.absorbed_power, specs.id,products.price 
									FROM products JOIN specs ON products.id=specs.id WHERE products.id = '".$value."'";
									$result = mysqli_query($conn,$query);
									$row = mysqli_fetch_assoc($result);
									if($result->num_rows){
										//save data into variable and show in a table
										$ind = $row['id'];
										$path = $row['path'];
										$name = $row['product_name'];
										$descr = $row['description'];
										$pow = $row['absorbed_power'];
										$cost = $row['price'];
										
										$query2 = "SELECT link FROM `link_esempi` WHERE ID = '".$ind."'";
										$result2 = mysqli_query($conn,$query2);
										?>
										<tr>
											<td class="prod-img"><img class="img-project" src="<?php echo $path;?>"></td>
											<td class="prod-spec-name"><?php echo $name;?></td>
											<td class="prod-spec-description">
												<div class="long-text"><?php echo utf8_encode($descr);?></div>
											</td>
											<td class="prod-spec-power" nowrap><?php echo $pow ;?> W</td>
											<td class="prod-spec-cost" nowrap>€ <?php echo $cost ;?></td>
											<td class="prod-spec-link" nowrap>
                                            <?php 
                                                if($result2->num_rows){
													$j = 1;
													while($row2 = mysqli_fetch_assoc($result2)){			
														echo '<a target="_blank" rel="noopener noreferrer" href="'.$row2["link"].'">Esempio '.$j.'';
														echo '<br>';
														$j++;
													}
                                                }
                                            ?>
                                            </td>
										</tr>
										<?php
									}
									$total_p += $pow;
									$total_c += $cost;
								} 	
								?>
								</tbody>
								<tfoot>
									<tr>
										<td>Totale</td>
										<td></td>
										<td></td>
										<td id="p_tot"><?php echo $total_p; ?> W</td>
										<td id="c_tot">€ <?php echo $total_c; ?></td>
										<td></td>
									</tr>
								</tfoot>
					</table>
				</div>
					<form id="form-delete-stored class="form-horizontal was-validated" action="products.php" method="POST">
						<div id="input-mod">     
							<input id="submit-delete-search" type="submit" class="btn btn-primary" name="sub-del" value="Elimina">
						<div id="delete-data" style="display: none"></div>
					</form>
			
								
								<?php
							}else{
								?>
								<div>
									<h2>Nessun elemento salvato</h2>
									<p>Se desideri salvare una ricerca vai nella pagina "componenti" e salva i tuoi prodotti</p>
									<input id="go-to-search" type="submit" class="btn btn-primary" name="sub-go" value="Vai" onclick="location.href = 'projects.php'">
								</div>
								<?php
							}
								?>
				</div>	
            </div>
        </div>
    </body>
</html>