<?php
    


    include_once "../functions/dbconnect.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $propertyid = $_POST["propertyid"];
        $changestatus = $_POST["changestatus"];
    
        if ($changestatus == "Put up for sale!") {

    
            $sql = "UPDATE registry SET status = 'for sale' WHERE propertyid = $propertyid";
    
            $conn->query($sql);
            $conn->close();
            header("location: ../pages/userpage.php");
        } else {
     
    
            $sql = "UPDATE registry SET status = 'not for sale' WHERE propertyid = $propertyid";
    
            $conn->query($sql);
            $conn->close();
            header("location: ../pages/userpage.php");
        };
    
    };
    
    
    
    
?>