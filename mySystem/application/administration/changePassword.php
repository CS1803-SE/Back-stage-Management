<?php
include "../../application/config/config.php";

$oldPs = $_POST['oldPassword'];
$ps = $_POST['password'];
$ps1 = $_POST['password1'];

if($ps === $ps1){

     $sql = "UPDATE `u606804608_MuseumSpider`.`adminstration` SET `password` = '$ps' WHERE `username` = '12'";
     mysqli_query($conn, $sql);
    echo json_encode(array('status' => 'success'));
}else{
    echo json_encode(array('status' => 'error'));
}
