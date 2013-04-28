<?
header('Content-type=application/json; charset=utf-8');
include_once 'db_functions.php';
$db = new DB_Functions();
if(isset($_REQUEST['longitude'])&&isset($_REQUEST['latitude'])){
$long =$_REQUEST['longitude'];
$lat= $_REQUEST['latitude'];
}
else{
$long =0;
$lat= 0;

}
$foodchains = $db->getAllFoodChain($long,$lat);
print json_encode($foodchains);
?>