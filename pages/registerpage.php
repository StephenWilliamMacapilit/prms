<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRMS Register</title>
</head>
<body>
        <h1>PRMS Register</h1>
        <form action="../functions/register.php" method="post">
            username <input type="text" name="username">
            <br>
            password <input type="text" name="password">
            <br>
            email <input type="text" name="email">
            <br>
            mobile num. <input type="text" name="phone">
            <br>
            <input type="submit" value="Register">
        </form>
        <a href="../pages/loginpage.php">Login instead</a>
        <?php
        if (isset($_GET['error'])) {
            echo "<p>{$_GET['error']}</p>";
            unset($_GET['error']);
        };
        ?>
</body>
</html>