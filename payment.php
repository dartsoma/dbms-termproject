

<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalorg';

$conn = mysqli_connect($host, $username, $password, $database);

if (!isset($_COOKIE['paymentCost']) || $_COOKIE['is_logged_in'] !='yes') {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "style/home.css"<?php echo time(); ?>>
  <title>Car Rental Company</title>
</head>
<body>
<div class = "titlebar">
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


if ($_SERVER["REQUEST_METHOD"] == "POST"){

if($_COOKIE["paymentType"]=='car'){
  $carId = $_COOKIE["car_id"];

  $sql = "SELECT CarID FROM car as c WHERE c.CarID = $carId";
  $result = mysqli_query($conn, $sql);
  if(mysqli_num_rows($result)>0){
    $sql = "UPDATE car
            SET car.RentalStatus = 'Bought'
            WHERE car.CarID=$carId";
    mysqli_query($conn, $sql);  

  }

}

mysqli_query($conn, $_COOKIE["queryCon"]);
setcookie('queryCon', '', time() - 600, "/");
setcookie('service', '', time() - 600, "/");
setcookie('paymentCost', '', time() - 600, "/");
setcookie('paymentType', '', time() - 600, "/");
setcookie("dashboardMessage", "Invoice Sent", time() + 5, "/");
header("Location:dashboard.php?=invoiceSent");
}

?>


<div class="payment">
<form method="POST" action = "" autocomplete="off">


<h1>Payment</h1>

<h2>Service: <?php echo $_COOKIE['service']; ?></h2>

<h2>Cost: <?php echo $_COOKIE['paymentCost']; ?></h2>
<br>

<input type="radio" name="paymentOptions" value="paypal" required>
  <label for="p">Paypal</label><br>
  <input type="radio" name="paymentOptions" value="credit">
  <label for="c">Credit Card</label><br>
  <input type="radio" name="paymentOptions" value="debit">
  <label for="d">Debit Card</label>
<input type = "submit" value = "Confirm Payment">
</form>
</div>


</body>
</html>