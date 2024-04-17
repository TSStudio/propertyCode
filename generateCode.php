<?php
include 'db.php';

if (!isset($_REQUEST["asure"])) {
    exit();
}
$conn = new mysqli($__DB_MYSQL_HOST, $__DB_MYSQL_USER, $__DB_MYSQL_PASS, $__DB_MYSQL_DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$dicStr = "23456789ABCDEFGHIJKLMNPQRSTUVWXYZ";
function generateCode()
{
    global $dicStr;
    $code = "";
    for ($i = 0; $i < 5; $i++) {
        $code = $code . $dicStr[rand(0, 32)];
    }
    return $code;
}
function check_code_existance($conn, $code)
{
    $sql = "SELECT * FROM propertyCodes WHERE code='" . $code . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
$code = generateCode();
while (check_code_existance($conn, $code)) {
    $code = generateCode();
}
$time = time();
$sql = "INSERT INTO propertyCodes (status,type,code,createdTime) VALUES (0,2,'" . $code . "'," . $time . ")";
if ($conn->query($sql) === TRUE) {
    echo $code;
    header("Location: viewPrintCode.html?code=" . $code);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
