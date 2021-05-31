<?php
//设置时区
include "../../application/config/config.php";
$host = "120.26.86.149";
$db_username = "root";
$db_password = "jk1803_SE";
$db_database = "u606804608_MuseumSpider";
$db_table = $_POST['tableName'];

$path = "/backup/";
date_default_timezone_set("Asia/Shanghai");
$getTime=date("Y-m-d_h-i-s");
$fileName=$path .$getTime."$db_table".".sql";//数据库文件存储路径
$exec="mysqldump -h".$host." -u".$db_username." -p".$db_password." ".$db_database." ".$db_table." > ".$fileName;
$result=exec($exec);


$sql = "INSERT INTO `databaseBackupRecord`(`tableName`, `backupTime`, `fileName`, `filePath`) VALUES ('$db_table ', '$getTime', '$fileName', '$path' )";
mysqli_query($conn, $sql);

echo json_encode(array('status' => 'success'));
//前面要设置mysql执行文件的路径