<?
include_once 'db_functions.php';
if(isset($_REQUEST['id'])){

	$id = $_REQUEST['id'];
	
$db = new DB_Functions();
$result = $db->deleteReservation($id);
print json_encode($result);
}
?>