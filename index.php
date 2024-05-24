<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS</title>
    <link rel="stylesheet" href="css/index3.css">
    <link rel="stylesheet" href="css/navbar1.css">
</head>
<body>
    <?php require_once "components/navbar.php";?>
    
    <div class="catalog">


    <?php
    include_once "functions/dbconnect.php";
    $sql = "SELECT * FROM registry WHERE status = 'for sale'";
    $result = $conn->query($sql);

    


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {

        if ($row["status"] == "not for sale") {
            $update = "Put up for sale!";
        } else {
            $update = "not for sale!";
        };

        $propertyid = $row["propertyid"];
        $owner = $row["owner"];
        $image = $row["image"];

        echo "<div class='indivcontent'>".

            "<div class='imageinfo'>".

                "<img src='../images/$image' alt='Property image'>".

                "<div class='propertyoptions'>".
                    "<form action='./functions/contact.php' method='post'>".
                        "<input type='hidden' name='owner' value='$owner'>".
                        "<input type='submit' value='Message Owner'>".
                    "</form>".

                    "<form action='../pages/propertyhistory.php' method='get'>".
                        "<input type='hidden' name='propertyid' value='$propertyid'>".
                        "<input type='submit' value='Check history'>".
                    "</form>".

                    "<form action='../pages/propertydetails.php' method='get'>".
                        "<input type='hidden' name='propertyid' value='$propertyid'>".
                        "<input type='submit' value='Full details'>".
                    "</form>".
                "</div>".

            "</div>".

            "<div class='textinfo'>".

                "<h4>".$row['location']."</h4>".
                "<h5>"."Type of property: ".$row['type']."</h5>".
                "<h5>"."Currently owned by: ".$row['owner']."</h5>".
                "<h5>"."Verification: ".$row['verification']."</h5>".
                "<h5>"."Status: ".$row['status']."</h5>".
                "<h5>"."Property ID: ".$propertyid."</h5>".
                
            "</div>".

            

        "</div>";

    }
} else {
    echo "No properties for sale.";
};
    ?>


    </div>


    <script>
// JavaScript to handle dropdown functionality
document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.indivcontent');

    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('mouseenter', function() {
            this.querySelector('.propertyoptions').style.display = 'block';
        });

        dropdown.addEventListener('mouseleave', function() {
            this.querySelector('.propertyoptions').style.display = 'none';
        });
    });
});
</script>






</body>
</html>