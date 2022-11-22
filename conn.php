<?php

$server="localhost:3306";
$user="root";
$password="UOKsp015@2019";
$database="web";

try{
$conn= new PDO("mysql:host=$server;dbname=$database;charset=UTF8",$user,$password);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){

die("Error in connection");
}

?>
