<?php

// basically just sets the variables from the database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalOrg';

$conn = mysqli_connect($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // gets information from form
    $new_username = $_POST['username'];
    $new_password = $_POST['passkey'];
    $new_name = $_POST['name'];
    $new_dob = $_POST['dob'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
    $new_address = $_POST['address'];
    
    // makes information request to database
    $result = mysqli_query($conn, "SELECT MAX(CustomerID) as max_id FROM customer");
    $row = mysqli_fetch_assoc($result);
    $nextID = $row['max_id'] + 1;
    

    
    // just a base case
    if (!$nextID) {
        $nextID = 1001;
    }

    // sets up the filler queries
    $sql = "INSERT INTO customer (CustomerID, CustomerName, DOB, PhoneNumber, Email, `Address`)
            VALUES ('$nextID', '$new_name', '$new_dob', '$new_phone', '$new_email', '$new_address' )";
    $sql2 = "INSERT INTO account (UserName, PassKey, CustomerID) 
            VALUES ('$new_username', '$new_password', '$nextID')";
    
    // checks if it works try and break something and it will tell you whats wrong
    if (mysqli_query($conn, $sql)) {
        if(mysqli_query($conn, $sql2)) {
        header("Location: login.php");
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
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
            
            <li class="right"><a href="stafflogin.php">Staff Login</a></li>
            <li class = "right"><a href = "login.php">Login</a></li>
        </ul>
    </nav>
</div>



<div class="register">
<!--  This is a form  -->
<h1>Register</h1>

<!-- The method makes sure a users content is recorded as a post, 
 and the action tells us where to look for php functionality,
 in our case blank means the same document so no redirecting first-->
<form method="POST" action = "" autocomplete="off">


<!-- The names allow me to grab the information from the input sections
 and the placeholders hint at the kind of information thats going to be placed
 in each input -->
<input type =  "text" name ="username" placeholder = "Enter Username...">
<input type =  "password" name ="passkey" placeholder = "Enter Password...">
<input type =  "text" name ="name" placeholder = "Enter Name...">
<input type =  "text" name ="email" placeholder = "Enter Email...">
<input type =  "text" name ="address" placeholder = "Enter Address...">
<input type="tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder = "###-###-####">
<input type="date" name="dob" min="1900-01-01" max="2025-12-01" >
<input type = "submit" value = "Register">
</form>

</div>

</body>
</html>