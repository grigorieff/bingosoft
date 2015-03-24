<?php
require "Login.php";
try {
	// получаем список отчетных периодов системы
	$periods = $client->GetReportingPeriodList();
	
	//print_r ($periods);
	
	$recqty = count($periods);
	
	require_once("../config/config_pdo.php");
	
	$i = 0;
	while ($recqty > 0) {
		$id = $periods[$i]->id;
		$date_start = $periods[$i]->dateStart;
		$date_end = $periods[$i]->dateEnd;
		$name = $periods[$i]->name;
		$state = $periods[$i]->state;
		
		$period_exist = $dbcnx->query("SELECT * FROM ReformaGKH_ReportingPeriodsList WHERE id = $id");
		$period_exist = $period_exist->rowCount();
		
		IF ($period_exist == 0)
		{
			//mysql_query("INSERT INTO ReformaGKH_ReportingPeriodsList VALUES ($id, '$date_start', '$date_end', '$name', $state)");
			$dbcnx->exec("INSERT INTO ReformaGKH_ReportingPeriodsList VALUES ($id, '$date_start', '$date_end', '$name', $state)");
			//echo 'insert';
		}
		ELSE
		{
			//mysql_query("UPDATE ReformaGKH_ReportingPeriodsList SET date_start = '$date_start', date_end = '$date_end', name = '$name', state = $state WHERE id = $id");
			$dbcnx->exec("UPDATE ReformaGKH_ReportingPeriodsList SET date_start = '$date_start', date_end = '$date_end', name = '$name', state = $state WHERE id = $id");
		}
		
		$i++;
		$recqty--;
	}
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
require "Logout.php";
?>