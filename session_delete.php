<?php

// response json
$json = array();

if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
  
   echo "hello";
 
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();

    $res = $db->deleteSession($id);

    if($res==false)echo "fail";
} else {
    // user details missing
	echo "nothing";
}
?>