<?php

include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    

        $username = $_GET["username"];
    $password = $_GET["password"];
    $sql = "SELECT * FROM user WHERE username = '$username' && password = '$password'";

    if (mysqli_num_rows($conn->query($sql)) == 1) {
        
        

    

            setcookie("user", $username, time() + 3600, "/");
            $conn->close();
            header("location: ../index.php");

        

    } else {
        header("location: ../pages/loginpage.php?error=You%20don't%20exist.");
            exit();
    };



};

?>