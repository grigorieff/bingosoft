<?php
require "Login.php";

$region_id = 'db9c4f8b-b706-40e2-b2b4-d31b98dcd3d1'; // GUID региона из ФИАС
$page_number = 1; // номер страницы
$reporting_period_id = 8; // id отчетного периода

try {
	// получаем анкеты управляющих организаций
	$companyprofile = $client->GetCompanyProfileSF($region_id, $page_number, $reporting_period_id);
	
	//$companyprofile->total = 100;
	
	//$companyprofile->success = true;
	
	//$companyprofile->items = $companyprofile->data;
	
	//unset($companyprofile->data);
	
	//$xml = simplexml_load_string($companyprofile);
	//echo json_encode($companyprofile);
	//echo $json;
	
	require_once("../config/config_pdo.php");
	
	//print_r ($companyprofile->data[$i]);
	
	function GetStringAddress($city_id, $street_id, $house_number, $building, $block, $room_number)
	{
		return 'Address';
		//сделать
	}
	
	$recqty = count($companyprofile->data);
	$i = 0;
	
	while ($recqty > 0) 
	{
		$inn = $companyprofile->data[$i]->inn;
		$name_full = $companyprofile->data[$i]->company_profile_data->name_full;
		$name_short = $companyprofile->data[$i]->company_profile_data->name_short;
		$okopf = $companyprofile->data[$i]->company_profile_data->okopf;
		$surname = $companyprofile->data[$i]->company_profile_data->surname;
		$firstname = $companyprofile->data[$i]->company_profile_data->firstname;
		$middlename = $companyprofile->data[$i]->company_profile_data->middlename;
		$position = $companyprofile->data[$i]->company_profile_data->position;
		$ogrn = $companyprofile->data[$i]->company_profile_data->ogrn;
		
		$legal_city_id = $companyprofile->data[$i]->company_profile_data->legal_address->city_id;
		$legal_street_id = $companyprofile->data[$i]->company_profile_data->legal_address->street_id;
		$legal_house_number = $companyprofile->data[$i]->company_profile_data->legal_address->house_number;
		$legal_building = $companyprofile->data[$i]->company_profile_data->legal_address->building;
		$legal_block = $companyprofile->data[$i]->company_profile_data->legal_address->block;
		$legal_room_number = $companyprofile->data[$i]->company_profile_data->legal_address->room_number;
		
		$actual_city_id = $companyprofile->data[$i]->company_profile_data->actual_address->city_id;
		$actual_street_id = $companyprofile->data[$i]->company_profile_data->actual_address->street_id;
		$actual_house_number = $companyprofile->data[$i]->company_profile_data->actual_address->house_number;
		$actual_building = $companyprofile->data[$i]->company_profile_data->actual_address->building;
		$actual_block = $companyprofile->data[$i]->company_profile_data->actual_address->block;
		$actual_room_number = $companyprofile->data[$i]->company_profile_data->actual_address->room_number;
		
		$post_city_id = $companyprofile->data[$i]->company_profile_data->post_address->city_id;
		$post_street_id = $companyprofile->data[$i]->company_profile_data->post_address->street_id;
		$post_house_number = $companyprofile->data[$i]->company_profile_data->post_address->house_number;
		$post_building = $companyprofile->data[$i]->company_profile_data->post_address->building;
		$post_block = $companyprofile->data[$i]->company_profile_data->post_address->block;
		$post_room_number = $companyprofile->data[$i]->company_profile_data->post_address->room_number;
		
		$phone = $companyprofile->data[$i]->company_profile_data->phone;
		$email = $companyprofile->data[$i]->company_profile_data->email;
		$site = $companyprofile->data[$i]->company_profile_data->site;
		$work_time = $companyprofile->data[$i]->company_profile_data->work_time;
		$participation_in_associations = $companyprofile->data[$i]->company_profile_data->participation_in_associations;
		$srf_count = $companyprofile->data[$i]->company_profile_data->srf_count;
		$mo_count = $companyprofile->data[$i]->company_profile_data->mo_count;
		$offices_count = $companyprofile->data[$i]->company_profile_data->offices_count;
		$staff_regular_administrative = $companyprofile->data[$i]->company_profile_data->staff_regular_administrative;
		$staff_regular_engineers = $companyprofile->data[$i]->company_profile_data->staff_regular_engineers;
		$staff_regular_labor = $companyprofile->data[$i]->company_profile_data->staff_regular_labor;
		$staff_regular_total = $companyprofile->data[$i]->company_profile_data->staff_regular_total;
		$residents_count = $companyprofile->data[$i]->company_profile_data->residents_count;
		$serviced_by_competition_report_date = $companyprofile->data[$i]->company_profile_data->serviced_by_competition_report_date;
		$serviced_by_owner_uo_report_date = $companyprofile->data[$i]->company_profile_data->serviced_by_owner_uo_report_date;
		$serviced_by_tsg_report_date = $companyprofile->data[$i]->company_profile_data->serviced_by_tsg_report_date;
		$serviced_by_tsg_uo_report_date = $companyprofile->data[$i]->company_profile_data->serviced_by_tsg_uo_report_date;
		$count_houses_under_mng_report_date = $companyprofile->data[$i]->company_profile_data->count_houses_under_mng_report_date;
		$sum_sq_houses_under_mng_report_date = $companyprofile->data[$i]->company_profile_data->sum_sq_houses_under_mng_report_date;
		$last_update = $companyprofile->data[$i]->company_profile_data->last_update;
		
		settype($srf_count, "integer");
		settype($mo_count, "integer");
		settype($offices_count, "integer");
		settype($staff_regular_administrative, "integer");
		settype($staff_regular_engineers, "integer");
		settype($staff_regular_labor, "integer");
		settype($staff_regular_total, "integer");
		settype($residents_count, "integer");
		settype($serviced_by_competition_report_date, "integer");
		settype($serviced_by_owner_uo_report_date, "integer");
		settype($serviced_by_tsg_report_date, "integer");
		settype($serviced_by_tsg_uo_report_date, "integer");
		settype($count_houses_under_mng_report_date, "integer");
		settype($sum_sq_houses_under_mng_report_date, "integer");
		
		$company_exist = $dbcnx->query("SELECT * FROM object_70969_ WHERE id_obj = 71432 AND attr_71160_ = $inn");
		$company_exist = $company_exist->rowCount();
		
		$jur_address = GetStringAddress($legal_city_id, $legal_street_id, $legal_house_number, $legal_building, $legal_block, $legal_room_number);
		$fact_address = GetStringAddress($actual_city_id, $actual_street_id, $actual_house_number, $actual_building, $actual_block, $actual_room_number);
		$post_address = GetStringAddress($post_city_id, $post_street_id, $post_house_number, $post_building, $post_block, $post_room_number);
		
		IF ($company_exist == 0)
			{	
				//echo 'insert';
				$sql = "INSERT INTO object_70969_(id_obj, attr_71160_, attr_71981_, attr_70970_, attr_71992_, attr_71368_, attr_73031_, attr_72000_,
				attr_71384_, attr_71386_, attr_71385_, attr_71387_, attr_76490_, attr_76491_, attr_76492_, attr_76493_, attr_76494_, attr_76495_, attr_76497_, attr_76498_, attr_76500_, attr_76501_,
				attr_76502_, attr_76503_, attr_76504_, attr_76505_, attr_76506_, attr_76482_, attr_71383_, attr_71382_) 
												VALUES (71432, $inn, '$name_full', '$name_short', replace('$okopf', ' ', ''), CONCAT('$surname', ' ', '$firstname', ' ', '$middlename'), '$position', $ogrn,
												'$phone', '$email', '$site', '$work_time', '$participation_in_associations', $srf_count, $mo_count, $offices_count, $staff_regular_administrative, 
												$staff_regular_engineers, $staff_regular_labor, $staff_regular_total, $residents_count, $serviced_by_competition_report_date, $serviced_by_owner_uo_report_date, 
												$serviced_by_tsg_report_date, $serviced_by_tsg_uo_report_date, $count_houses_under_mng_report_date, $sum_sq_houses_under_mng_report_date, '$jur_address', '$fact_address', '$post_address')";
			}
		ELSE
			{
				//echo 'update';
				$sql = "UPDATE object_70969_ 
				SET attr_71981_ = '$name_full', attr_70970_ = '$name_short', attr_71992_ = replace('$okopf', ' ', ''), attr_71368_ = CONCAT('$surname', ' ', '$firstname', ' ', '$middlename'), attr_73031_ = '$position',
				attr_72000_ = $ogrn, attr_71384_ = '$phone', attr_71386_ = '$email', attr_71385_ = '$site', attr_71387_ = '$work_time', attr_76490_ = '$participation_in_associations',
				attr_76491_ = $srf_count, attr_76492_ = $mo_count, attr_76493_ = $offices_count, attr_76494_ = $staff_regular_administrative, attr_76495_ = $staff_regular_engineers,
				attr_76497_ = $staff_regular_labor, attr_76498_ = $staff_regular_total, attr_76500_ = $residents_count, attr_76501_ = $serviced_by_competition_report_date, attr_76502_ = $serviced_by_owner_uo_report_date,
				attr_76503_ = $serviced_by_tsg_report_date, attr_76504_ = $serviced_by_tsg_uo_report_date, attr_76505_ = $count_houses_under_mng_report_date, attr_76506_ = $sum_sq_houses_under_mng_report_date, 
				attr_76482_ = '$jur_address', attr_71383_ = '$fact_address', attr_71382_ = '$post_address'
				WHERE attr_71160_ = $inn";
			}
		
		$dbcnx->exec($sql);
		
		$i++;
		$recqty--;
	}
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
require "Logout.php";
?>