<?php
include "../../application/config/config.php";

$Name = $_POST['Name'];
$Log = $_POST['Log'];

$sql = "INSERT INTO `AdministratorLog`(Name,Log)
VALUES ('$Name','$Log')";

if ( mysqli_query($conn,$sql)) {
    echo json_encode(array('status'=>'success'));
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo json_encode(array('status'=>'error'));
}