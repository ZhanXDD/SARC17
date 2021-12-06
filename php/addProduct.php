<?php include "../php/menu.php" ?>
<?php include "./DbConfig.php"?><?php
	//a form was sent
	$feedback = "";
	$feedbackName = "";
	$feedbackType = "";
	$feedbackStock = "";
	$feedbackPrice = "";
    $feedbackDescription = "";

    if(isset($_POST['submit'])){
		//check for empty name
		if($_POST['name'] == ""){
			$feedbackName = "Falta el nombre del producto";
			$feedback = "error";
		}
        //check for empty type
        if($_POST['type'] == ""){
			$feedbackType = "Falta el nombre de tipo de producto";
			$feedback = "error";
		}

        //check for empty description
        if($_POST['description'] == ""){
			$feedbackDescription = "Falta la descripcion de producto";
			$feedback = "error";
		}

        //Check if stock has valid format
		if(!preg_match("/^\d{1,5}$/",$_POST['stock'])){
			$feedbackStock = "El stock tiene que ser entre 0 y 99999";
			$feedback = "error";
		}
        //Check if price has valid format
		if(!preg_match("/^\d{1,5}(\.\d{1,2})?$/",$_POST['price'])){
			$feedbackPrice = "";
			$feedback = "error";
		}

        //There has been no error
		if($feedback === ''){
			try{
                $dsn = "mysql:dbname=$basededatos;host=$server";
				$dbh = new PDO($dsn, $user, $pass);
				//prepared statement
				$stmt = $dbh -> prepare("INSERT INTO product (name,type,stock,price,description) VALUES (?,?,?,?,?)");

				$stmt -> bindParam(1, $_POST['name']);
				$stmt -> bindParam(2, $_POST['type']);
				$stmt -> bindParam(3, $_POST['stock']);
                $stmt -> bindParam(4, $_POST['price']);
				$stmt -> bindParam(5, $_POST['description']);
				//execute statement
				$stmt -> execute();
            }catch(PDOException $e){
				echo $e -> getMessage();
			}
            $dbh = null;
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Añadir Producto</title>
		<meta charset="UTF-8">
		<!-- <script src="../js/verificacion.js"></script> -->
		<link rel="stylesheet" href="../style/errors.css">
	</head>
	<body>
		
		<h1>Añadir Producto</h1><br>
		<div class = "form" id = "form">
			<form method='POST' id='form'>
				Nombre de producto<small>*</small>: 
				<input type='text' id='name' name="name">
				<span class="error"><?php echo $feedbackName;?></span><br>

				Tipo de producto<small>*</small>: 
				<input type='text' id='type' name="type">
				<span class="error"><?php echo $feedbackType;?></span><br>
				
				Stock<small>*</small>: 
				<input type="number" id='stock' name="stock" step="any" min="1" value="1">
				<span class="error"><?php echo $feedbackStock;?></span><br>
				
				Precio<small>*</small>: 
				<input type="number" id='price' name="price" step="0.01" min="0" value="0.00">
				<span class="error"><?php echo $feedbackPrice;?></span><br>

				Descripcion<small>*</small>: 
				<input type='text' id='description' name="description">
				<span class="error"><?php echo $feedbackDescription;?></span><br>
				
				<input type='submit' id='submit' name="submit" value='Añadir producto'><br>
			</form>
		</div>
	</body>
</html>
