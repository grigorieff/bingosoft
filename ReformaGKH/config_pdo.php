<?php

	$hash_cost_log2 = 8;

	$hash_portable = FALSE;
	
	$dbname = "reestr"; 
	
	$dbuser = "root";
	
	$dbpasswd = "isa32209";
	
	$dblocation = "localhost";

	//$dbcnx = mysql_connect($dblocation, $dbuser, $dbpasswd);
	try {
	  $dbcnx = new PDO("mysql:host=$dblocation;dbname=$dbname", $dbuser, $dbpasswd);
	  $dbcnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $dbcnx->exec("set names utf8");
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	
	if(!$dbcnx)
		exit("<P>В настоящий момент сервер базы данных не 
			  доступен, поэтому корректное отображение 
			  страницы невозможно.</P>" );
	/*
	if(! @mysql_select_db($dbname,$dbcnx))
		exit("<P>В настоящий момент база данных не доступна, 
			  поэтому корректное отображение страницы 
			  невозможно.</P>" );
	*/
	
	$dbcnx->exec("SET character_set_client=utf8"); 
	$dbcnx->exec("SET character_set_connection=utf8"); 
	$dbcnx->exec("SET character_set_database=utf8"); 
	$dbcnx->exec("SET character_set_results=utf8"); 
	$dbcnx->exec("SET character_set_server=utf8"); 
	$dbcnx->exec("SET group_concat_max_len=4096"); 
	//$dbcnx->exec("SET NAMES 'utf8'");	

	if(!function_exists('get_magic_quotes_gpc')){
		function get_magic_quotes_gpc(){
		  return false;
		}
	}
?>