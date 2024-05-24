<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS</title>
    <link rel="stylesheet" href="../css/index5.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/userpage3.css">
</head>
<body>
    <?php require_once "../components/navbar.php";?>
    <?php require_once "../functions/dbconnect.php";?>
    <?php require_once "../functions/ohio.php";?>
    <?php require_once "../functions/ohioadmin.php";?>

    <div class="banner">
        <h1><?php echo $_COOKIE["user"];?></h1>
    </div>


    <div class="catalog">

        <?php

            $check = $conn->query("SELECT * FROM registry WHERE verification = 'not verified';");

            if ($check->num_rows > 0) {
                while($row = $check->fetch_assoc()) {
                    
                    $image = $row["image"];
                    $propertyid = $row["propertyid"];

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
                        "<form action='../functions/delteproperty.php' method='post'>".
                            "<input type='hidden' name='propertyid' value='$propertyid'>".
                            "<input type='hidden' name='image' value='$image'>".
                            "<input type='hidden' name='command' value='admin'>".
                            "<input type='submit' value='Delete'>".
                        "</form>".
                        "<form action='../functions/verify.php' method='post'>".
                            "<input type='hidden' name='propertyid' value='$propertyid'>".
                            "<input type='submit' value='Verify'>".
                        "</form>".
                            "<form action='../pages/propertydetails.php' method='get'>".
                            "<input type='hidden' name='propertyid' value='$propertyid'>".
                            "<input type='submit' value='Full details'>".   
                        "</form>".
                    "</div>".

                "</div>";
                };
            };

        ?>

    </div>
    
    
</body>
</html>