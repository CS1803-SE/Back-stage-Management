<?php
include "../../application/config/config.php";

$museumID =  $_POST['museumID'];
$museumName =  $_POST['museumName'];
$address =  $_POST['address'];
$consultationTelephone =  $_POST['consultationTelephone'];
$publicityVideoLink =  $_POST['publicityVideoLink'];

$query = "UPDATE `MuseumBasicInformation` SET `museumName` = '$museumName',                               
                                    `address` = '$address',
                                    `consultationTelephone` = '$consultationTelephone', 
                                    `publicityVideoLink` = '$publicityVideoLink' WHERE `museumID` = $museumID ";
$result=mysqli_query($conn, $query);

if($result==true)
echo json_encode(array('status' => 'success'));
else 
	echo json_encode(array('status' => 'failure'));
/*
if(mysqli_affected_rows() > 0)
    echo json_encode(array('status' => 'success'));
else
    echo json_encode(array('status' => 'error'));*/


