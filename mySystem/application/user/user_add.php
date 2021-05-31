<?php
include "../../application/config/config.php";
$identity = $_POST['identity'];
$userName = $_POST['userName'];
$nickName = $_POST['nickName'];
$password = $_POST['password'];
$loginName = $_POST['loginName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$remarks = $_POST['remarks'];
$role = $_POST['role'];
$state = $_POST['state'];

$numState = 0;
$numRole = 0;


if($role == 'common'){
    $numRole = 0;
}else if($role == 'admin'){
    $numRole = 1;
}else{
    $numRole = 2;
}

if($state === 'normal') {
    $numState = 0;
}else
{
    $numState = 1;
}

$sql = "INSERT INTO `user`
VALUES ('$nickName  ', '$identity', '$userName',$numRole,'$loginName','$password', '$phone', '$email',$numState)";


if ( mysqli_query($conn,$sql)) {
    echo json_encode(array('status'=>'success'));
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo json_encode(array('status'=>'error'));
}


