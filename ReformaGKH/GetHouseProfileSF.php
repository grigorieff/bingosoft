<?php
require "Login.php";

//$region_id = 'db9c4f8b-b706-40e2-b2b4-d31b98dcd3d1'; // GUID региона из ФИАС
$region_id = 'd66e5325-3a25-4d29-ba86-4ca351d9704b';
//$page_number = 1; // номер страницы
/*
		function GetRegion_id($region_guid)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_71317_ WHERE attr_76514_ = :region_guid and if_hist = 0');
			$sth->bindParam(':region_guid', $region_guid);
			$sth->execute();
			$region_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $region_id;
		}
		
		function GetArea_id($area_guid)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_71322_ WHERE attr_76515_ = :area_guid and if_hist = 0');
			$sth->bindParam(':area_guid', $area_guid);
			$sth->execute();
			$area_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $area_id;
		}
		
		function GetCity1_id($city1_guid)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_71337_ WHERE attr_76516_ = :city1_guid and if_hist = 0');
			$sth->bindParam(':city1_guid', $city1_guid);
			$sth->execute();
			$city1_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $city1_id;
		}
		
		function GetCity2_id($city2_guid)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_71337_ WHERE attr_76516_ = :city2_guid and if_hist = 0');
			$sth->bindParam(':city2_guid', $city2_guid);
			$sth->execute();
			$city2_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $city2_id;
		}
		
		function GetStreet_id($street_guid)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_71347_ WHERE attr_76517_ = :street_guid and if_hist = 0');
			$sth->bindParam(':street_guid', $street_guid);
			$sth->execute();
			$street_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $street_id;
		}
		
		function GetCompany_id($inn) //получаем id контрагента по инн
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_70969_ WHERE attr_71160_ = :inn and if_hist = 0');
			$sth->bindParam(':inn', $inn);
			$sth->execute();
			$company_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $company_id;
		}
		
		// функции получения id систем по идентификатору с Реформы
		function GetHouseType_id($house_type)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_76750_ WHERE attr_78545_ = :house_type and if_hist = 0');
			$sth->bindParam(':house_type', $house_type);
			$sth->execute();
			$house_type_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $house_type_id;
		}
		
		function GetFloorType_id($floor_type)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_76765_ WHERE attr_78546_ = :floor_type and if_hist = 0');
			$sth->bindParam(':floor_type', $floor_type);
			$sth->execute();
			$floor_type_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $floor_type_id;
		}
		
		function GetState_id($state)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_73919_ WHERE attr_78547_ = :state and if_hist = 0');
			$sth->bindParam(':state', $state);
			$sth->execute();
			$state_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $state_id;
		}
		
		function GetBasementStage_id($basement_stage)
		{
			global $dbcnx;
			
			$sth = $dbcnx->prepare('SELECT id FROM object_70845_ WHERE attr_78548_ = :basement_stage and if_hist = 0');
			$sth->bindParam(':basement_stage', $basement_stage);
			$sth->execute();
			$basement_stage_id = $sth->fetchAll(PDO::FETCH_ASSOC)[0][id];
				
			return $basement_stage_id;
		}
	*/
	//while ($page_number < 51)
	//{
	try {
	// получаем анкеты управляющих организаций
	$houseprofile = $client->GetHouseProfileSF($region_id, $page_number);
	
	//print_r ($houseprofile);
	
	require_once("../config/config_pdo.php");
	
	$recqty = count($houseprofile->data);
	$i = 0;
	
	while ($recqty > 0)
	{
		$inn = $houseprofile->data[$i]->inn;
		$house_id = $houseprofile->data[$i]->house_id;
		
		$region_guid = $houseprofile->data[$i]->full_address->region_guid;
		$area_guid = $houseprofile->data[$i]->full_address->area_guid;
		$city1_guid = $houseprofile->data[$i]->full_address->city1_guid;
		$city2_guid = $houseprofile->data[$i]->full_address->city2_guid;
		$street_guid = $houseprofile->data[$i]->full_address->street_guid;
		$house_number = $houseprofile->data[$i]->full_address->house_number;
		$block = $houseprofile->data[$i]->full_address->block;
		$building = $houseprofile->data[$i]->full_address->building;
		
		$area_short_name = $houseprofile->data[$i]->full_address->area_short_name;
		$area_formal_name = $houseprofile->data[$i]->full_address->area_formal_name;
		$city1_short_name = $houseprofile->data[$i]->full_address->city1_short_name;
		$city1_formal_name = $houseprofile->data[$i]->full_address->city1_formal_name;
		$street_short_name = $houseprofile->data[$i]->full_address->street_short_name;
		$street_formal_name = $houseprofile->data[$i]->full_address->street_formal_name;
		
		IF (strlen($area_formal_name) > 0) 
		{
			$address = $area_short_name.' '.$area_formal_name.', '.$city1_short_name.'. '.$city1_formal_name.', '.$street_short_name.'. '.$street_formal_name.', д. '.$house_number;
		}
		ELSE
		{
			$address = $city1_short_name.'. '.$city1_formal_name.', '.$street_short_name.'. '.$street_formal_name.', д. '.$house_number;
		}
		
		$region_id = GetRegion_id($region_guid);
		$area_id = GetArea_id($area_guid);
		$city1_id = GetCity1_id($city1_guid);
		$city2_id = GetCity2_id($city2_guid);
		$street_id = GetStreet_id($street_guid);
		$company_id = GetCompany_id($inn);
		
		//echo $city1_id;
		
		$location_description = $houseprofile->data[$i]->house_profile_data->location_description;
		$exploitation_start_year = $houseprofile->data[$i]->house_profile_data->exploitation_start_year;
		$area_total = $houseprofile->data[$i]->house_profile_data->area_total;
		$inventory_number = $houseprofile->data[$i]->house_profile_data->inventory_number;
		$cadastral_number = $houseprofile->data[$i]->house_profile_data->cadastral_number;
		$area_land = $houseprofile->data[$i]->house_profile_data->area_land;
		$area_territory = $houseprofile->data[$i]->house_profile_data->area_territory;
		$project_type = $houseprofile->data[$i]->house_profile_data->project_type;
		$house_type = $houseprofile->data[$i]->house_profile_data->house_type;
		$flats_count = $houseprofile->data[$i]->house_profile_data->flats_count;
		$residents_count = $houseprofile->data[$i]->house_profile_data->residents_count;
		$accounts_count = $houseprofile->data[$i]->house_profile_data->accounts_count;
		$area_residential = $houseprofile->data[$i]->house_profile_data->area_residential;
		$area_non_residential = $houseprofile->data[$i]->house_profile_data->area_non_residential;
		$storeys_count = $houseprofile->data[$i]->house_profile_data->storeys_count;
		$entrance_count = $houseprofile->data[$i]->house_profile_data->entrance_count;
		$floor_type = $houseprofile->data[$i]->house_profile_data->floor_type;
		$construction_features = $houseprofile->data[$i]->house_profile_data->construction_features;
		$deterioration_total = $houseprofile->data[$i]->house_profile_data->deterioration_total;
		$deterioration_foundation = $houseprofile->data[$i]->house_profile_data->deterioration_foundation;
		$deterioration_bearing_walls = $houseprofile->data[$i]->house_profile_data->deterioration_bearing_walls;
		$deterioration_floor = $houseprofile->data[$i]->house_profile_data->deterioration_floor;
		$state = $houseprofile->data[$i]->house_profile_data->state;
		$emergency_date = $houseprofile->data[$i]->house_profile_data->emergency_date;
		$emergency_number = $houseprofile->data[$i]->house_profile_data->emergency_number;
		$emergency_reason = $houseprofile->data[$i]->house_profile_data->emergency_reason;
		$basement_stage = $houseprofile->data[$i]->house_profile_data->basement->basement_stage;
		$basement_area = $houseprofile->data[$i]->house_profile_data->basement->basement_area;
		$common_space_area = $houseprofile->data[$i]->house_profile_data->common_space->common_space_area;
		$common_space_overhaul_date = $houseprofile->data[$i]->house_profile_data->common_space->common_space_overhaul_date;
		$chute_count = $houseprofile->data[$i]->house_profile_data->chute->chute_count;
		$chute_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->chute->chute_last_overhaul_date;
		$privatization_start_date = $houseprofile->data[$i]->house_profile_data->privatization_start_date;
		$elevators_count = $houseprofile->data[$i]->house_profile_data->elevators_count;
		
		//echo $area_residential;
		
		//communication types (получаем id-ник с реформы)
		$heating_system_name = $houseprofile->data[$i]->house_profile_data->heating_system->system_name;
		$hot_water_system_name = $houseprofile->data[$i]->house_profile_data->hot_water_system->system_name;
		$cold_water_system_name = $houseprofile->data[$i]->house_profile_data->cold_water_system->system_name;
		$sewerage_system_name = $houseprofile->data[$i]->house_profile_data->sewerage_system->system_name;
		$gas_system_name = $houseprofile->data[$i]->house_profile_data->gas_system->system_name;
		
		//наши id
		$house_type_id = GetHouseType_id($house_type);
		$floor_type_id = GetFloorType_id($floor_type);
		$state_id = GetState_id($state);
		$basement_stage_id = GetBasementStage_id($basement_stage);
		/*
		// кол-во приборов учета
		$heating_system_metering_devices_count = $houseprofile->data[$i]->house_profile_data->heating_system->metering_devices_count;
		$hot_water_system_metering_devices_count = $houseprofile->data[$i]->house_profile_data->hot_water_system->metering_devices_count;
		$cold_water_system_metering_devices_count = $houseprofile->data[$i]->house_profile_data->cold_water_system->metering_devices_count;
		$electricity_system_metering_devices_count = $houseprofile->data[$i]->house_profile_data->electricity_system->metering_devices_count;
		$gas_system_metering_devices_count = $houseprofile->data[$i]->house_profile_data->gas_system->metering_devices_count;
		
		// преобразуем к виду есть/нет
		if ($heating_system_metering_devices_count > 0) {$heating_system_metering_devices_count = 1;}
		if ($hot_water_system_metering_devices_count > 0) {$hot_water_system_metering_devices_count = 1;}
		if ($cold_water_system_metering_devices_count > 0) {$cold_water_system_metering_devices_count = 1;}
		if ($electricity_system_metering_devices_count > 0) {$electricity_system_metering_devices_count = 1;}
		if ($gas_system_metering_devices_count > 0) {$gas_system_metering_devices_count = 1;}
		*/
		//years
		$facade_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->facade->last_overhaul_date;
		//$roof_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->roof->last_overhaul_date;
		$basement_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->basement->basement_last_overhaul_date;
		/*$lift_date_last_repair = $houseprofile->data[$i]->house_profile_data->lifts->date_last_repair;
		$electricity_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->electricity_system->last_overhaul_date;
		$heating_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->heating_system->last_overhaul_date;
		$cold_water_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->cold_water_system->last_overhaul_date;
		$hot_water_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->hot_water_system->last_overhaul_date;
		$sewerage_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->sewerage_system->last_overhaul_date;
		$gas_system_last_overhaul_date = $houseprofile->data[$i]->house_profile_data->gas_system->last_overhaul_date;
		*/
		$sth = $dbcnx->prepare('SELECT * FROM object_70912_ WHERE attr_76745_ = :house_id and if_hist = 0');
		$sth->bindParam(':house_id', $house_id);
		$sth->execute();
		$house_exist = $sth->rowCount();
		//echo $house_exist;
		
		if (!isset($company_id)) {
			$company_id = 0;
		}
		
		if (!isset($region_id)) {
			$region_id = 0;
		}
		
		if (!isset($area_id)) {
			$area_id = 0;
		}
		
		if (!isset($city1_id)) {
			$city1_id = 0;
		}
		
		if (!isset($city2_id)) {
			$city2_id = 0;
		}
		
		if (!isset($street_id)) {
			$street_id = 0;
		}
		
		if (!isset($storeys_count)) {
			$storeys_count = 0;
		}
		
		if (!isset($entrance_count)) {
			$entrance_count = 0;
		}
		
		if (!isset($residents_count)) {
			$residents_count = 0;
		}
		
		if (!isset($heating_system_id)) {
			$heating_system_id = 0;
		}
		
		if (!isset($hot_water_system_id)) {
			$hot_water_system_id = 0;
		}
		
		if (!isset($cold_water_system_id)) {
			$cold_water_system_id = 0;
		}
		
		if (!isset($gas_system_id)) {
			$gas_system_id = 0;
		}
		
		if (!isset($sewerage_system_id)) {
			$sewerage_system_id = 0;
		}
		
		if (!isset($elevators_count)) {
			$elevators_count = 0;
		}
		
		if (!isset($deterioration_total)) {
			$deterioration_total = 0;
		}
		
		if (!isset($deterioration_bearing_walls)) {
			$deterioration_bearing_walls = 0;
		}
		
		if (!isset($deterioration_floor)) {
			$deterioration_floor = 0;
		}
		
		if (!isset($deterioration_foundation)) {
			$deterioration_foundation = 0;
		}
		
		if (!isset($area_residential)) {
			$area_residential = 0;
		}
		
		if (!isset($area_non_residential)) {
			$area_non_residential = 0;
		}
		
		if (!isset($area_land)) {
			$area_land = 0;
		}
		
		if (!isset($area_territory)) {
			$area_territory = 0;
		}
		
		if (!isset($area_total)) {
			$area_total = 0;
		}
		
		if (!isset($flats_count)) {
			$flats_count = 0;
		}
		
		if (!isset($accounts_count)) {
			$accounts_count = 0;
		}
		
		if (!isset($basement_area)) {
			$basement_area = 0;
		}
		
		if (!isset($common_space_area)) {
			$common_space_area = 0;
		}
		
		if (!isset($chute_count)) {
			$chute_count = 0;
		}
		
		if (!isset($house_type_id)) {
			$house_type_id = 0;
		}
		
		if (!isset($floor_type_id)) {
			$floor_type_id = 0;
		}
		
		if (!isset($state_id)) {
			$state_id = 0;
		}
		
		if (!isset($basement_stage_id)) {
			$basement_stage_id = 0;
		}
		/*
		//убираем нечисловые символы из полей с годом
		$facade_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $facade_last_overhaul_date), -4);
		if ($facade_last_overhaul_date == '') {unset($facade_last_overhaul_date);}
		
		$roof_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $roof_last_overhaul_date), -4);
		if ($roof_last_overhaul_date == '') {unset($roof_last_overhaul_date);}
		
		$basement_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $basement_last_overhaul_date), -4);
		if ($basement_last_overhaul_date == '') {unset($basement_last_overhaul_date);}
		
		$lift_date_last_repair = substr(preg_replace('/[^0-9]/', '', $lift_date_last_repair), -4);
		if ($lift_date_last_repair == '') {unset($lift_date_last_repair);}
		
		$electricity_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $electricity_system_last_overhaul_date), -4);
		if ($electricity_system_last_overhaul_date == '') {unset($electricity_system_last_overhaul_date);}
		
		$heating_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $heating_system_last_overhaul_date), -4);
		if ($heating_system_last_overhaul_date == '') {unset($heating_system_last_overhaul_date);}
		
		$cold_water_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $cold_water_system_last_overhaul_date), -4);
		if ($cold_water_system_last_overhaul_date == '') {unset($cold_water_system_last_overhaul_date);}
		
		$hot_water_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $hot_water_system_last_overhaul_date), -4);
		if ($hot_water_system_last_overhaul_date == '') {unset($hot_water_system_last_overhaul_date);}
		
		$sewerage_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $sewerage_system_last_overhaul_date), -4);
		if ($sewerage_system_last_overhaul_date == '') {unset($sewerage_system_last_overhaul_date);}
		
		$gas_system_last_overhaul_date = substr(preg_replace('/[^0-9]/', '', $gas_system_last_overhaul_date), -4);
		if ($gas_system_last_overhaul_date == '') {unset($gas_system_last_overhaul_date);}
		*/
		$exploitation_start_year = substr(preg_replace('/[^0-9]/', '', $exploitation_start_year), -4);
		if ($exploitation_start_year == '') {unset($exploitation_start_year);}
		if ($area_total == '') {unset($area_total);}
		
		if (strlen($emergency_date) < 6) {unset($emergency_date);}
				
		//print_r($data);
		
		//echo $city1_id;
		//echo $city1_guid;
		//echo $area_residential;
		echo $emergency_date;
		
		IF ($house_exist == 0)
			{	
				$data = array(70912, $house_id, $area_id, $company_id, $address, 
						$area_id, $city1_id, $city2_id, $street_id, $house_number, $block, $building, $location_description,
						$exploitation_start_year, $area_total, $area_residential, $area_non_residential, $storeys_count, $entrance_count, $residents_count, $privatization_start_date,
						$inventory_number, $cadastral_number, $area_land, $area_territory, $project_type, $flats_count, $accounts_count, $construction_features,
						$deterioration_total, $deterioration_foundation, $deterioration_bearing_walls, $deterioration_floor,
						$emergency_date, $emergency_document_number, $emergency_reason, $basement_area, $common_space_area, $chute_count, 
						$facade_last_overhaul_date, $basement_last_overhaul_date, $chute_last_overhaul_date,
						$house_type_id, $floor_type_id, $state_id, $basement_stage_id
						);
						
				$sth = $dbcnx->prepare("
			INSERT INTO object_70912_(id_obj, attr_76745_, attr_73924_, attr_71498_, attr_70913_,
			attr_70952_, attr_70953_, attr_76746_, attr_70954_, attr_70955_, attr_72367_, attr_76453_, attr_76747_,
			attr_70958_, attr_70959_, attr_72370_, attr_73934_, attr_70964_, attr_72047_, attr_76762_, attr_73929_,
			attr_73918_, attr_73925_, attr_76748_, attr_70965_, attr_76749_, attr_72049_, attr_76763_, attr_76777_, 
			attr_72046_, attr_76779_, attr_76780_, attr_76781_,
			attr_74016_, attr_74015_, attr_76782_, attr_76783_, attr_76787_, attr_76789_,
			attr_76785_, attr_76786_, attr_76790_, 
			attr_76761_, attr_76776_, attr_73923_, attr_70962_
			)
			values (?, ?, ?, ?, ?,
			?, ?, ?, ?, ?, ?, ?, ?,
			?, ?, ?, ?, ?, ?, ?, ?,
			?, ?, ?, ?, ?, ?, ?, ?,
			?, ?, ?, ?,
			?, ?, ?, ?, ?, ?,
			?, ?, ?,
			?, ?, ?, ?
			)");  
			
			//echo 'insert';
			$sth->execute($data);
			}
		/*ELSE
			{
				$data = array($area_id, $company_id, $address, 
						$area_id, $city1_id, $city2_id, $street_id, $house_number, $block, $building,
						$house_id);
						
				$sth = $dbcnx->prepare("UPDATE object_78810_ 
										SET attr_78836_ = ?, attr_78825_ = ?, attr_78826_ = ?,
										attr_78824_ = ?, attr_78827_ = ?, attr_78828_ = ?, attr_78829_ = ?, attr_78830_ = ?, attr_78831_ = ?, attr_78832_ = ?
										WHERE attr_79243_ = ?");
				//echo 'update';
			}
		
		$sth->execute($data);
		*/
		unset($house_id, $company_id, 
						$region_id, $area_id, $city1_id, $city2_id, $street_id, $house_number, $block, $building/*,
						$exploitation_start_year, $area_residential, $area_non_residential, $storeys_count, $entrance_count, $residents_count, $privatization_start_date,
						$heating_system_metering_devices_count, $hot_water_system_metering_devices_count, $cold_water_system_metering_devices_count, $gas_system_metering_devices_count, $electricity_system_metering_devices_count,
						$heating_system_id, $hot_water_system_id, $cold_water_system_id, $gas_system_id, $sewerage_system_id, 
						$facade_last_overhaul_date, $roof_last_overhaul_date, $basement_last_overhaul_date, $lift_date_last_repair, 
						$electricity_system_last_overhaul_date, $heating_system_last_overhaul_date, $cold_water_system_last_overhaul_date, $hot_water_system_last_overhaul_date, $sewerage_system_last_overhaul_date, $gas_system_last_overhaul_date,
						$elevators_count, $deterioration_total*/);
		
		$i++;
		$recqty--;
	}
	
}
catch (SoapFault $exc) {
    print_r($exc->getMessage());
}
//$page_number++;
//}
require "Logout.php";
?>