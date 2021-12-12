<?php session_start();?>
<div id='page-wrap'>
<link rel="stylesheet" href="../style/menu.css">
<script src="../js/CountUsers.js"></script>
<header class='main' id='h1'>
    <span class="left">
        <a href="../php/inicio.php">Inicio</a>
        <?php if(isset($_SESSION['name'])){ ?>
        <a href="../php/viewProductList.php">Produtos</a>
        <a href="../php/addProduct.php">Añadir Produto</a>
        <?php } ?>
    </span>
    <span class="right">
        <span id="userCounter"></span>
    <?php
        if(isset($_SESSION['name'])){
    ?>
        <a href="../php/profile.php?email=<?php echo $_SESSION['email']?>">Ver perfil</a>
        <a href="../php/logOut.php">Cerrar Sesion</a>
    <?php    
        }else{
    ?>
        <a href="../php/register.php">Registrarse</a>
        <a href="../php/logIn.php">Iniciar Sesion</a>
    <?php
        }
    ?>
    </span>
</header>
</div> 