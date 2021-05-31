<?php
include "../../application/config/config.php";
$ID = $_POST['collectionID'];

$query = "delete from `Collection` where collectionID = $ID";
$result=mysqli_query($conn,$query);
if($result==true)
echo json_encode(array('status'=>'success'));
else 
	echo json_encode(array('status'=>'failure'));
