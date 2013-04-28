<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_REQUEST["id"]) && isset($_REQUEST["gcm_id"])) {
    $id = $_REQUEST["id"];
    $gcm = $_REQUEST["gcm_id"];
   echo "hello";
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();

    $res = $db->storeSession($id, $gcm);

    if($res==false)echo "fail";
} else {
    // user details missing
	echo "nothing";
}
?>