<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS</title>
    <link rel="stylesheet" href="../css/index3.css">
    <link rel="stylesheet" href="../css/navbar1.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/userpage5.css">
    <link rel="stylesheet" href="../css/messenher3.css">

    <script>
        function refreshPage() {
            location.reload();
        }
    </script>

</head>
<body>
    <?php require_once "../components/navbar.php";?>
    <?php require_once "../functions/dbconnect.php";?>
    <?php require_once "../functions/ohio.php";?>

    <div class="messenger">

        <div class="contacts">
            
            <?php

                $username = $_COOKIE["user"];

                $sql = "SELECT * FROM contact WHERE username = '$username'";
                $result = $conn->query($sql);



                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $contactid = $row["contactid"];
                        echo 
                        "<form action='../pages/messages.php' method='get'>".
                        "<h3>".$row['contacts']."</h3>".
                        "<input type='hidden' name='contactid' value='$contactid'>".
                        "<input type='submit' name='contact' value='open'>".
                        "<input type='submit' name='contact' value='delete'>".
                        "</form>"
                        ;
                    };
                };

            ?>

        </div>

        <div class="mail">


            <?php

                if ($_SERVER["REQUEST_METHOD"] == "GET") {

                    if (isset($_GET["contact"])) {

                        $contact = $_GET["contactid"];
                        $username = $_COOKIE["user"];
                        
                        if ($_GET["contact"] == "open") {

                            
                            

                            $result = $conn->query("SELECT * FROM c$contact");
                            $owner = $conn->query("SELECT contacts FROM contact WHERE username = '$username' AND contactid = $contact");

                            echo "<div class='messages'>";

                            if ($result->num_rows > 0) {

                                

                                while($row = $result->fetch_assoc()) {

                                    echo 
                                    
                                        "<p>".$row["status"].":"." ".$row["content"]."</p>"
                                    ;
                                    
                                };

                            };

                            $check = $owner->fetch_assoc();
                            $check1 = $check["contacts"];

                            echo "</div>";

                            echo 
                            "<div class='sned'>".
                                        "<form action='../functions/sendmessage.php' method='post'>".
                                            "<input type='hidden' name='owner' value='$check1'>".
                                            "<input type='hidden' name='contact' value='$contact'>".
                                            "<input type='text' name='message' id=''>".
                                            "<input type='submit' value='Send'>".
                                        "</form>".

                                        "<button onclick='refreshPage()'>Refresh Page</button>".

                                    "</div>"
                                    ;



                        } else if ($_GET["contact"] == "delete") {


                            $conn->query("DROP TABLE c$contact");
                            $conn->query("DELETE FROM contact WHERE username = '$username' AND contactid = '$contact'");
                            header("Location: ../pages/messages.php");


                        };

                    };  
                    
                };

            ?>

            

            

        </div>

    </div>
    
</body>
</html>