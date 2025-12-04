

<?php

//if ($_COOKIE['paying'] !== 'yes') {
//    header("Location: index.php");
//}



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
            <li class = "left"><a>Maintenance</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>

            <li class="right"><a href="stafflogin.php">Staff Login</a></li>
            <li class = "right"><a href = "login.php">Login</a></li>
        </ul>
    </nav>
</div>



<div class="payment">


<form method="POST" action = "" autocomplete="off">


<h1>Payment</h1>

<input type = "text" name ="username" placeholder = "Enter Username...">
<input type = "password" name ="passkey" placeholder = "Enter Password...">
<input type = "text" name ="name" placeholder = "Enter Name...">
<input type = "text" name ="email" placeholder = "Enter Email...">
<input type = "text" name ="address" placeholder = "Enter Address...">
<input type= "tel" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder = "###-###-####">
<input type= "date" name="dob" min="1900-01-01" max="2025-12-01" >
<input type = "submit" value = "Register">

</form>

</div>

</body>
</html>