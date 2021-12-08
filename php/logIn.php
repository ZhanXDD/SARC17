<?php include "../php/menu.php" ?>
<?php include "./DbConfig.php"?>
<?php
	$feedback = "";
    if(isset($_POST['submit'])){
		
		try{
			$dsn = "mysql:dbname=$basededatos;host=$server";
			$dbh = new PDO($dsn, $user, $pass);
			//prepared statement
			$stmt = $dbh -> prepare("SELECT * FROM user WHERE email=? AND pass=?");
			$stmt -> bindParam(1, $_POST['email']);
			$crypt = hash('sha512',$_POST['password']);

			$stmt -> bindParam(2, $crypt);
			//execute statement
			$stmt -> execute();
			$row = $stmt -> fetch(PDO::FETCH_ASSOC);
			if($row != false){
				$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];

				$root = simplexml_load_file("../xml/users.xml");
				$user = $root -> addchild("user");
				$user -> addChild("email",$_POST['email']);
				$root -> asXML("../xml/users.xml");

				echo '<script type="text/javascript">
				window.location.href = "../php/inicio.php";
				</script>';
				exit();
			}else{
				echo "Credenciales incorrectas";
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
		<link rel="stylesheet" href="../style/logIn.css">
		<link rel="stylesheet" href="../style/body.css">
	</head>
	<body>
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



