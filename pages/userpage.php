<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS</title>
    <link rel="stylesheet" href="../css/index3.css">
    <link rel="stylesheet" href="../css/navbar1.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/userpage4.css">
</head>
<body>
    <?php require_once "../components/navbar.php";?>
    <?php require_once "../functions/dbconnect.php";?>
    <?php require_once "../functions/ohio.php";?>

    <div class="banner">
        <h1><?php echo $_COOKIE["user"];?></h1>
    </div>

    <div class="registerproperty">


            <form action="../functions/registerproperty.php" method="post" enctype="multipart/form-data">
                Location: <input type="text" name="location" id=""> <br>
                Image: <input type="file" name="image" id="image">
                Type: <select name="type" id="">
                    <option value="lot">Lot</option>
                    
                    <option value="house">House</option>
                    <option value="house and lot">House and lot</option>
                    <option value="vehicle">Vehicle</option>
                </select> <br>
                <input type="submit" value="Register">
            </form>


    </div>








    <div class="content">

    <?php

    $owner = $_COOKIE["user"];

    $sql = "SELECT * FROM registry WHERE owner = '$owner'";
    $result = $conn->query($sql);

    


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        if ($row["status"] == "not for sale") {
            $update = "Put up for sale!";
        } else {
            $update = "not for sale!";
        };

        $propertyid = $row["propertyid"];
        $image = $row["image"];

        echo "<div class='indivcontent'>".

            "<div class='imageinfo'>".
                "<img src='../images/$image' alt='Property image'>".
            "</div>".

            "<div class='textinfo'>".
                "<h4>".$row['location']."</h4>".
                "<h5>"."Type of property: ".$row['type']."</h5>".
                "<h5>"."Currently owned by: ".$row['owner']."</h5>".
                "<h5>"."Verification: ".$row['verification']."</h5>".
                "<h5>"."Status: ".$row['status']."</h5>". 
                "<h5>"."Property ID: ".$propertyid."</h5>". 
                "<form action='../functions/updateproperty.php' method='post'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='hidden' name='changestatus' value='$update'>".
                "<input type='submit' value='$update'>".
                "</form>".
                "</h5>".
                "<form action='../functions/delteproperty.php' method='post'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='hidden' name='image' value='$image'>".
                "<input type='submit' value='Delete'>".
                "</form>".
                "<form action='../functions/transfer.php' method='post'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='text' name='newowner' placeholder='Transfer to'>".
                "<input type='submit' value='Transfer'>".
                "</form>".
                "<form action='../pages/propertydetails.php' method='get'>".
                "<input type='hidden' name='propertyid' value='$propertyid'>".
                "<input type='submit' value='Full details'>".
                "</form>".
            "</div>".

        "</div>";

    }
} else {
    echo "0 results";
};
    ?>



    </div>
    
</body>
</html>