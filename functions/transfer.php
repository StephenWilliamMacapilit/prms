<?php
require_once "../functions/dbconnect.php";

$newowner = $_POST["newowner"];
$propertyid = $_POST["propertyid"];
$user = $_COOKIE["user"];

$sql = "SELECT * FROM user WHERE username = '$newowner'";

if (mysqli_num_rows($conn->query($sql)) == 1) {

    $conn->query("UPDATE registry SET owner = '$newowner' WHERE propertyid = $propertyid");
    $conn->query("INSERT INTO pih$propertyid (date, status) VALUES (NOW(), 'Transferred from $user to $newowner')");
    header("Location: ../pages/userpage.php");

} else {

    header("Location: ../pages/userpage.php");

};
?>