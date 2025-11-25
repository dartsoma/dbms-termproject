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
            <li class = "left"><a>Help</a></li>
            <li class = "right"><a>Register</a></li>
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


$sql = "SELECT CustomerID FROM account WHERE UserName = '$user' AND PassKey = '$pass'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    echo "Login successful! CustomerID: " . $row['CustomerID'];
    header("Location: process_login.php");

} else {

    header("Location: index.php?error=Invalid user or pass");
    exit();
}
}


mysqli_close($conn);
?>

<div class="login">

<h1>Login</h1>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h2>Username</h2> 

<input type =  "text" id ="username" name = "username" placeholder = "Enter Username...">


<h2>Password</h2> 
<input type =  "text" id ="password" name = "passkey" placeholder = "Enter Password...">
<input type = "submit" value = "Submit">

</form>

</div>

</body>
</html>