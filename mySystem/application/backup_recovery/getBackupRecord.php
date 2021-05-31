<?php
include "../../application/config/config.php";
$page= $_POST['page'];
$limit= $_POST['limit'];
$row_start=($page-1)*$limit;
$count_res = $conn->query("SELECT backupTime FROM databaseBackupRecord ");
$count = mysqli_num_rows($count_res);

$res = $conn->query("SELECT * FROM databaseBackupRecord limit {$row_start},{$limit}");
$data = $res->fetch_all(MYSQLI_ASSOC);


$arr = [
    "code"=> 0, //code必须为0才会显示
    "msg"=>"测试获取数据成功",
    "count"=>$count,
    "data"=>$data
];

echo  json_encode($arr,true);exit;//把数组转为array发送回去