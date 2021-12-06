<?php
    session_start();
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    unset($_SESSION['buy']);

    $xml = simplexml_load_file('../xml/users.xml');
	foreach ($xml->children() as $sesion){
		if($sesion['name'] == $_SESSION['name']){
			unset($xml->sesion);
			break;
		}
	}
	$xml->asXML('../xml/users.xml');
    session_destroy();
    header("Location: ./viewProductList.php");
?>