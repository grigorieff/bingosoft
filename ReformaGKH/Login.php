<?php
try {
	// Создание SOAP-клиента по WSDL-документу
	$client = new SoapClient("http://api-beta.reformagkh.ru/api/wsdl");

	// получаем идентификатор сессии
	$guid = $client->Login("", "");

	//echo $guid;
	
	// создаем хэдер
	$header = new SoapHeader('NAMESPACE', 'authenticate', $guid);
	$client->__setSoapHeaders($header);
	
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
?>
