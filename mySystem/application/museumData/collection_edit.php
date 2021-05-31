<?php
include "../../application/config/config.php";

$collectionID =  $_POST['collectionID'];
$museumID =  $_POST['museumID'];
$collectionIntroduction =  $_POST['collectionIntroduction'];
$collectionImageLink =  $_POST['collectionImageLink'];
$collectionName =  $_POST['collectionName'];
$museumName =  $_POST['museumName'];

$sql = "UPDATE `Collection` SET `museumID` = $museumID,
                        `collectionIntroduction` = '$collectionIntroduction',
                        `collectionImageLink` = '$collectionImageLink', 
                        `collectionName` = '$collectionName',
                        `museumName` = '$museumName' WHERE `collectionID` = $collectionID";


$result=mysqli_query($conn, $sql);
if($result==true)
echo json_encode(array('status' => 'success'));
else 
	echo json_encode(array('status' => 'failure'));