<?php include "./DbConfig.php"?><?php
	//a form was sent
	$feedback = "";
	$feedbackEmail = "";
	$feedbackPassword = "";
    if(isset($_POST['submit'])){
		//check for empty email
		if($_POST['email'] == ""){
			$feedbackNombre = "Falta el email";
			$feedback = "error";
		}
        //check for empty type
        if($_POST['password'] == ""){
			$feedbackNombre = "Falta el nombre de tipo de producto";
			$feedback = "error";
		}
    }

    if($feedback === ''){
        try{
            $dsn = "mysql:dbname=$basededatos;host=$local";
            $dbh = new PDO($dsn, $user, $pass);
            //prepared statement
            $stmt = $dbh -> prepare("SELECT password FROM user VALUES (?)");
            $stmt -> bindParam(1, $_POST['email']);
            //$stmt -> bindParam(2, $_POST['password']);

            //execute statement
            $stmt -> execute();

            if(($row=$stmt->fetch())!=null){
                if ($row['password']!=$_POST['password']){
                    $ImIn = "Contraseña incorrecta";
                }else{
                    //ANCHOR Crear sesión y redirigir a pagina principal
                }
            }else{
                $ImIn = "No hay ningun usuario registrado con ese email";
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
		<!-- <script src="../js/verificacion.js"></script> -->
		<link rel="stylesheet" href="../style/errors.css">
	</head>
	<body>
		<?php include "../php/menu.php" ?>
		<h1>Inicio de sesion</h1><br>
		<div class = "form" id = "form">
			<form method='POST' id='form'>
				Email: 
				<input type='text' id='email' name="email">
				<span class="error"><?php echo $feedbackNombre;?></span><br>
				
				Contraseña: 
				<input type='text' id='password' name="password">
				<span class="error"><?php echo $feedbackType;?></span><br>
				
				<input type='submit' id='submit' name="submit" value='Iniciar sesion'><br>
			</form>
		</div>
	</body>
</html>



