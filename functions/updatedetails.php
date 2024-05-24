<?php

include_once "../functions/dbconnect.php";


$propertyid = $_POST["propertyid"];
$command = $_POST["command"];
$currentimage = $_POST["currentimage"];


if ($command == "description") {
    $var = $_POST["edit"];

    if ($var == "") {
        header("Location: ../pages/propertydetails.php?propertyid=$propertyid");
    
    } else {
        $conn->query("UPDATE registry SET description = '$var' WHERE propertyid = $propertyid");
        header("Location: ../pages/propertydetails.php?propertyid=$propertyid");
    
    
    };

} else if ($command == "image") {

    $targetDir = "../images/";
    $filename = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);





    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $sql = "UPDATE registry SET image = '$filename' WHERE propertyid = $propertyid";
            $insert = $conn->query($sql);
            if($insert){
                unlink("../images/$currentimage");
                echo "The file ".$filename. " has been uploaded successfully.";
            }else{
                echo "File upload failed, please try again.";
            } ;
        }else{
            echo "Sorry, there was an error uploading your file.";
        };
    }else{
        echo 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
    };

} else if ($command == "document") {

    $targetDir = "../images/";
    $filename = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $filename;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);





    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $sql = "UPDATE registry SET document = '$filename' WHERE propertyid = $propertyid";
            $insert = $conn->query($sql);
            if($insert){
                unlink("../images/$currentdocument");
                echo "The file ".$filename. " has been uploaded successfully.";
            }else{
                echo "File upload failed, please try again.";
            } ;
        }else{
            echo "Sorry, there was an error uploading your file.";
        };
    }else{
        echo 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
    };

} else if ($command == "map") {



    $fold = $_POST["map"];

    $cap = $conn->real_escape_string($fold);


    if ($cap == "") {
        header("Location: ../pages/propertydetails.php?propertyid=$propertyid");
    
    } else {
        $conn->query("UPDATE registry SET map = '$cap' WHERE propertyid = $propertyid");
        header("Location: ../pages/propertydetails.php?propertyid=$propertyid");
    
    
    };






};















header("Location: ../pages/propertydetails.php?propertyid=$propertyid");

?>