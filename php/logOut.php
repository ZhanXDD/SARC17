<?php
    session_start();
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    
    $xml = simplexml_load_file('../xml/users.xml');
	foreach ($xml->children() as $sesion){
		if($sesion['name'] == $_SESSION['name']){
			unset($xml->sesion);
			break;
		}
	}
	$xml->asXML('../xml/users.xml');
    session_destroy();
    echo '<script type="text/javascript">
			window.location.href = "../php/viewProductList.php";
			</script>';
?>