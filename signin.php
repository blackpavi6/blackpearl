<?php
include "conn.php";
if(isset($_REQUEST["signin"])){
    $username=$_POST["username"];
    $password=md5($_POST["password"]);

    if(!empty($username) && !empty($password)){

        $query="select password from user where username='$username';";
        $statement=$conn->prepare($query);
        $statement->execute();
        $result=$statement->fetchColumn();
        var_dump($result);
        var_dump($password);
        if(count($result)>0){
            if(strcmp($password,$result)==0){
                session_start();
                $_SESSION["username"]=$_POST["username"];
                header("Location:home.php"); //directs to user account
            }
            else {
                header("Location:index.php?er=4"); //diplay "incorrect password"
            }

        }
        else
        {
            header("Location:index.php?er=3"); //display "user not found"
        }

    }
    else{
        echo "Please provide all the details!";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in page</title>
</head>
<body>
    <h1>Sign In Page</h1>
    <form action="signin.php" method="post">
        <table>
            <tr>
                <td><input type="text" name="username" id="username" placeholder="Username or Email Address"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" id="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="signin" id="signin" value="Sign in"></td>
            </tr>
        </table>

    </form>

    
</body>
</html>