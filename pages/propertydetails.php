<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS</title>
    <link rel="stylesheet" href="../css/index3.css">
    <link rel="stylesheet" href="../css/navbar1.css">
    <link rel="stylesheet" href="../css/propertydetails1.css">
</head>
<body>
    <?php include "../components/navbar.php"; ?>
    <?php include "../functions/dbconnect.php"; ?>
    <?php require_once "../functions/ohio.php";?>
    

    <div class="property">

        <?php

        $propertyid = $_GET["propertyid"];

        $propertycheck = $conn->query("SELECT * FROM registry WHERE propertyid = $propertyid");
        $check = $propertycheck->fetch_assoc();
        $name = $check["location"];
        $owner = $check["owner"];
        $user = $_COOKIE["user"];

        echo "<h1>".$name."</h1>";


        ?>

    </div>




    <div class="details">

        <div class="image">

            <?php


            $details1 = $conn->query("SELECT * FROM registry WHERE propertyid = $propertyid");
            $detail1 = $details1->fetch_assoc();

            $image = $detail1["image"];
            $document = $detail1["document"];
            $map = $detail1["map"];


            echo "<img src='../images/$image' alt='Property image'>";
            
            if ($user == $owner) {
                echo
                "<form action='../functions/updatedetails.php' method='post' enctype='multipart/form-data'>".

                "<input type='hidden' name='command' value='image'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='hidden' name='currentimage' value='$image'>".
                "Update image: <input type='file' name='image' id='image'>"."<br>".
                "<input type='submit' value='Update image'>".

                "</form>";
            };

            
            echo "<img src='../images/$document' alt='Property document'>";

            if ($user == $owner) {
                echo
                "<form action='../functions/updatedetails.php' method='post' enctype='multipart/form-data'>".

                "<input type='hidden' name='command' value='document'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='hidden' name='currentdocument' value='$document'>".
                "Update document: <input type='file' name='image' id='image'>"."<br>".
                "<input type='submit' value='Update document'>".

            "</form>"
           
            
            ;
            };



            if ($user == $owner) {
                echo
                "<form action='../functions/updatedetails.php' method='post' enctype='multipart/form-data'>".

                "<input type='hidden' name='command' value='map'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "Update map: <input type='text' name='map'>"."<br>".
                "<input type='submit' value='Update map'>".

            "</form>"
           
            
            ;
            };
           

            
            

            ?>

        </div>

        <div class="text">

        <?php

        $details = $conn->query("SELECT * FROM registry WHERE propertyid = $propertyid");
        $detail = $details->fetch_assoc();

        $image = $detail["image"];
        
        
        echo "<h3>"."Property type: ".$detail["type"]."</h3>".
        "<h3 style='margin: 0;'>"."Description: "."</h3>".
        "<p style='margin: 0;'>".$detail["description"]."</p>"."<br>";



        if ($user == $owner) {
            echo
            "<form action='../functions/updatedetails.php' method='post'>".

            "<input type='hidden' name='command' value='description'>".
            "<input type='hidden' name='propertyid' value='$propertyid'>".
            "<textarea name='edit'>"."</textarea>"."<br>".
            "<input type='submit' value='Update description'>".

        "</form>"
       
        
        ;
        };
        


        echo "<h3>"."Verification: ".$detail["verification"]."</h3>";


        ?>

        </div>

    </div>

    <div class="details">

        <?php

        $fold1 = $conn->query("SELECT * FROM registry WHERE propertyid = $propertyid");
        $fold = $fold1->fetch_assoc();

        $map = $fold["map"];

        echo "$map";

        ?>

    </div>


</body>
</html>