<html>
	<head>
		<meta charset="utf-8">
		<title>Componenti</title>
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
                    $("#nav-placeholder").load("includes/navbar.php", {navID: "nav-component"});
                });
            </script>
        </div>
        <div id="container-mod-data" class="container">
            <div class="jumbotron">
                <!--<div class="container">
                    Add some description
                </div> -->
                <input type="text" id="myInput" class="tab_input" onkeyup="search('myInput','products-table',1)" placeholder="Cerca componente.." title="Type in a name">
                <div class="table-responsive">
                    <table id="products-table" class="table table-hover">
                        <?php
                            /*retrieve data about product with a join*/
                            $name = array();
                            $descr = array();
                            $pow = array();
                            $prezzo = array();
                            $path = array();
                            $ind = array();
                            $i = 0;
                            require_once("config/mysql.php");
                            $query = "SELECT products.path, products.product_name,specs.description,specs.absorbed_power, specs.id,products.price 
                            FROM products JOIN specs ON products.id=specs.id ORDER BY products.product_name ASC";
                            $result = mysqli_query($conn,$query);
                        
                            if($result->num_rows){
                                ?>
                                    <thead>
                                        <tr>
                                            <th>Prodotto</th>
                                            <th>Nome</th>
                                            <th>Descrizione</th>
                                            <th>Potenza</th>
                                            <th>Prezzo</th>
                                            <th>Esempi di utilizzo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php
                                //save data into variable and show in a table
                                while($row = mysqli_fetch_assoc($result)){
                                    $ind[$i] = $row['id'];
                                    $path[$i] = $row['path'];
                                    $name[$i] = $row['product_name'];
                                    //echo $row['nome_prodotto'];
                                    $descr[$i] = $row['description'];
                                    //echo $row['descrizione'];
                                    $pow[$i] = $row['absorbed_power'];
                                    //echo $row['potenza_assorbita'];
                                    $cost[$i] = $row['price'];	

                                    $query2 = "SELECT link FROM `link_esempi` WHERE ID = '".$ind[$i]."'";
									$result2 = mysqli_query($conn,$query2);

                                    ?>
                                        <tr>
                                        <!--Add info and foreach row use the id value for rename the class so it can be easily managed-->
                                        <td class="prod-img-<?php echo $ind[$i];?>"><img value="prod-spec-<?php echo $ind[$i];?>" 
                                        class="img-project" src="<?php echo $path[$i];?>" onclick=toggleInfo(this)></td>
                                        <td class="prod-name"><?php echo $name[$i] ;?></td>
                                            <td class="prod-spec-<?php echo $ind[$i];?>" style="display: none"> 
                                                <div class="long-text"> <?php echo utf8_encode($descr[$i]) ;?> </div>
                                            </td>
                                            <td class="prod-spec-<?php echo $ind[$i];?>" style="display: none" nowrap><?php echo $pow[$i] ;?> W</td>
                                            <td class="prod-spec-<?php echo $ind[$i];?>" style="display: none" nowrap>€ <?php echo $cost[$i] ;?></td>
                                            <td class="prod-spec-<?php echo $ind[$i];?>" style="display: none" nowrap>
                                                <div class="long-text">
                                            <?php
                                                //Insert all the link stored in the link_esempi db 
                                                if($result2->num_rows){
													$j = 1;
													while($row2 = mysqli_fetch_assoc($result2)){			
														echo '<a target="_blank" rel="noopener noreferrer" href="'.$row2["link"].'">Esempio '.$j.'';
														echo '<br>';
														$j++;
													}
                                                }
                                            ?>
                                                </div>
                                            </td>
                                        
                                        </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td>Totale</td>
                                            <td></td>
                                            <td></td>
                                            <td id="p_tot">0</td>
                                            <td id="c_tot">0.00</td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                <?php
                            } else{
                            ?>
                                <script>			
                                    alert("errore nel risultato della query!");
                                </script>	
                            <?php
                            }
                        ?>
                    </table>
                </div>
                <div id="input-mod">     
                    <input id="submit-save-product" type="submit" class="btn btn-primary" name="sub-prod" value="Salva prodotti" style="display: none">
                    <div id="stored-data" style="display: none"></div>
                </div>
            </div>
        </div>
    </body>
</html>