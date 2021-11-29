<?php
$local=1; //0 para la nube
if ($local==1){
    $server="localhost";
    $user="root";
    $pass="";
    $basededatos="shop";
}
else{
    $server="localhost:3306";
    $user="G15";
    $pass="ArjGEGmM2TyBK";
    $basededatos="db_G15";
}
?>
