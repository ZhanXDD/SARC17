<?php
	//a form was sent
	$feedback = "";
	if(isset($_POST['submit'])){
		//check for empty name
		if($_POST['nombre'] == ""){
			$feedback .= "Falta el nombre de usuario";
		}

		//check for empty comment
		if($_POST['comentario'] == ""){
			$feedback .= "<br>Falta el comentario";
		}

		//check for email
		if($_POST['correo'] == ""){
			$regex = "/^.+@.*\..{2,}$/";
			//check for correct format
			if(!preg_match($regex,$_POST['correo'])){
				$feedback .= "<br>Formato del correo incorrecto";	
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Libro de visitas</title>
		<meta charset="UTF-8">
		<script src="../js/verificacion.js"></script>
	</head>
	<body>
		<h1>Registrarse</h1><br>
		<div class = "form" id = "form" style="display: none;">
			<form method='POST' id='form' onsubmit='return verificarRegistro()'>
				<label>Nombre de usuario<small>*</small>: </label>
				<input type='text' id='nombre'><br>
				
				<label>Correo electronico<small>*</small>: </label>
				<input type='text' id='correo'><br>
				
				<label>Numero de telefono: </label>
				<input type='text' id='numero'><br>
				
				<label>Contraseña<small>*</small>: </label>
				<input type='password' id='password'><br>
				<label>Repetir contraseña<small>*</small>: </label>
				<input type='password' id='password2'><br>
				
				<input type='submit' id='submn it' value='Registrarse'><br>
			</form>
		</div>
	</body>
</html>
