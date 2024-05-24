<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS Login</title>
</head>
<body>
    
    <div>
        <h1>PRMS Login</h1>
        <form action="../functions/login.php" method="get">
            username <input type="text" name="username">
            <br>
            password <input type="text" name="password">
            <br>
            <input type="submit" value="Login">
        </form>
    </div>
    <a href="../pages/registerpage.php">Regist instead</a>
    <?php
        if (isset($_GET['error'])) {
            echo "<p>{$_GET['error']}</p>";
        }
        ?>

</body>
</html>