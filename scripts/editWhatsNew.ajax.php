<?php
require('../includes/class/database.class.php');
$data = $_POST;
$current_order_items = $data['current_order'];
$bin_items = array_key_exists('bin_items', $data)? $data['bin_items']: '';
$db = new database;
$database = $db ->connect();

$sql= "";

foreach ($current_order_items as $current_order_item){
	$sql .= "UPDATE pages SET";
	
	if ($current_order_item["whatnewenglishH"] !== $current_order_item["whatnewenglish"]){
		$sql .= ' whatnewenglish`= "'.$current_order_item["whatnewenglish"].'",';
	}
			
	if ($current_order_item["whatnewcymraegH"] !== $current_order_item["whatnewcymraeg"]){
		$sql .= ' whatnewcymraeg = "'.$current_order_item["whatnewcymraeg"].'",';
	}
	
	$sql .= ' includedinnew = "'.$current_order_item["includedinnew"].'",';
	
	if ($current_order_item["newsorderH"] !== $current_order_item["newsorder"]){
		$sql .= ' newsortorder = "'.$current_order_item["newsorder"].'",';
	}
		
	$sql = rtrim($sql,',');
	$sql .= ' WHERE filename = "'.$current_order_item['filename'].'";'."\n";
}

if (is_array($bin_items)){
	foreach($bin_items as $bin_item){
		$sql .= 'UPDATE pages SET  includedinnew = "'.$bin_item["includedinnew"].'", newsortorder = "'.$bin_item["newsorder"].'",' 
		.' WHERE filename = "'.$bin_item['filename'].'";'."\n";
	}
}

$query = $database ->prepare($sql);
$query -> execute();

echo json_encode($data);



?>