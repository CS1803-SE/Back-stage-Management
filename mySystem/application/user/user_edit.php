<?php
include "../../application/config/config.php";

$AccountNumber =  $_POST['AccountNumber'];
$NickName =  $_POST['NickName'];
$IDNumber =  $_POST['IDNumber'];
$Name =  $_POST['Name'];
$Permissionstr =  $_POST['Permission'];
$Permission=$Permissionstr=='管理员'? 1:0;
$PhoneNumber=$_POST['PhoneNumber'];
$E_mail=$_POST['E_mail'];
$Statestr=$_POST['State'];
$State= $Statestr=='正常'?0:1;
$query = "UPDATE `user` SET `Name` ='$Name',
`PhoneNumber`='$PhoneNumber',
`State`=$State,
`E_mail`='$E_mail',
`NickName` = '$NickName',
`IDNumber` = '$IDNumber',
`Permission` = $Permission  WHERE `AccountNumber` =$AccountNumber";
$result=mysqli_query($conn, $query);
if($result==true)
echo json_encode(array('status' => 'success'));
else 
	echo json_encode(array('status' => 'failure'));