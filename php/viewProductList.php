<?php include "./menu.php"?>
<?php include "./DbConfig.php"?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lista de Productos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="..\style\viewProductList.css">
        <script src="../js/buyProduct.js"></script>
	</head>
	<body>
        <a href "top"></a>
		<h1>Lista de productos</h1>
        <p> A continuación se muestran todos los productos disponibles en nuestra tienda.
            <a href="menu.php"> volver al menú principal </a>
        </p>
        <br>
        <?php
            try {
                //Open connection with the databse
                $dsn ="mysql:dbname=$basededatos;host=$server";
                $dbh = new PDO($dsn, $user, $pass);

                //Prepare statement
                $stmt = $dbh -> prepare("SELECT * FROM product");

                //Execute statement
                $stmt -> execute();

                //Get the number of diferent products (number of rows)
                $numProducts=$stmt->rowCount();
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }
            //close connection
            $dbh = null;
            
            //No products available
            if($numProducts==0) {
                echo('No hay ningún producto en nuestra tienda');
            }
            
            //Show all the available products 
            else {
                foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $producto) {
                    echo('<div class="InfoProducto">');
                    echo('Nombre de producto:   '.$producto->name.'<br>');
                    //echo('Tipo de producto:     '.$producto->type.'<br>');
                    echo('Precio:               '.$producto->price.' € <br>');
                    //echo('Unidades disponibles: '.$producto->stock.'<br>');
                    /*
                    if($producto->description) {
                        echo('Descripción:          '.'<br>');
                        echo(''.$producto->description.'<br>');
                    }*/
                    echo('<img src="../img/'.$producto->id.'.jpg" class="rightImg" alt="No hay imagen"><br><br>');
                    echo('<input type="submit" value="comprar objeto" onclick="buyProduct('.$producto->id.')"> </input>');
                    echo('</div>');
                    echo('<br>');
                }
            }
            echo('<br>');
        ?>
        <a href="#top">Volver al comienzo de la página</a> 
	</body>
</html>