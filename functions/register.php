<?php

include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $username = $_POST["username"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        if ($username != "" && $password != "" && $email != "" && $phone != "") {

            if (mysqli_num_rows($conn->query("SELECT * FROM user WHERE username = '$username'")) > 0) {
                header("location: ../pages/registerpage.php?error=User%20already%20exists.");
                exit();
            } else {
                $sql = "INSERT INTO user VALUES ('$username', '$password', '$email', '$phone', 'user')";
                $conn->query($sql);
                setcookie("user", $username, time() + 3600, "/");
                $conn->close();
                header("location: ../index.php");
            };
        } else {
            header("location: ../pages/registerpage.php?error=Fill%20in%20details!");
        };

};

?>