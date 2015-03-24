<?php
require "Login.php";

//$region_id = 'db9c4f8b-b706-40e2-b2b4-d31b98dcd3d1'; // GUID региона из ФИАС
$region_id = 'd66e5325-3a25-4d29-ba86-4ca351d9704b';
//$page_number = 1; // номер страницы
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
	
	//print_r ($companyprofile);
	
	/*
	function GetStringAddress($city_id, $street_id, $house_number, $building, $block, $room_number)
	{	
		global $dbcnx;
		
		$sth = $dbcnx->prepare('SELECT attr_71339_, attr_71338_ FROM object_71337_ WHERE attr_76516_ = :city_id and if_hist = 0');
		$sth->bindParam(':city_id', $city_id);
		$sth->execute();
		$city = $sth->fetch(PDO::FETCH_ASSOC);
		$city_sokr = $city[attr_71339_];
		$city_name = $city[attr_71338_];
		
		$sth = $dbcnx->prepare('SELECT attr_71349_, attr_71348_ FROM object_71347_ WHERE attr_76517_ = :street_id and if_hist = 0');
		$sth->bindParam(':street_id', $street_id);
		$sth->execute();
		$street = $sth->fetch(PDO::FETCH_ASSOC);
		$street_sokr = $street[attr_71349_];
		$street_name = $street[attr_71348_];
		
		if (!empty($city_sokr)) {
			$city_sokr = $city_sokr.'. ';
		}
		
		$city = $city_sokr.$city_name;
		
		if (!empty($street_sokr)) {
			$street_sokr = ', '.$street_sokr.'. ';
		}
		
		$street = $street_sokr.$street_name;
		
		if (!empty($building)) {
			$building = ', д. '.$building;
		}
		
		if (!empty($block)) {
			$block = ', корп. '.$block;
		}
		
		if (!empty($room_number)) {
			$room_number = ', кв. '.$room_number;
		}
		
		return $city.$street.$building.$block.$room_number;
	}
	*/
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
		
		$company_exist = $dbcnx->query("SELECT * FROM object_70969_ WHERE id_obj = 71432 AND attr_71160_ = $inn and if_hist = 0");
		$company_exist = $company_exist->rowCount();
		
		$jur_address = GetStringAddress($legal_city_id, $legal_street_id, $legal_house_number, $legal_building, $legal_block, $legal_room_number);
		$fact_address = GetStringAddress($actual_city_id, $actual_street_id, $actual_house_number, $actual_building, $actual_block, $actual_room_number);
		$post_address = GetStringAddress($post_city_id, $post_street_id, $post_house_number, $post_building, $post_block, $post_room_number);
		
		$okopf = str_replace(' ', '', $okopf);
		$contact_name = $surname.' '.$firstname.' '.$middlename;
		
		$sth = $dbcnx->prepare('SELECT attr_71353_, attr_71355_, id FROM object_71347_ WHERE attr_76517_ = :street_id and if_hist = 0');
		$sth->bindParam(':street_id', $legal_street_id);
		$sth->execute();
		$jur_address_struct = $sth->fetch(PDO::FETCH_ASSOC);
		$jur_area = $jur_address_struct[attr_71353_];
		$jur_city = $jur_address_struct[attr_71355_];
		$jur_street = $jur_address_struct[id];
		
		$sth->bindParam(':street_id', $actual_street_id);
		$sth->execute();
		$fact_address_struct = $sth->fetch(PDO::FETCH_ASSOC);
		$fact_area = $fact_address_struct[attr_71353_];
		$fact_city = $fact_address_struct[attr_71355_];
		$fact_street = $fact_address_struct[id];
		
		$sth->bindParam(':street_id', $post_street_id);
		$sth->execute();
		$post_address_struct = $sth->fetch(PDO::FETCH_ASSOC);
		$post_area = $post_address_struct[attr_71353_];
		$post_city = $post_address_struct[attr_71355_];
		$post_street = $post_address_struct[id];
		
		settype($jur_area, "integer");
		settype($jur_city, "integer");
		settype($jur_street, "integer");
		settype($fact_area, "integer");
		settype($fact_city, "integer");
		settype($fact_street, "integer");
		settype($post_area, "integer");
		settype($post_city, "integer");
		settype($post_street, "integer");
		
		IF ($company_exist == 0)
			{	
				//echo 'insert';
				$data = array(71432, $inn, $name_full, $name_short, $okopf, $contact_name, $position, $ogrn,
				$phone, $email, $site, $work_time, $participation_in_associations, $srf_count, $mo_count, $offices_count, $staff_regular_administrative, 
				$staff_regular_engineers, $staff_regular_labor, $staff_regular_total, $residents_count, $serviced_by_competition_report_date, $serviced_by_owner_uo_report_date, 
				$serviced_by_tsg_report_date, $serviced_by_tsg_uo_report_date, $count_houses_under_mng_report_date, $sum_sq_houses_under_mng_report_date, $last_update, $jur_address, $fact_address, $post_address,
				$jur_area, $jur_city, $jur_street, $legal_house_number, $legal_building, $legal_block, $legal_room_number,
				$post_area, $post_city, $post_street, $post_house_number, $post_building, $post_block, $post_room_number,
				$fact_area, $fact_city, $fact_street, $actual_house_number, $actual_building, $actual_block, $actual_room_number);
				
				$sth = $dbcnx->prepare("
			INSERT INTO object_70969_(id_obj, attr_71160_, attr_71981_, attr_70970_, attr_71992_, attr_71368_, attr_73031_, attr_72000_,
				attr_71384_, attr_71386_, attr_71385_, attr_71387_, attr_76490_, attr_76491_, attr_76492_, attr_76493_, attr_76494_, attr_76495_, attr_76497_, attr_76498_, attr_76500_, attr_76501_,
				attr_76502_, attr_76503_, attr_76504_, attr_76505_, attr_76506_, attr_76507_, attr_76482_, attr_71383_, attr_71382_,
				attr_78384_, attr_78391_, attr_78398_, attr_78405_, attr_78412_, attr_78419_, attr_78426_,
				attr_78440_, attr_78447_, attr_78454_, attr_78461_, attr_78468_, attr_78475_, attr_78482_,
				attr_78496_, attr_78503_, attr_78510_, attr_78517_, attr_78524_, attr_78531_, attr_78538_) 
			values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?,
				?, ?, ?, ?, ?, ?, ?)");  
			$sth->execute($data);
			}
		/*
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
		*/
		//$dbcnx->exec($sql);
		
		$i++;
		$recqty--;
	}
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
require "Logout.php";
?>