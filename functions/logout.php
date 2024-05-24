<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
foreach ($_COOKIE as $cookie_name => $cookie_value) {
    setcookie($cookie_name, "", time() - 3600, "/");
    unset($_COOKIE[$cookie_name]);
}
header("location: ../index.php");
};
?>
