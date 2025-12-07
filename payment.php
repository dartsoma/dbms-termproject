

<?php

//if ($_COOKIE[''] !== 'yes') {
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
            <li class = "left"><a href = "maintenance.php">Maintenance</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>
            
            <li class="right"><a href = "stafflogin.php">Staff Login</a></li>
            <li class = "right"><a href = "login.php">Login</a></li>
        </ul>
    </nav>
</div>



<div class="payment">


<form method="POST" action = "" autocomplete="off">


<h1>Payment</h1>

<h2>Service: <?php echo $_COOKIE['service']; ?></h2>

<h2>Cost: <?php echo $_COOKIE['paymentCost']; ?></h2>




<input type="radio" name="paymentOptions" value="paypal" required>
  <label for="html">Paypal</label><br>
  <input type="radio" name="paymentOptions" value="credit">
  <label for="css">Credit Card</label><br>
  <input type="radio" name="paymentOptions" value="debit">
  <label for="javascript">Debit Card</label>
<input type = "submit" value = "Confirm Payment">
</form>

</div>

</body>
</html>