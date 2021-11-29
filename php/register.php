<?php include "./Dbconfig.php"?>

<?php
	//a form was sent
	$feedback = "";
	$feedbackNombre = "";
	$feedbackPass = "";
	$feedbackPass2 = "";
	$feedbackCorreo = "";
	$feedbackTelefono = "";
	if(isset($_POST['submit'])){
		//check for empty name
		if($_POST['nombre'] == ""){
			$feedbackNombre = "Falta el nombre de usuario";
			$feedback = "error";
		}

		//check for password with at least 8 character
		if(!preg_match("/^.{8,}$/",$_POST['password'])){
			$feedbackPass= "La contraseña debe tener al menos 8 caracteres";
			$feedback = "error";
		}else{
			//Check if password and password2 are not the same
			if(!($_POST['password'] == $_POST['password2'])){
				$feedbackPass2 = "Las contraseñas no son iguales";
				$feedback = "error";
			}
		}

		//Check if numer is empty
		if($_POST['numero'] !== ""){
			if(!preg_match("/^\d{9,}$/",$_POST['numero'])){
				$feedbackTelefono = "Si inserta telefono, debe tener minimo 9 digitos";
				$feedback = "error";
			}
		}

		$regex = "/^.+@.*\..{2,}$/";
		//check for correct format
		if(!preg_match($regex,$_POST['correo'])){
			$feedbackCorreo = "Formato del correo incorrecto";
			$feedback = "error";	
		}

		//There has been no error
		if($feedback === ''){
			try{
				$dsn = "mysql:dbname=$basededatos;host=$local";
				$dbh = new PDO($dsn, $user, $pass);
				//prepared statement
				$stmt = $dbh -> prepare("INSERT INTO user (nombre, correo, numero, pass) VALUES (?,?,?,?)");
				$stmt -> bindParam(1, $_POST['nombre']);
				$stmt -> bindParam(2, $_POST['correo']);
				$stmt -> bindParam(3, $_POST['numero']);
				$stmt -> bindParam(4, hash("sha512",$_POST['password']));
				//execute statement
				$stmt -> execute();
			}catch(PDOException $e){
				echo $e -> getMessage();
			}
			$dbh = null;

			//move to login
			$root = simplexml_load_file("../xml/activeUsers.xml");
			$user = $root -> addchild("user");
			$user -> addAttribute("name",$_POST['nombre']);
			$user -> addChild("email",$_POST['correo']);
			
			//Formating XML
			$dom = new DOMDocument("1.0");
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($root->asXML());

			//Save xml
			$xml = new SimpleXMLElement($dom->saveXML());
			$xml -> asXML("../xml/users.xml");
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Libro de visitas</title>
		<meta charset="UTF-8">
		<!-- <script src="../js/verificacion.js"></script> -->
		<link rel="stylesheet" href="../style/errors.css">
	</head>
	<body>
		<?php include "../php/menu.php" ?>
		<h1>Registrarse</h1><br>
		<div class = "form" id = "form">
			<form method='POST' id='form'>
				Nombre de usuario<small>*</small>: 
				<input type='text' id='nombre' name="nombre">
				<span class="error"><?php echo $feedbackNombre;?></span><br>
				
				Correo electronico<small>*</small>: 
				<input type='text' id='correo' name="correo">
				<span class="error"><?php echo $feedbackCorreo;?></span><br>
				
				Numero de telefono: 
				<input type='text' id='numero' name="numero">
				<span class="error"><?php echo $feedbackTelefono;?></span><br>
				
				Contraseña<small>*</small>: 
				<input type='password' id='password' name="password">
				<span class="error"><?php echo $feedbackPass;?></span><br>
				Repetir contraseña<small>*</small>: 
				<input type='password' id='password2' name="password2">
				<span class="error"><?php echo $feedbackPass2;?></span><br>
				
				<input type='submit' id='submit' name="submit" value='Registrarse'><br>
			</form>
		</div>
	</body>
</html>
