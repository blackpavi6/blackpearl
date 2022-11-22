<?php
include "conn.php";
if(isset($_POST["signup"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $conpassword=$_POST["confirmpassword"];


    if(!empty($email) && !empty($username) && !empty($password) && !empty($conpassword)){

    if(strcmp($password,$conpassword)==0){
    
        if(strlen($password)<8){
            die("Password must be at least 8 charaters");
        }
        if(!preg_match("/[a-z]/i",$password) || !preg_match("/[0-9]/i",$password) ){
            die("Password must contain one lowercase & one number");
        }
        $password=md5($_POST["password"]);


        $query="select * from user where username='$username';";
        $statement=$conn->prepare($query);
        $statement->execute();
        $result=$statement->fetchAll();
        var_dump($result);

        if(count($result)>0){

            header("Location:index.php?er=1"); //display "username already exists."
        }
        else{

            $query="insert into user values('$username','$password','$email');";
            $statement=$conn->prepare($query);
            if($statement->execute()){
                header("Location: su_signup.html");
            }else{
                die("Error in Insert Exection");
            }


            $query="select * from user;";
            $statement=$conn->prepare($query);
            $statement->execute();
            $result=$statement->fetchAll();
            var_dump($result);
        }
    }
    else{
            echo "Wrong Password confirmation";
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
    <title>SignUp</title>
</head>
<body>
    <h1>Sign Up</h1>
    <form action="signup.php" method="post">
        
        <table>
            <tr>
                <td><input type="text" name="username" id="username" placeholder="Username"></td>
            </tr>
            <tr>
                <td><input type="email" name="email" placeholder="Email Address"></td>
            </tr>
            <tr>
                <td><input type="password" name="password" id="password" placeholder="Password"></td>
            </tr>
            <tr>
                <td><input type="password" name="confirmpassword" placeholder="Confirm Password"></td>
            </tr>
            <tr>
                <td><input type="submit" name="signup" value="Sign UP"></td>
            </tr>
        </table>

    </form>
    
</body>
</html>