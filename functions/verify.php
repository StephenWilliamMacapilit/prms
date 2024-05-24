<?php

    include_once "../functions\dbconnect.php";

    $propertyid = $_POST["propertyid"];

    $conn->query("UPDATE registry SET verification = 'verified' WHERE propertyid = $propertyid");

    header("location: ../pages/adminpage.php");

?>