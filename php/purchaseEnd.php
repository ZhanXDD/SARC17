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
		<link rel="stylesheet" href="..\style\logIn.css">
        <script src="../js/buyProduct.js"></script>
	</head>
    <body>
        <?php
            if ($row['stock']==0){
                echo('<h1> Lo sentimos, '.$productName.' no está disponible </h1>');
                echo('<div class="form"> En estos momentos no disponemos del producto seleccionado, sentimos las molestias');
            }
            else {
                echo("<h1> Gracias por su compra </h1>");
                echo("<div>".$productName." adquirido correctamente ");
            }
            echo('<input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>');
            echo('<input type="submit" value="cerrar sesión" onclick="logOut()"> </input>');
            echo('</div>');
        ?>
         
    </body>
</html>