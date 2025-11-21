<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href = "style/home.css">
  <title>Car Rental Company</title>
</head>
<body>
<div class = "titlebar">
    <nav>
        <ul>
            <li class = "left"><a>For Sale</a></li>
            <li class = "left"><a>Maintanence</a></li>
            <li class = "left"><a>Help</a></li>
            <li class = "right"><a>Register</a></li>
        </ul>
    </nav>
</div>



<div class="login">

<h1>Login</h1>

        <?php
        if (isset($_GET['error'])) {
            echo '<p style="color:red;">' . $_GET['error'] . '</p>';
        }
        ?>

<form method="post" action="process_login.php"></form>
<h2>Username</h2> 

<input type =  "text" id ="username" placeholder = "Enter Username...">


<h2>Password</h2> 
<input type =  "text" id ="password" placeholder = "Enter Password...">
<input type = "submit" value = "Submit">

</form>

</div>

</body>
</html>