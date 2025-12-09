<?php 
// You cannot access the dashboard unless you are logged in
// we will check first if you want to sign out which 
// will take you off the dashboard immediately
// and invalidate previous cookies

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalorg';

$conn = mysqli_connect($host, $username, $password, $database);

if(!isset($_COOKIE['dashboardMessage'])){

$_COOKIE['dashboardMessage'] = '';

}

if($_SERVER["REQUEST_METHOD"] == "POST"){

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach ($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time() - 3600);
        setcookie($name, '', time() - 3600, '/');
    }
}
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
            
            <li class = "right"><a href = "dashboard"><?php echo $_COOKIE['username']; ?></a></li>
        </ul>
    </nav>
</div>


<div class="login">

<h1><?php echo $_COOKIE['dashboardMessage']; ?></h1>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/home.css">
  <title>Cars</title>
</head>

<body>

<div class="titlebar">
    <nav>
        <ul>
            <li class = "left"><a href = "cars.php">For Sale</a></li>
            <li class = "left"><a href = "maintenance.php">Maintenance</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            

            <li class = "right"><a href = "dashboard.php"><?php echo $_COOKIE['username']; ?></a></li>
        </ul>
    </nav>
</div>

<?php

if (!$conn) {
    die("<h1>Error connecting to database</h1>");
}

?>


<div class="car">
<h1 style = "color: Black; font-weight: 800;" >Cars Rented</h1>

<?php

$today = date("Y-m-d");
$cusID = $_COOKIE['customer_id'];
$sql = "SELECT CarID, Brand, Model, Category, ManufacturerYear, LicensePlateNumber, RentalStatus, BranchID FROM car AS C WHERE EXISTS(SELECT * FROM RentalAgreement AS R WHERE C.CarID = R.CarID AND R.CustomerID = $cusID AND $today < R.EndDate)";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result)) {

    echo '
    <div class="car-card"\>

        <h2 style = "color: white;">' . $row['Brand'] . ' ' . $row['Model'] . '</h2>

        <p><strong>Category:</strong> ' . $row['Category'] . '</p>
        <p><strong>Year:</strong> ' . $row['ManufacturerYear'] . '</p>
        <p><strong>Plate:</strong> ' . $row['LicensePlateNumber'] . '</p>
        <p><strong>Status:</strong> ' . $row['RentalStatus'] . '</p>
        <p><strong>Branch ID:</strong> ' . $row['BranchID'] . '</p>
    </div>';
}


?>

<form method = "POST" action ="">
<input type = "submit" value = "Sign Out">
</form>
</div>

</body>
</html>