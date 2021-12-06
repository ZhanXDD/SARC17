<?php include "./DbConfig.php"?>

<?php
	//a form was sent
	$feedback = "";
	$errorName = "";
	$errorPass = "";
	$errorPass2 = "";
	$errorPhone = "";
	$errorEmail = "";
	if(isset($_POST['submit'])){
		//check for empty name
		if($_POST['name'] == ""){
			$errorName = "El nombre esta vacio";
			$feedback = "error";
		}

		//check for password with at least 8 character
		if(!preg_match("/^.{8,}$/",$_POST['password'])){
			$errorPass = "La contraseña tiene que tener al menos ocho caracteres";
			$feedback = "error";
		}else{
			//Check if password and password2 are not the same
			if(!($_POST['password'] == $_POST['password2'])){
				$errorPass2 = "Las contraseñas no coinciden";
				$feedback = "error";
			}
		}

		//Check if phone is empty
		if($_POST['phone'] !== ""){
			if(!preg_match("/^\d{9,}$/",$_POST['phone'])){
				$errorPhone = "El numero de telefono tiene que tener al menos 9 numeros";
				$feedback = "error";
			}
		}

		$regex = "/^.+@.*\..{2,}$/";
		//check for correct format for email
		if(!preg_match($regex,$_POST['email'])){
			$errorEmail = "El email tiene el formato el incorrecto";
			$feedback = "error";	
		}

		//There has been no error
		if($feedback === ''){
			try{
				$dsn = "mysql:dbname=$basededatos;host=$server";
				$dbh = new PDO($dsn, $user, $pass);

				$crypth = hash("sha512",$_POST['password']);
				//prepared statement
				$stmt = $dbh -> prepare("INSERT INTO user VALUES (?,?,?,?)");
				$stmt -> bindParam(1, $_POST['name']);
				$stmt -> bindParam(2, $_POST['email']);
				$stmt -> bindParam(3, $_POST['phone']);
				$stmt -> bindParam(4, $crypth);
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
		<title>Registrarse</title>
		<meta charset="UTF-8">
		<script src='../js/jquery-3.4.1.min.js'></script>
		<script src="../js/verificacion.js"></script>
		<link rel="stylesheet" href="../style/errors.css">
	</head>
	<body>
		<?php include "../php/menu.php" ?>
		<h1>Registrarse</h1><br>
		<div class = "form" id = "form">
			<form method='POST' id='form'>
				Nombre de usuario<small>*</small>: 
				<input type='text' id='name' name="name">
				<span class="error" id="nameError"><?php echo $errorName;?></span><br>
				
				Correo electronico<small>*</small>: 
				<input type='text' id='email' name="email">
				<span class="error" id="emailError"><?php echo $errorEmail;?></span><br>
				
				Numero de telefono: 
				<input type='text' id='phone' name="phone">
				<span class="error" id="phoneError"><?php echo $errorPhone;?></span><br>
				
				Contraseña<small>*</small>: 
				<input type='password' id='password' name="password">
				<span class="error" id="passError"><?php echo $errorPass;?></span><br>
				Repetir contraseña<small>*</small>: 
				<input type='password' id='password2' name="password2">
				<span class="error" id="pass2Error"><?php echo $errorPass2;?></span><br>
				
				<input type='submit' id='submit' name="submit" value='Registrarse'><br>
			</form>
			<span class="error" id="generalError"></span>
		</div>
	</body>
</html>
