<?php include "./DbConfig.php"?>

<?php
	//a form was sent
	$feedback = "";
	if(isset($_POST['submit'])){
		//check for empty name
		if($_POST['name'] == ""){
			$feedback = "error";
		}

		//check for password with at least 8 character
		if(!preg_match("/^.{8,}$/",$_POST['password'])){
			$feedback = "error";
		}else{
			//Check if password and password2 are not the same
			if(!($_POST['password'] == $_POST['password2'])){
				$feedback = "error";
			}
		}

		//Check if numer is empty
		if($_POST['phone'] !== ""){
			if(!preg_match("/^\d{9,}$/",$_POST['phone'])){
				$feedback = "error";
			}
		}

		$regex = "/^.+@.*\..{2,}$/";
		//check for correct format
		if(!preg_match($regex,$_POST['email'])){
			$feedback = "error";	
		}

		//There has been no error
		if($feedback === ''){
			try{
				$dsn = "mysql:dbname=$basededatos;host=$local";
				$dbh = new PDO($dsn, $user, $pass);
				//prepared statement
				$stmt = $dbh -> prepare("INSERT INTO user VALUES (?,?,?,?)");
				$stmt -> bindParam(1, $_POST['name']);
				$stmt -> bindParam(2, $_POST['email']);
				$stmt -> bindParam(3, $_POST['phone']);
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
			$user -> addAttribute("name",$_POST['name']);
			$user -> addChild("email",$_POST['email']);
			
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
				<span class="error" id="nameError"></span><br>
				
				Correo electronco<small>*</small>: 
				<input type='text' id='email' name="email">
				<span class="error" id="emailError"></span><br>
				
				Numero de telefono: 
				<input type='text' id='phone' name="phone">
				<span class="error" id="phoneError"></span><br>
				
				Contraseña<small>*</small>: 
				<input type='password' id='password' name="password">
				<span class="error" id="passError"></span><br>
				Repetir contraseña<small>*</small>: 
				<input type='password' id='password2' name="password2">
				<span class="error" id="pass2Error"></span><br>
				
				<input type='submit' id='submit' name="submit" value='Registrarse'><br>
			</form>
			<span class="error" id="generalError"></span>
		</div>
	</body>
</html>
