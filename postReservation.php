<?
include_once 'db_functions.php';
if(isset($_REQUEST['id'])&&isset($_REQUEST['time'])&&isset($_REQUEST['date'])){
	$id=$_REQUEST['id'];
	$time=$_REQUEST['time'];
	$date=$_REQUEST['date'];
	$fid=$_REQUEST['fid'];
$db = new DB_Functions();
$fooditems = $db->insertReservation($time,$date,$id,$fid);
print json_encode($fooditems);
}
?>