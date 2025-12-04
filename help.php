
<?php

if ($_COOKIE['is_logged_in'] !== 'yes') {
    header("Location: login.php");
}

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rentalOrg';

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn){

    echo '<h1>'. "Error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "style/home.css">
    <title>Document</title>
</head>
<body>
    
<div class = "titlebar">
    <nav>
        <ul>
            <li class = "left"><a href = "cars.php">For Sale</a></li>
            <li class = "left"><a>Maintanence</a></li>
            <li class = "left"><a href = "help.php">Help</a></li>

            
            <li class="right"><a href="stafflogin.php">Staff Login</a></li>
            <li class = "right"><a><?php echo $_COOKIE['username'];?></a></li>
        </ul>
    </nav>
</div>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){


    $to = "chadsomaf@gmail.com";
    $subject = $_POST['subject'];
    $message = $_POST['feedback'];
    $headers = "From: " . $_COOKIE['email'] . "\r\n";
    $headers .=  "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Email sending failed.";
}

}


?>




<div class = register>
<h1>Help</h1>

<form method = "POST" action = "">
<h2>Name</h2>
<input type = text name = "name" placeholder= "Name">
<h2>Subject</h2>
<input type = text name = "subject" placeholder= "Subject">
<h2>Inquiry</h2>
<textarea id = "feedback" name = "feedback" placeholder="Enter your feedback here"></textarea>
<input type = submit name = "Submit">

</form>  
</div>

</body>
</html>