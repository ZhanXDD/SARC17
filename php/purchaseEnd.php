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
                $productPrice=$row['price'];
                echo("<title>".$productName."</title>");
                $productStock=$row['stock'];
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
                echo('<input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>');
                echo('<input type="submit" value="cerrar sesión" onclick="logOut()"> </input>');
                echo('</div>');
            }
            else {
                $feedback="";
                $feedbackCredit_card = "";
                $feedbackCard_number = "";
                $feedbackExpiration_date = "";
                $feedbackCard_cvc= "";
                

                


                if(isset($_POST['submit'])){
                    //check for empty name
                    if($_POST['credit_card'] == ""){
                        $feedbackCredit_card = "Falta el nombre del titular";
                        $feedback = "error";
                    }

                    //check for card number
                    
                    if(!preg_match("/^4[0-9]{12}(?:[0-9]{3})?$/",$_POST['card_number'])){
                        $feedbackCard_number = "Visa";
                    }else if(!preg_match("/(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$ /",$_POST['card_number'])){
                        $feedbackCard_number = "MasterCard";
                    }else if($_POST['card_number'] == ""){
                        $feedbackCard_number = "Introduzca el número de tarjeta";
                        $feedback = "error";
                    }else{
                        $feedbackCard_number = "Tarjeta no válida";
                        $feedback = "error";
                    }

                    //check for empty expiration date
                    if($_POST['expiration_date'] == ""){
                        $feedbackExpiration_date = "Falta la fecha de caducidad";
                        $feedback = "error";
                    }

                    //check for empty cvc 
                    if(!preg_match("/^[0-9]{3}$/",$_POST['card_cvc'])){
                        $feedbacCard_cvc = "Falta el cvc";
                        $feedback = "error";
                    }
                    if($feedback===''){
  
                        $productStock=$productStock-1;
                        //Open connection with the databse
                        $dsn ="mysql:dbname=$basededatos;host=$server";
                        $dbh = new PDO($dsn, $user, $pass);
                        //Prepare the statement
                        $stmt = $dbh -> prepare('UPDATE product SET stock='.$productStock.' WHERE id=?');
                        $stmt -> bindParam(1, $_GET['id']);
                        //execute statement
                        $stmt -> execute();

                        //Prepare the statement
                        $stmt = $dbh -> prepare('UPDATE user SET articles=articles+1 WHERE email=?');
                        $stmt -> bindParam(1, $_SESSION['email']);
                        //execute statement
                        $stmt -> execute();

                        //Prepare the statement
                        $stmt = $dbh -> prepare('UPDATE user SET spent=spent+'.$productPrice.' WHERE email=?');
                        $stmt -> bindParam(1, $_SESSION['email']);
                        //execute statement
                        $stmt -> execute();
                        
                        echo("<h2>div Gracias por su compra </h2>");
                        echo('<div class="form">'.$productName.' adquirido correctamente.');
                    }
                }
                    
            
                echo('<h1>Introduzca el método de pago</h1><br>
                        <div class = "form" id = "form">
                            <form method="POST" id="form">
                                Nombre del titular: 
                                <input type="text" id="credit_card" name="credit_card"><br>
                                <span class="error" id="credit_cardError"><?php echo $feedbackCredit_card;?></span><br>

                                Numero de tarjeta: 
                                <input type="text" id="card_number" name="card_number"><br>
                                <span class="error" id="card_numberError"><?php echo $feedbackCard_number;?></span><br>

                                Fecha de caducidad: 
                                <input type="date" id="expiration_date" name="expiration_date"><br>
                                <span class="error" id="expiration_dateError"><?php echo $feedbackExpiration_date;?></span><br>

                                CVC: 
                                <input type="text" id="card_cvc" name="card_cvc"><br>
                                <span class="error" id="card_cvc" ><?php echo $feedbackCard_cvc;?></span><br>

                                <input type="submit" id="submit" name="submit" value="Comprar"><br>
                            </form>
                            <span class="error"><?php echo $feedback;?></span>
                            <input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>
                            <input type="submit" value="cerrar sesión" onclick="logOut()"> </input>
                        </div>');
            }   
            
            
        ?>
         
    </body>
</html>