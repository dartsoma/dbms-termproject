<?php 
if (!isset($_COOKIE['is_logged_in']) || $_COOKIE['is_logged_in'] !== 'yes') {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/home.css">
  <title>Maintenance</title>
</head>

<body>

<div class="titlebar">
    <nav>
        <ul>
            <li class="left"><a href="cars.php">For Sale</a></li>
            <li class="left"><a href="maintenance.php">Maintenance</a></li>
            <li class="left"><a href="help.php">Help</a></li>

            <li class="right"><a><?php echo $_COOKIE['username']; ?></a></li>
        </ul>
    </nav>
</div>

<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalorg';

$conn = mysqli_connect($host, $username, $password, $database);


$visibilityClass = 'cost-box-hidden';

if (!$conn) {
    die("<h1>Error connecting to database</h1>");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$cost = 0;

    $service = $_POST['service'] ?? '';
    $cost = match ($service) {
        'Repair' => 150,
        'Paint' => 50,
        'Wash'  => 25,
        default => 10,
    };

    if (isset($_POST['requestQoute'])) {
        setcookie("paymentCost", $cost, time() + 600, "/");
        $visibilityClass = "cost-box-visible";
    } else {
    
    $carID = $_POST['carID'];

    $today = date("Y-m-d");


    $result = mysqli_query($conn, "SELECT * FROM car WHERE CarID = $carID");


    if (mysqli_fetch_assoc($result) > 0){
    $result2 = mysqli_query($conn, "SELECT MAX(MaintenanceID) AS max_id FROM maintenanceRecord");
    $row = mysqli_fetch_assoc($result2);
    $nextID = $row['max_id'] + 1;

    if (!$nextID) {
        $nextID = 1;
    }


    $sql = "INSERT INTO maintenanceRecord (MaintenanceID, CarID, Date, Description, Cost)
            VALUES ('$nextID', '$carID', '$today', '$service', '$cost')";

    if (mysqli_query($conn, $sql)) {

        setcookie("service", $service, time() + 600, "/");
        setcookie("paymentCost", $cost, time() + 600, "/");
        setcookie("maintenance_id", $nextID, time() + 600, "/");

        header("Location: payment.php");
        exit();
    }
    }
    }
}

mysqli_close($conn);
?>

<div class="login">

<h1>Repair</h1>

<form method="POST" action="">

    <h2>Car</h2>
    <input type="text" name="carID" placeholder="Car Id..." required>

    <h2>Service</h2>
    <input type="text" id="serviceBox" name="service" placeholder="Enter Service Type..." required>

    <div class="<?php echo $visibilityClass;?>">
        Cost: <?php  echo $cost ?? ($_COOKIE['paymentCost'] ?? 0); ?>
    </div>

    <br><br>



    <input type="submit" value="Pay" style="width:150px;">
      <input type="submit" name= "requestQoute" value="Request Qoute" formnovalidate>

</form>
</div>


</body>
</html>