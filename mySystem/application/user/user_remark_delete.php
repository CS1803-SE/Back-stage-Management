<?php
include "../../application/config/config.php";
$remarkID = $_POST['remarkID'];

$query = "delete from `userdianping` where remarkID = $remarkID";
$result=mysqli_query($conn,$query);
if($result==true)
echo json_encode(array('status'=>'success'));
else 
	echo json_encode(array('status'=>'failure'));
