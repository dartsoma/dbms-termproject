<?php 
// You cannot access the dashboard unless you are logged in
// we will check first if you want to sign out which 
// will take you off the dashboard immediately
// and invalidate previous cookies

if($_SERVER["REQUEST_METHOD"] == "POST"){

setcookie("is_logged_in", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");
setcookie("customer_id", "", time() - 3600, "/");
    header("Location: login.php");
}


if ($_COOKIE['is_logged_in'] !== 'yes') {
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "style/home.css">
  <title>Dashboard</title>
</head>
<body>
<div class = "titlebar">
    <nav>
        <ul>
            <li class = "left"><a href = "cars.php">For Sale</a></li>
            <li class = "left"><a href = "maintenance.php">Maintenance</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            
            <li class = "right"><a><?php echo $_COOKIE['username']; ?></a></li>
        </ul>
    </nav>
</div>


<div class="login">

<h1>Login Completed</h1>
<form method = "POST" action ="">
<input type = "submit" value = "Sign Out">
</form>
</div>

</body>
</html>