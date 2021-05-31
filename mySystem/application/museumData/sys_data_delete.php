<?php

include "../../application/config/config.php";
$ID = $_POST["museumID"];

$query = "delete from MuseumBasicInformation where museumID = '$ID'";
$res=mysqli_query($conn, $query);
if($res==true)
echo json_encode(array('status'=>'success'));
else 
	echo json_encode(array('status'=>'failure'));

