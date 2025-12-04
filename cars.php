<?php 
// Allow customers or staff to access the page
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
            <li class="left"><a href="cars.php">For Sale</a></li>
            <li class="left"><a href="#">Maintenance</a></li>
            <li class="left"><a href="help.php">Help</a></li>

            <?php 
            if (isset($_COOKIE['is_staff']) && $_COOKIE['is_staff'] === 'yes') {
                echo '<li class="right"><a>' . $_COOKIE['staff_name'] . '</a></li>';
            } else {
                echo '<li class="right"><a>' . $_COOKIE['username'] . '</a></li>';
            }
            ?>
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

// Query matches EXACT car table structure
$sql = "SELECT CarID, Brand, Model, Category, ManufacturerYear, LicensePlateNumber, RentalStatus, BranchID FROM car";
$result = mysqli_query($conn, $sql);
?>

<h1 class="center-title">Cars</h1>

<!-- Must style car-grid and car-card inside home.css -->
<div class="car-grid">

<?php
while ($row = mysqli_fetch_assoc($result)) {

    echo '
    <div class="car-card">

        <h2>' . $row['Brand'] . ' ' . $row['Model'] . '</h2>

        <p><strong>Category:</strong> ' . $row['Category'] . '</p>
        <p><strong>Year:</strong> ' . $row['ManufacturerYear'] . '</p>
        <p><strong>Plate:</strong> ' . $row['LicensePlateNumber'] . '</p>
        <p><strong>Status:</strong> ' . $row['RentalStatus'] . '</p>
        <p><strong>Branch ID:</strong> ' . $row['BranchID'] . '</p>

        <form method="GET" action="rentcar.php">
            <input type="hidden" name="carID" value="' . $row['CarID'] . '">
            <button class="rent-btn">Rent</button>
        </form>

    </div>';
}
?>

</div>

<?php mysqli_close($conn); ?>

</body>
</html>