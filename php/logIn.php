<?php include "./DbConfig.php"?>
<?php
	$feedback = "";
    if(isset($_POST['submit'])){
		try{
			$dsn = "mysql:dbname=$basededatos;host=$local";
			$dbh = new PDO($dsn, $user, $pass);
			//prepared statement
			$stmt = $dbh -> prepare("SELECT * FROM user WHERE email=? AND password=?");
			$stmt -> bindParam(1, $_POST['email']);
			$stmt -> bindParam(2, hash('512',$_POST['password']));

			//execute statement
			$stmt -> execute();

			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row){
				echo "Sesion iniciado con exito";
			}else{
				echo "Error inesperado";
			}
		}catch(PDOException $e){
			echo $e -> getMessage();
		}
		$dbh = null;
    }


?>
<!DOCTYPE html>
<html>
	<head>
		<title>Iniciar Sesion</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="../style/errors.css">
	</head>
	<body>
		<?php include "../php/menu.php" ?>
		<h1>Inicio de sesion</h1><br>
		<div class = "form" id = "form">
			<form method='POST' id='form'>
				Email: 
				<input type='text' id='email' name="email"><br>
				
				Contraseña: 
				<input type='password' id='password' name="password"><br>
				
				<input type='submit' id='submit' name="submit" value='Iniciar sesion'><br>
			</form>
			<span class='error'><?php echo $feedback;?></span>
		</div>
	</body>
</html>



