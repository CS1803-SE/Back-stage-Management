
<?php
include "../../application/config/config.php";
session_start();
$username = htmlspecialchars($_POST['username']);
$password =htmlspecialchars($_POST['password']);
$sql = "select * from user where AccountNumber='{$username}' and Password='{$password}' and Permission=1";
$result = mysqli_query($conn,$sql);
$ss=$result->fetch_row();
if($ss!=null){
   // echo "密码正确";
    $_SESSION["name"] = $username ;
    $_SESSION["pas"] = $password;
    header("Location:  ../../index.php");
}else{
    header("Location: ../../login.html");
   //echo "密码错误";
}








