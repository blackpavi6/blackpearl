<?php
session_start();
echo"<h1>Welcome ";
if(!empty($_SESSION["username"]))
{
    echo $_SESSION["username"]." to Home</h1>";
    echo '<a href="logout.php">Signout</a>';
}else{
    echo   "to home </h1>";
    echo '<a href="signin.php">Signin</a>';

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
<form action="signin.php">
</form>
    
</body>
</html>