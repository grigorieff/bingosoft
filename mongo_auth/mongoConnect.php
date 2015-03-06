<?php
	$dbhost = 'localhost';
	$dbname = 'reestr'; 
	$dbuser = 'root';
	$dbpasswd = 'qazwsx'; 
	$m = new Mongo("mongodb://$dbuser:$dbpasswd@$dbhost/$dbname");  
	//$db = $m->$dbname;
	//$db = false;
?>