<?php
include "../../application/config/config.php";
$FileName = $_POST['fileName'];

if(file_exists($FileName)){
    $res = unlink($FileName);
    //删除文件
}

$query = "delete from databaseBackupRecord where fileName = '$FileName '";
mysqli_query($conn, $query);

echo json_encode(array('status' => 'success'));