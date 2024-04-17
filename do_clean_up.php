<?php 
include 'db.php';
if(!isset($_REQUEST["code"])){
    exit();
}
$code=$_REQUEST["code"];
if($code!="TSSTUDIOSIDESERVER"){
    exit();
}
$conn=new mysqli($__DB_MYSQL_HOST,$__DB_MYSQL_USER,$__DB_MYSQL_PASS,$__DB_MYSQL_DBNAME);
$time_1_hour_ago=time()-3600;
$sql="DELETE FROM propertyCodes WHERE createdTime<".$time_1_hour_ago." AND status=0";
$conn->query($sql);