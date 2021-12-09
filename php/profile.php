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
                $stmt = $dbh -> prepare("SELECT * FROM user WHERE email=?");
                $stmt -> bindParam(1, $_GET['email']);
                //execute statement
                $stmt -> execute();

                //Get the product
                $row = $stmt -> fetch(PDO::FETCH_ASSOC);
                $userName=$row['name'];
                echo("<title> Perfil: ".$userName."</title>");

                //close connection
                $dbh = null;
            }
            catch(PDOException $e) {
                echo $e -> getMessage();
            }
        ?>
		<meta charset="UTF-8">
        <link rel="stylesheet" href="..\style\body.css">
		<link rel="stylesheet" href="..\style\logIn.css">
        <script src="../js/buyProduct.js"></script>
	</head>
    <body>
        <?php
            echo("<h1> Perfil de usuario </h1>");
            echo('<div class="form">');
            echo('Nombre de usuario : '.$row['name'].'<br>');
            echo('Correo electrónico: '. $row['email'].'<br>');
            echo('Número de teléfono: '. $row['phone'].'<br>');
            echo('Número de artículos comprados: '. $row['articles'].'<br>');
            echo('Dinero total gastado: '. $row['spent'].'<br>');
            echo('<input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>');
            echo('</div>');
            echo('<br>');
        ?>
        
    </body>
</html>