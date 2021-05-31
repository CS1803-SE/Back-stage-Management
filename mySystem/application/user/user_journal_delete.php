<?php

include "../../application/config/config.php";
$Time = $_POST['Time'];

$query = "delete from AdministratorLog where Time = '$Time'";
mysqli_query($conn, $query);

echo json_encode(array('status' => 'success'));





