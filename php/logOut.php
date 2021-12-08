<?php
    session_start();
    $xml = simplexml_load_file('../xml/users.xml');
	foreach ($xml->children() as $sesion){
		if($sesion-> email == $_SESSION['email']){
			echo "unsetting session";
			unset($sesion);
			break;
		}
	}
	$xml->asXML('../xml/users.xml');

	unset($_SESSION['name']);
    unset($_SESSION['email']);
	
    session_destroy();
    // echo '<script type="text/javascript">
	// 		window.location.href = "../php/viewProductList.php";
	// 		</script>';
?>