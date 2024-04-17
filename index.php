<?php
include 'db.php';

if (!isset($_REQUEST["code"])) {
    exit();
}
$code = $_REQUEST["code"];
$conn = new mysqli($__DB_MYSQL_HOST, $__DB_MYSQL_USER, $__DB_MYSQL_PASS, $__DB_MYSQL_DBNAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
if (!check_code_existance($conn, $code)) {
    echo "Code not found";
    exit();
}
$sql = "SELECT * FROM propertyCodes WHERE code='" . $code . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if ($row["status"] == 0 && time() - $row["createdTime"] < 3600) {
?>
    CODE GENERATED WITHIN 1 HOUR BUT NOT ACTIVATED, ACTIVATE?<br>
    <form action="activate.php" method="post">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <input type="submit" value="Activate">
    </form>



<?php
    exit();
} else if ($row["status"] == 0 && time() - $row["createdTime"] >= 3600) {
    echo "CODE GENERATED MORE THAN 1 HOUR AGO BUT NOT ACTIVATED, DELETING...<br>";
    $sql = "DELETE FROM propertyCodes WHERE code='" . $code . "'";
    if ($conn->query($sql) === TRUE) {
        echo "DELETED<br>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    exit();
} else {
    // header("Location: https://www.tmysam.top/Property/template.html?type=".$row["type"]);
    header("Location: picktemplate.html?type=" . $row["type"] . "&code=" . $code);
}
