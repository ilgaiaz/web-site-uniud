<div class="table-responsive">
    <table class="table table-striped table-hover">
        <?php
            $name = array();
            $descr = array();
            $pow = array();
            $prezzo = array();
            $link = array();
            $i = 0;
            require_once("config/mysql.php");
            $query = "SELECT prodotti.link, prodotti.nome_prodotto,specs.descrizione,specs.potenza_assorbita,prodotti.prezzo 
            FROM prodotti JOIN specs ON prodotti.ind=specs.ind";
            $result = mysqli_query($conn,$query);
        
            if($result->num_rows){
                while($row = mysqli_fetch_assoc($result)){
                    $link[$i] = $row['link'];
                    $name[$i] = $row['nome_prodotto'];
                    //echo $row['nome_prodotto'];
                    $descr[$i] = $row['descrizione'];
                    //echo $row['descrizione'];
                    $pow[$i] = $row['potenza_assorbita'];
                    //echo $row['potenza_assorbita'];
                    $prezzo[$i] = $row['prezzo'];	
                    ?>
                        <tr>
                        <th>Prodotto</th>
                        <td><img src="<?php echo $link[$i]; ?>"></td>
                        <th>Descrizione</th>
                        <td></td>
                        <th>Prezzo</th>
                        <td></td>
                        </tr>
                    <?php
                    $i++;
                }		
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