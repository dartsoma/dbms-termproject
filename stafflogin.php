<?php 
if (isset($_COOKIE['is_staff']) && $_COOKIE['is_staff'] == 'yes') {
    header("Location: staff_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/home.css">
  <title>Staff Login</title>
</head>

<body>

<div class="titlebar">
    <nav>
        <ul>
            <li class = "left"><a href = "cars.php">For Sale</a></li>
            <li class = "left"><a href = "maintenance.php">Maintenance</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            

            <li class="right"><a href="stafflogin.php">Staff Login</a></li>
            <li class="right"><a href="login.php">Login</a></li>
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $branchID = $_POST['branchID'];
    $staffID = $_POST['staffID'];

    $sql = "SELECT EmployeeID, Name 
            FROM staff 
            WHERE EmployeeID = '$staffID' AND BranchID = '$branchID'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        setcookie('is_staff', 'yes', time() + (86400 * 7), "/");
        setcookie('staff_name', $row['Name'], time() + (86400 * 7), "/");
        setcookie('staff_id', $row['EmployeeID'], time() + (86400 * 7), "/");
        setcookie('branch_id', $branchID, time() + (86400 * 7), "/");

        header("Location: staff_dashboard.php");
        exit();

    } else {
        header("Location: stafflogin.php?error=Invalid Branch ID or Staff ID");
        exit();
    }
}

mysqli_close($conn);
?>

<div class="login">

<h1>Staff Login</h1>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;"><?php echo $_GET['error']; ?></p>
<?php endif; ?>

<form method="POST" action="">
    <h2>Branch ID</h2>
    <input type="text" name="branchID" placeholder="Enter Branch ID..." required>

    <h2>Employee ID</h2>
    <input type="password" name="staffID" placeholder="Enter Staff ID..." required>

    <input type="submit" value="Login">
</form>

</div>

</body>
</html>
