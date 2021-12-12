<?php include "./menu.php"?>

<html>
    <head>
    <link rel="stylesheet" href="../style/body.css">
    <script src="../js/buyProduct.js"></script>
        <title>Compra completada</title>
    </head>
    <body>
        <h1>Gracias por su compra</h1>
        <?php echo('<div class="form">El producto:'.$_GET['product_name'].' ha sido adquirido correctamente.</div>');?>
        <input type="submit" value="volver a la tienda" onclick="goProductList()"> </input>
        
    </body>
</html>