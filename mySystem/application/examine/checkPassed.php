<?php
include "../../application/config/config.php";

$state = $_POST['state'];
$VideoName = $_POST['VideoName'];

$query = "UPDATE `UnderView` SET `State` =' $state' WHERE `VideoName` = '$VideoName'";
mysqli_query($conn, $query);

echo json_encode(array('status' => 'success'));
