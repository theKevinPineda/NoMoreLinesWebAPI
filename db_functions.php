<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once './db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

	
	public function getAllFoodChain($long, $lat){
		
        $result = mysql_query("select *,SQRT(POW(69.1 * (latitude - '$lat'), 2) + POW(69.1 * ('$long' - longitude) * COS(latitude / 57.3), 2)) AS distance	
FROM foodchains HAVING distance < 9999 ORDER BY distance");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;
    }
	
	
	
	public function getAvailableTable($id) {
        $result = mysql_query("select `available_tables` FROM foodchains WHERE `id`='$id' LIMIT 1");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;
    }
	public function getAllFoodItems($id) {
        $result = mysql_query("select * FROM fooditems WHERE `foodchain_id`='$id'");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;
    }		
	
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $gcm_regid) {
        // insert user into database
        $result = mysql_query("INSERT INTO gcm_users(name, email, gcm_regid, created_at) VALUES('$name', '$email', '$gcm_regid', NOW())");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM gcm_users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	
	/**
     * Storing new user
     * returns user details
     */
    public function storeUser1($name, $pass,$name1) {
        // insert user into database
        $result = mysql_query("INSERT INTO users(username, password,name) VALUES('$name', '$pass','$name1')");
        // check for successful store
        if ($result) {
            // get user details
            $id = mysql_insert_id(); // last inserted id
            $result = mysql_query("SELECT * FROM users WHERE id = $id") or die(mysql_error());
            // return user details
            if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
	public function storeSession($id,$gcm){
		mysql_query("INSERT INTO current_sessions(gcm,user_id) VALUES('$gcm','$id')");
		return true;
	}
		
	public function deleteSession($id){
		mysql_query("DELETE FROM  `current_sessions` WHERE  `user_id`='$id'");
	}
	
	public function sendUser($users){
	if ($users != false)
            $no_of_users = 1;
        else
            $no_of_users = 0;
if($no_of_users != 0){
	$message      = "the test message";
	$tickerText   = "ticker text message";
	$contentTitle = "content title";
	$contentText  = "content body";
	
	$registrationId = $users;
	$apiKey = "AIzaSyBpdDwaHyXehKvC4Wu88TtPp6gZJlepYgU";
	include_once './GCM.php';
	$rap = new GCM();
	$response = $rap->send_notification( 
					$registrationId, 
					array('message' => $message, 'tickerText' => $tickerText, 'contentTitle' => $contentTitle, "contentText" => $contentText) );
	
	echo $response;
}
}

    /**
     * Getting all users
     */
    public function getAllUsers() {
        $result = mysql_query("select * FROM users");
        return $result;
    }	
	public function getName($id) {
         $result = mysql_query("select * FROM users WHERE `id`='$id'");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;
    }	
	 public function getAllRegUsers1() {
         $result = mysql_query("select * FROM current_sessions");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r['gcm'];
		}
        return $row;
    }
	public function getAllRegUsers() {
        $result = mysql_query("select * FROM users");
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r['gcm_regid'];
		}
        return $row;
    }
	  /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $result = mysql_query("SELECT id from users WHERE username = '$email'");
        $no_of_rows = mysql_num_rows($result);
        if ($no_of_rows > 0) {
            // user existed
            return true;
        } else {
            // user not existed
            return false;
        }
    }
	public function insertReservation($time,$date,$uid,$fid){
	$sql = "INSERT INTO reservations(time, date,user_id,foodchain_id) VALUES('$time', '$date','$uid','$fid')";
	$result= mysql_query($sql);
	if($result){
		$id = mysql_insert_id();
		$sql = "SELECT * from reservations WHERE id = '$id'";
		$result=mysql_query($sql);
		if (mysql_num_rows($result) > 0) {
                return mysql_fetch_array($result);
            } else {
				return false;
            }
	}
	else 
		return false;
	}
	
	public function insertFoodOrder($res,$food,$quantity){
	$sql = "INSERT INTO foodorders(reservation_id, fooditems_id,quantity) VALUES('$res', '$food','$quantity')";
	$result= mysql_query($sql);

	return $result;
	}
	
	public function insertReserveTable($res,$tqty,$pqty){
	$sql = "INSERT INTO reservetables(reservation_id, table_quantity,people_quantity) VALUES('$res', '$tqty','$pqty')";
	$result= mysql_query($sql);
	return $result;
	}
	public function imageUpload($name,$id){
	$sql = "UPDATE  `users` SET  `photo` =  '$name' WHERE  `id` ='$id'";
	$result= mysql_query($sql);
	return $result;
	}
	
	public function getReservation($id){
	$sql = "SELECT  `time` ,  `date` ,  `longitude` ,  `latitude` ,  `name` ,  `thumb_photo` 
FROM  `reservations` AS  `pr` 
LEFT JOIN  `foodchains` AS  `p` ON  `pr`.`foodchain_id` =  `p`.`id` 
WHERE  `user_id` ='$id'
ORDER BY  `date` ASC 
LIMIT 3";

	$result = mysql_query($sql);
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;
	}
	public function deleteReservation($id){
		$sql= "DELETE FROM reservations WHERE `id`='$id'";
        $result = mysql_query($sql);
		$row = array();
		while($r = mysql_fetch_assoc($result)){
		$row[] = $r;
		}
        return $row;		
	}
}

?>