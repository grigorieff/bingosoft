<?php
#require "Login.php";
try {
	// закрываем сессию
	$result = $client->Logout();

	//echo $result;
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
?>