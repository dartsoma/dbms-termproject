<?php 

if (
    (!isset($_COOKIE['is_logged_in']) || $_COOKIE['is_logged_in'] !== 'yes') &&
    (!isset($_COOKIE['is_staff']) || $_COOKIE['is_staff'] !== 'yes')
) {
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
// DB Connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalorg';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("<h1>Error connecting to database</h1>");
}


$sql = "SELECT CarID, Brand, Model, Category, ManufacturerYear, LicensePlateNumber, RentalStatus, BranchID FROM car WHERE RentalStatus = 'Available'";
$result = mysqli_query($conn, $sql);
?>


<div class="car">
<h1 style = "color: Black; font-weight: 800;" >Cars</h1>

<?php
while ($row = mysqli_fetch_assoc($result)) {

    echo '
    <div class="car-card" \>

        <h2>' . $row['Brand'] . ' ' . $row['Model'] . '</h2>

        <p><strong>Category:</strong> ' . $row['Category'] . '</p>
        <p><strong>Year:</strong> ' . $row['ManufacturerYear'] . '</p>
        <p><strong>Plate:</strong> ' . $row['LicensePlateNumber'] . '</p>
        <p><strong>Status:</strong> ' . $row['RentalStatus'] . '</p>
        <p><strong>Branch ID:</strong> ' . $row['BranchID'] . '</p>

        <form method="POST" action="">

            <input type="number" name ="daysRented" placeholder = "number of days" min = 0; required>
            <input type="hidden" name="carID" value="' . $row['CarID'] . '">
            <button class="rent-btn">Rent</button>
        </form>

    </div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $days = $_POST['daysRented'];
    $carId = $_POST['carID'];
    $startDate = date("Y-m-d");
    $newDate = date("Y-m-d", strtotime("$startDate + $days days"));
    $cusId = $_COOKIE['customer_id'];
    $cost = 150 * $days;

    $result = mysqli_query($conn, "SELECT MAX(RentalID) as rent_id FROM rentalAgreement");
    $row = mysqli_fetch_assoc($result);
    $next_id = $row['rent_id'] + 1;
    
    // just a base case
    if (!$next_id) {
        $next_id = 1001;
    }

    $sql = "INSERT INTO rentalAgreement (RentalID, CustomerID, CarID, StartDate, EndDate)
            VALUES ('$next_id', '$cusId', '$carId', '$startDate', '$newDate' )";

    

    setcookie("queryCon", $sql, time() + 600, "/");
    setcookie("paymentType", "car", time() + 600, "/");
    setcookie("service", "Renting", time() + 600, "/");
    setcookie("paymentCost", $cost, time() + 600, "/");
    setcookie("car_id", $carId, time() + 600, "/");

    header("Location: payment.php");
}

?>

</div>

<?php mysqli_close($conn); ?>

</body>
</html>