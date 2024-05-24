<?php


include_once "../functions/dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $owner = $_COOKIE["user"];
    $location = $_POST["location"];
    $type = $_POST["type"];

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
            $sql = "INSERT INTO registry (location, image, type, owner, verification, status) VALUES ('$location', '$filename', '$type', '$owner', 'not verified', 'not for sale')";
            $insert = $conn->query($sql);
            if($insert){
                
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





$sql1 = "SELECT propertyid FROM registry WHERE owner = '$owner' AND location = '$location'";
    $check = $conn->query($sql1);








    if ($check->num_rows > 0) {
        while($row = $check->fetch_assoc()) {
            $propertyid = $row["propertyid"];
            echo "$propertyid";

            $sql2 = "SELECT 1 FROM information_schema.tables WHERE table_name = 'pih$propertyid' LIMIT 1";
            $check2 = $conn->query("$sql2");
            if ($check2 && $check2->num_rows > 0) {

                echo "nan";
                
            } else {
                $sql3 = "CREATE TABLE pih$propertyid (date DATE, status varchar(255))";
                $conn->query($sql3);
                $sql4 = "INSERT INTO pih$propertyid (date, status) VALUES (NOW(), 'Property registered')";
                $conn->query($sql4);
            };

        };


    
    $conn->close();
    header("location: ../pages/userpage.php");

    };

};



?>
