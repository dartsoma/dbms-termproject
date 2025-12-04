<?php 
if ($_COOKIE['is_logged_in'] == 'yes') {
    header("Location: Dashboard.php");
    exit();
}

// If we are logged in we will redirect to the dashboard

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "style/home.css">
  <title>Car Rental Company</title>
</head>
<body>
<div class = "titlebar">
    <nav>
        <ul>
            <li class = "left"><a>For Sale</a></li>
            <li class = "left"><a>Maintanence</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            
            <li class="right"><a href="stafflogin.php">Staff Login</a></li>
            <li class = "right"><a href="index.php">Register</a></li>
        </ul>
    </nav>
</div>

<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalOrg';

$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$user = $_POST['username'];
$pass = $_POST['passkey'];


// we will literally check if there is any login
// that exists with the credientals we gave it

$sql = "SELECT CustomerID FROM account WHERE UserName = '$user' AND PassKey = '$pass'";
$sql2 = "SELECT CustomerID FROM customer";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

// we will populate cookies so that we stay logged on to the website for a period of time
// i set it to something like a little over 24hrs; this would be measured by the second.
if (mysqli_num_rows($result) > 0) {
    setcookie('is_logged_in', 'yes', time() + (86400 * 7), "/");
    setcookie('username', $user, time() + (86400 * 7), "/");
    $row = mysqli_fetch_assoc($result);
    $row2 = mysqli_fetch_assoc($result2);
    setcookie('email', $row2['Email'], time() + (86400 * 7), "/");
    setcookie('customer_id', $row['CustomerID'], time() + (86400 * 7), "/");
    header("Location: dashboard.php");

} else {

    header("Location: login.php?error=Invalid user or pass");
    exit();
}
}


mysqli_close($conn);
?>

<div class="login">

<h1>Login</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
<h2>Username</h2> 

<input type =  "text" id ="username" name = "username" placeholder = "Enter Username...">


<h2>Password</h2> 
<input type =  "password" id ="password" name = "passkey" placeholder = "Enter Password...">
<input type = "submit" value = "Submit">

</form>

</div>

</body>
</html>