<?php 
// You cannot access the dashboard unless you are logged in
// we will check first if you want to sign out which 
// will take you off the dashboard immediately
// and invalidate previous cookies

if($_SERVER["REQUEST_METHOD"] == "POST"){

        setcookie('is_staff', 'yes', time() - (86400 * 7), "/");
        setcookie('staff_name', $row['Name'], time() - (86400 * 7), "/");
        setcookie('staff_id', $row['EmployeeID'], time() - (86400 * 7), "/");
        setcookie('branch_id', $branchID, time() - (86400 * 7), "/");
    header("Location: stafflogin.php");
}


if ($_COOKIE['is_staff'] !== 'yes') {
    header("Location: stafflogin.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "style/home.css">
  <title>Staff Dashboard</title>
</head>
<body>
<div class = "titlebar">
    <nav>
        <ul>
            <li class = "left"><a>For Sale</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            <li class = "left"><a>Maintanence</a></li>
            <li class = "right"><a><?php echo $_COOKIE['staff_name']; ?></a></li>
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