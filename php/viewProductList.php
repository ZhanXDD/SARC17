<?php include "./DbConfig.php"?>

<!DOCTYPE html>
<html>
	<head>
		<title>Lista de Productos</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="..\style\viewProductList.css">
	</head>
	<body>
        <a href "top"></a>
		<h1>Lista de productos</h1>
        <p> A continuación se muestran todos los productos disponibles en nuestra tienda.
            <a href="menu.php"> volver al menú principal </a>
        </p>
        <?php
            try {
                //Open connection with the databse
                $dsn ="mysql:dbname=$basededatos;host=$server";
                $dbh = new PDO($dsn, $user, $pass);

                //Prepare statement
                $stmt = $dbh -> prepare("SELECT * FROM product");

                //Execute statement
                $stmt -> execute();

                //close connection
                $dbh = null;
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }

            //Get the number of diferent products (number of rows)
            $numProducts=$stmt->rowCount();

            //No products available
            if($numProducts==0) {
                echo('No hay ningún producto en nuestra tienda');
            }
            
            //Show all the available products 
            else {
                foreach($stmt->fetchAll(PDO::FETCH_OBJ) as $producto) {
                    echo('<div class="InfoProducto">');
                    echo('Nombre de producto:   '.$producto->name.'<br>');
                    echo('Tipo de producto:     '.$producto->type.'<br>');
                    echo('Precio:               '.$producto->price.' € <br>');
                    echo('Unidades disponibles: '.$producto->stock.'<br>');
                    if($producto->description) {
                        echo('Descripción:          '.'<br>');
                        echo(''.$producto->description.'<br>');
                    }
                    echo('</div>');
                    echo('<br>');
                }
            }
            echo('<br>');
        ?>
        <a href="#top">Volver al comienzo de la página</a> 
	</body>
</html>