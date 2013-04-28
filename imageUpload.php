<?php

header('Content-Type: image/jpg; charset=utf-8');
$base=$_REQUEST['image'];
$binary=base64_decode($base);
$suffix = createRandomID();
$image_name = "img_".$suffix."_".date("Y-m-d-H-m-s").".jpg";
$file = fopen($image_name, 'wb');
fwrite($file, $binary);
fclose($file);
sendData($image_name);


function sendData($link){
include_once 'db_functions.php';
$db = new DB_Functions();
$id = $_REQUEST['id'];
$result = $db->imageUpload($link,$id);
print json_encode($result);
}


function createRandomID() {

$chars = "abcdefghijkmnopqrstuvwxyz0123456789";
//srand((double) microtime() * 1000000);

$i = 0;

$pass = "";

while ($i <= 5) {

$num = rand() % 33;

$tmp = substr($chars, $num, 1);

$pass = $pass . $tmp;

$i++;
}
return $pass;
}

?>