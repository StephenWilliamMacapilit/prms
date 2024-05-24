<div class="NavBar">
    
    <div class="NavBarSubSection">

        <div class="Logo">
            <a href="../index.php"><h1>PRMS</h1></a>
        </div>

        <div class="NavLinks">
            <a href="../index.php">Home</a>
            <a href="../pages/userpage.php">Profile</a>
        </div>

    </div>

    <div class="ProfileBubble">
<link rel="stylesheet" href="./css/profilebubble.css">


<?php
if (file_exists('functions\dbconnect.php')) {
  include 'functions\dbconnect.php';
} else {
  include '../functions\dbconnect.php';
}





        if (!isset($_COOKIE["user"])) {
            
            echo "
    <div class='loginregister'>
    <a href='pages/loginpage.php'>Login</a>
    /
    <a href='pages/registerpage.php'>Register</a>
    </div>
    ";
        } else {
            $string = strtoupper($_COOKIE["user"][0]);
            echo "


<style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
  margin-right: 75px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>";


$user = $_COOKIE["user"];
$check = $conn->query("SELECT privilege FROM user WHERE username = '$user'");
$row = $check->fetch_assoc();

if ($row["privilege"] == "admin") {
  echo "<div class='dropdown'>
<button onclick='myFunction()' class='dropbtn'>$string</button>
<div id='myDropdown' class='dropdown-content'>
<a href='../pages/userpage.php'>Profile</a>
<a href='../pages/adminpage.php'>Review</a>
<a href='../pages/messages.php'>Messages</a>
<div>
<form action='../functions/logout.php' method='post'>
<input type='submit' value='Log out'>
</form>
</div>
</div>
</div>";
} else {
  echo "<div class='dropdown'>
<button onclick='myFunction()' class='dropbtn'>$string</button>
<div id='myDropdown' class='dropdown-content'>
<a href='../pages/userpage.php'>Profile</a>
<a href='../pages/messages.php'>Messages</a>
<div>
<form action='../functions/logout.php' method='post'>
<input type='submit' value='Log out'>
</form>
</div>
</div>
</div>";
};




echo "<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById('myDropdown').classList.toggle('show');
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName('dropdown-content');
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>";



        };

    ?>

    </div>

    
</div>