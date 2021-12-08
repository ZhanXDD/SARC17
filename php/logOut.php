<?php
    session_start();
    $xml = simplexml_load_file('../xml/users.xml');
	foreach ($xml-> user as $sesion){
		if($sesion-> email == $_SESSION['email']){
			echo "unsetting session";
			$dom=dom_import_simplexml($sesion);
			$dom->parentNode->removeChild($dom);
			break;
		}
	}
	echo $xml->asXML('../xml/users.xml');

	unset($_SESSION['name']);
    unset($_SESSION['email']);
	
    session_destroy();
    echo '<script type="text/javascript">
			window.location.href = "../php/viewProductList.php";
			</script>';
?>