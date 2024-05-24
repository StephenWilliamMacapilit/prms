<?php
require_once "../functions/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_COOKIE['user'];
    $owner = $_POST['owner'];

    $sql = "SELECT * FROM contact WHERE username = '$username' AND contacts = '$owner'";

    if (mysqli_num_rows($conn->query($sql)) == 1) {

        $check = $conn->query("SELECT contactid FROM contact WHERE username = '$username' AND contacts = '$owner'");
        $check1 = $check->fetch_assoc();
        $check2 = $check1["contactid"];
        $conn->close();
        header("Location: ../pages/messages.php?contactid=$check2&contact=open");

    } else {

        $conn->query("INSERT INTO contact (username, contacts) VALUES ('$username', '$owner')");
        $result = $conn->query("SELECT contactid FROM contact WHERE username = '$username' AND contacts = '$owner';");
        $row = $result->fetch_assoc();
        $show = $row['contactid'];
        $conn->query("CREATE TABLE c$show (contactid INT, status varchar(255), content varchar(255), FOREIGN KEY (contactid) REFERENCES contact(contactid));");
        $conn->close();
        header("Location: ../pages/messages.php?contactid=$show&contact=open");

    };


};
?>