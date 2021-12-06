<?php include "./DbConfig.php"?>
<!DOCTYPE html>
<html>
	<head>
		<?php
            try {
                //Open connection with the databse
                $dsn ="mysql:dbname=$basededatos;host=$server";
                $dbh = new PDO($dsn, $user, $pass);
                //Prepare the statement
                $stmt = $dbh -> prepare("SELECT * FROM product WHERE id=?");
                $stmt -> bindParam(1, $_GET['id']);
                //execute statement
                $stmt -> execute();

                //Get the product
                $row = $stmt -> fetch(PDO::FETCH_ASSOC);
                $productName=$row['name'];
                echo("<title>".$productName."</title>");

                //close connection
                $dbh = null;
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }
        ?>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="..\style\viewProductList.css">
	</head>
    <body>
        <a href "top"></a>
        <?php
            echo("<h1>".$productName."</h1>");
            echo('<div class="InfoProducto">');
            echo('<img src="../img/'.$id.'.jpg" alt="No hay imagen">');
            echo('Precio: '.$row['price'].'<br>');
            echo('Descripción:<br>');
            echo($row['description']);
            echo('</div>')
        ?>
        <a href="#top">Volver al comienzo de la página</a> 
    </body>
</html>

