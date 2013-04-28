<?
include_once 'db_connect.php';
$db = new DB_Connect();
$db->connect();
if(isset($_REQUEST['name'])&&isset($_REQUEST['pass'])){
$name=$_REQUEST['name'];
$pass=$_REQUEST['pass'];
$query = "SELECT * FROM users WHERE `username`='$name' AND `password`='$pass' LIMIT 1";
}

if(isset($query)){
	$result = mysql_query($query);
	$row = array();
	while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
	print json_encode($row);
}

?>