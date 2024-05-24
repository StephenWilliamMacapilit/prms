<?php
    


    include_once "../functions/dbconnect.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $propertyid = $_POST["propertyid"];
        $image = $_POST["image"];
    
        $sql = "DELETE FROM registry WHERE propertyid = '$propertyid'";
        $conn->query($sql);

        unlink("../images/$image");

        $sql1 = "DROP TABLE pih$propertyid";
        $conn->query($sql1);

        $conn->close();

        if ($_POST["command"] == "admin") {
            header("location: ../pages/adminpage.php");
        } else {
            header("location: ../pages/userpage.php");
        };
        
    
    };
    
    
    
    
?>
