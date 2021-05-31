<?php

$host = "120.26.86.149";
$db_username = "root";
$db_password = "jk1803_SE";
$db_database = "u606804608_MuseumSpider";
$db_table = "AdministratorLog";
$recoveryFileName = $_POST['fileName'];

date_default_timezone_set("Asia/Shanghai");
$filename=date("Y-m-d")."-".time();
$name="E:/dataBackup/second_bear".$filename.".sql";//数据库文件存储路径
$exec1="mysql -h".$host." -u".$db_username." -p".$db_password." -D".$db_database." < $recoveryFileName ";
$result=exec($exec1);

echo json_encode(array('status' => 'success'));
