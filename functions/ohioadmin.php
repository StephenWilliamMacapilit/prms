<?php


include_once "../functions\dbconnect.php";

$iser = $_COOKIE["user"];

$result = $conn->query("SELECT privilege FROM user WHERE username = '$iser'");
$row = $result->fetch_assoc();

if ($row["privilege"] != "admin") {
    header("Location: ../pages/ohio.php");
};

?>