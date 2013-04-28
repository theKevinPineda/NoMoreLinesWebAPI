<?
include_once 'db_functions.php';
if(isset($_REQUEST['res'])&&isset($_REQUEST['tqty'])&&isset($_REQUEST['pqty'])){

	$res=$_REQUEST['res'];
	$tqty=$_REQUEST['tqty'];
	$pqty=$_REQUEST['pqty'];
$db = new DB_Functions();
$result = $db->insertReserveTable($res,$tqty,$pqty);
echo $result;
}
?>