<?php include "./menu.php"?>
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
        <script src="../js/jquery-3.4.1.min.js"></script>
		<link rel="stylesheet" href="..\style\viewProductList.css">
        <script src="../js/buyProduct.js"></script>
	</head>
    <body>
        <?php
            echo("<h1>".$productName."</h1>");
            echo('<div class="InfoProducto">');
            echo('<img src="../img/'.$_GET['id'].'.jpg" alt="No hay imagen"><br>');
            echo('Precio: '.$row['price'].'<br>');
            echo('Descripción: '. $row['description'].'<br>');

            if ($row['stock']==0) {
                echo('<span class="error"> El producto no está disponible </span> <br>');
                echo('<input type="submit" value="comprar"  onclick="goPurchaseEnd('.$row['id'].')" disable> </input> <br>');
            }
            else {
                echo('<input type="submit" value="comprar" onclick="goPurchaseEnd('.$row['id'].')"> </input>');
            
            }
            echo('<input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>');
            echo('</div>');
            echo('<br>');
        ?>
    </body>
</html>

