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
    <link rel="stylesheet" href="..\style\error.css">
    <link rel="stylesheet" href="..\style\body.css">
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/buyProduct.js"></script>
</head>

<body>
    <?php
            
        $feedback="";
        $feedbackCompleted="";
        $feedbackCredit_card = "";
        $feedbackCard_number = "";
        $feedbackExpiration_date = "";
        $feedbackCard_cvc= "";
                      


        if(isset($_POST['submit'])){
            //check for empty name
            if(!preg_match("/^[a-zA-Z]+$/",$_POST['credit_card'])){
                $feedbackCredit_card = "Nombre de titular no válido";
                $feedback = "error";
            }

            //check for card number
            
           if($_POST['card_number'] == ""){
                $feedbackCard_number = "Introduzca el número de tarjeta";
                $feedback = "error";
                
            }else if(!preg_match("/^[0-9]{16}?$/",$_POST['card_number'])){
                $feedbackCard_number = "Tarjeta no válida";
                $feedback = "error"; 
            } 

            //check for empty expiration date
            if($_POST['expiration_date'] == ""){
                $feedbackExpiration_date = "Fecha de caducidad no válida";
                $feedback = "error";
            }

            //check for empty cvc 
            if(!preg_match("/^[0-9]{3}?$/",$_POST['card_cvc'])){
                $feedbackCard_cvc = "CVC no válido";
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
                
                echo '<script type="text/javascript">
				window.location.href = "../php/purchaseCompleted.php?product_name='.$productName.'"
				</script>';
                
            }

        }
         
    ?>

    <?php if($productStock>0){
        ?>
    
    <h1>Introduzca el método de pago</h1><br>
    <div class="form" id="form">
        <form method="POST" id="form">
            Nombre del titular:<br>
            <input type="text" id="credit_card" name="credit_card"><br>
            <span class="error" id="credit_cardError"><?php echo $feedbackCredit_card;?></span><br>

            Numero de tarjeta:<br>
            <input type="text" id="card_number" name="card_number"><br>
            <span class="error" id="card_numberError"><?php echo $feedbackCard_number;?></span><br>

            Fecha de caducidad:<br>
            <input type="date" id="expiration_date" name="expiration_date"><br>
            <span class="error" id="expiration_dateError"><?php echo $feedbackExpiration_date;?></span><br>

            CVC:<br>
            <input type="text" id="card_cvc" name="card_cvc"><br>
            <span class="error" id="card_cvcError"><?php echo$feedbackCard_cvc;?></span><br>

            <input type="submit" id="submit" name="submit" value="Comprar"><br>
        </form>
        <?php
        }else{
            echo('<div class="form" id="form">El producto no está disponible.<br> Sentimos las molestias. <br>');
        }
        ?>
        <input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>
        
    </div>


</body>

</html>