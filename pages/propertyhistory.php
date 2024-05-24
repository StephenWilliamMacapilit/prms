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

    <div class="log">

        <div class="propertyid">
            <?php
            $propertyid = $_GET["propertyid"];
            echo "<h1>". "Property ID:". " ". "$propertyid". "</h1>";

            ?>
        </div>

        <div class="history">

            <?php

            $sql = "SELECT * FROM pih$propertyid ORDER BY date";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div>".$row["date"]." - ".$row["status"]."</div>";
                };
            };
            ?>

        </div>

    </div>



    
</body>
</html>