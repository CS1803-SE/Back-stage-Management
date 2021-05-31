<?php
include "../../application/config/config.php";
$page= $_POST['page'];
$limit= $_POST['limit'];
$row_start=($page-1)*$limit;
$res_sql = "select * from AdministratorLog limit {$row_start},{$limit}";
$count_sql = "select * from AdministratorLog";
$count_res = $conn->query($count_sql);
$count = mysqli_num_rows($count_res);

$res = $conn->query($res_sql);
$data = $res->fetch_all(MYSQLI_ASSOC);

/*
$time_str = date('Y-m-d H:i:s', $museumData[0]['Time']);
echo var_dump($museumData[0]['Time']) ;*/

$arr = [
    "code"=> 0, //code必须为0才会显示
    "msg"=>"测试获取数据成功",
    "count"=>$count,
    "data"=>$data
];

echo  json_encode($arr,true);exit;//把数组转为array发送回去