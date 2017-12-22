<?php
require('../includes/class/database.class.php');
//echo json_encode($_GET);

$term = $_GET['term'];

$db = new database;
$database = $db ->connect();

$sql = "SELECT * FROM songs WHERE title LIKE '%".$term ."%'";
$query = $database ->prepare($sql);
$query -> execute();

$data = array();

while ($row =  $query ->fetch(PDO::FETCH_ASSOC)){
	
	$data[] = array (
	"label" => $row["title"],
	"value" =>  $row["title"]
	);
	
}

echo json_encode($data);

?>