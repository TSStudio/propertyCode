<?php
include 'db.php';

if(!isset($_REQUEST["code"])){
    exit();
}
$code=$_REQUEST["code"];
$conn=new mysqli($__DB_MYSQL_HOST,$__DB_MYSQL_USER,$__DB_MYSQL_PASS,$__DB_MYSQL_DBNAME);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
function check_code_existance($conn,$code){
    $sql="SELECT * FROM propertyCodes WHERE code='".$code."'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        return true;
    }else{
        return false;
    }
}
if(!check_code_existance($conn,$code)){
    echo "Code not found";
    exit();
}
$sql="SELECT * FROM propertyCodes WHERE code='".$code."'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if($row["status"]==0&&time()-$row["createdTime"]<3600){
    $sql="UPDATE propertyCodes SET status=1 WHERE code='".$code."'";
    if($conn->query($sql)===TRUE){
        echo "ACTIVATED<br>";
    }else{
        echo "Error: ".$sql."<br>".$conn->error;
    }
}
    ?>