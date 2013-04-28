<?
include_once 'db_functions.php';
if(isset($_REQUEST['res'])&&isset($_REQUEST['food'])&&isset($_REQUEST['qty'])){
	$res=$_REQUEST['res'];
	$food=$_REQUEST['food'];
	$qty=$_REQUEST['qty'];
$db = new DB_Functions();
$result = $db->insertFoodOrder($res,$food,$qty);
echo $result;
}
?>