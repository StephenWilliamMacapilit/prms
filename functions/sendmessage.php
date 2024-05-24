<?php
require_once "../functions/dbconnect.php";

$contact = $_POST["contact"];
$message = $_POST["message"];
$username = $_COOKIE["user"];
$owner = $_POST["owner"];



if (mysqli_num_rows($conn->query("SELECT * FROM contact WHERE username = '$owner' AND contacts = '$username'")) == 1) {

    $conn->query("INSERT INTO c$contact VALUES ($contact, 'You', '$message');");
    $contact1 = $conn->query("SELECT contactid FROM contact WHERE username = '$owner' AND contacts = '$username'");
    $result = $contact1->fetch_assoc();
    $check = $result["contactid"];
    $conn->query("INSERT INTO c$check VALUES ($check, '$username', '$message');");

} else {

    $conn->query("INSERT INTO contact (username, contacts) VALUES ('$owner', '$username')");
    $contact2 = $conn->query("SELECT contactid FROM contact WHERE username = '$owner' AND contacts = '$username'");
    $result = $contact2->fetch_assoc();
    $check = $result["contactid"];
    $conn->query("CREATE TABLE c$check (contactid INT, status varchar(255), content varchar(255), FOREIGN KEY (contactid) REFERENCES contact(contactid));");
    $conn->query("INSERT INTO c$check VALUES ($check, '$username', '$message');");
    $conn->query("INSERT INTO c$contact VALUES ($contact, 'You', '$message');");


};










$conn->close();
header("Location: ../pages/messages.php?contactid=$contact&contact=open");



?>

