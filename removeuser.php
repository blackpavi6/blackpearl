<?php
echo "<h1>Remove User</h1>";
include "conn.php";

/*
$sql = "delete form user where username=$username";
*/

if(isset($_REQUEST["removeuser"])){
    $name = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $password = md5($password);           //encrypting password using md5 algorithm
        
    $sql = "SELECT PASSWORD from user WHERE username='$name'";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $result =$stmt->fetchColumn();

    if($stmt->rowCount() > 0){    //checks whether username exists


        //checks whether password is correct
        if(strcmp($password,$result)==0){
            $sql = "DELETE FROM user WHERE username='$name'";
            $stmt=$conn->prepare($sql);
            if($stmt->execute()){
                echo "User removed successfully";
                header("Location:logout.php");
            }    
            
        }
        else {
            header("Location:index.php?er=4"); //diplay "incorrect password"
        }
                
    }
    else{
        header("Location:index.php?er=2"); //display "username does not exists."
    
    }

}
?>





<html>
    <table>
        <form action="removeuser.php">
            <tr>
                <th><label for="user">Username:</label></th>
                <td><input type="text" name="username" id="username"><br><br></td>
            </tr>
            <tr>
                <th><label for="password">Password:</label></th>
                <td><input type="password" name="password" id="password"><br><br></td>
            </tr>
            <tr>
            <td><input type="submit" name="removeuser" value="Remove User"></td>
            </tr>
        </form>
    </table>
</html>