<?php
$local=0; //0 para la nube
if ($local==1){
    $server="localhost";
    $user="root";
    $pass="";
    $basededatos="shop";
}
else{
    $server="localhost:3306";
    $user="id18030521_root";
    $pass="_Bazar202122";
    $basededatos="id18030521_shop";
}
?>
