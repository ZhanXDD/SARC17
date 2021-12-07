<?php session_start();?>
<div id='page-wrap'>
<link rel="stylesheet" href="../style/menu.css">
<header class='main' id='h1'>
    <script src="../js/buyProduct.js"></script>
    <span class="left">
        <?php if(isset($_SESSION['name'])){?>
        <a href="../php/viewProductList.php">Produtos</a>
        <a href="../php/addProduct.php">Añadir Produto</a>
        <input type="submit" value="ver Perfil" onclick="goProfile($_SESSION['email'])"> </input>
        <?php }?>
    </span>
    <span class="right">
    <?php
        if(isset($_SESSION['name'])){
    ?>
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