<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalOrg';

$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$user = $_POST['username'];
$pass = $_POST['passkey'];


$sql = "SELECT CustomerID FROM users WHERE UserName = '$user' AND PassKey = '$pass'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    echo "Login successful! CustomerID: " . $row['CustomerID'];

} else {

    header("Location: index.php?error=Invalid username or password");
    exit();
}


mysqli_close($conn);
?>