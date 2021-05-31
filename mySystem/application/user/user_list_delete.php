<?php
include "../../application/config/config.php";
$ID = $_POST["AccountNumber"];

$query = "delete from user where AccountNumber = '$ID'";

$result=mysqli_query($conn,$query);
if($result==true)
echo json_encode(array('status'=>'success'));
else 
	echo json_encode(array('status'=>'failure'));
