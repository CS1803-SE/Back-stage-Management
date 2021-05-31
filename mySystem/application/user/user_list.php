<?php
include "../../application/config/config.php";


$page= $_POST['page'];
$limit= $_POST['limit'];
$row_start=($page-1)*$limit;
$count_res = $conn->query("SELECT * FROM user");
$count = mysqli_num_rows($count_res);
$res = $conn->query("SELECT * FROM user limit {$row_start},{$limit}");
$data = $res->fetch_all(MYSQLI_ASSOC);
/*

*/

foreach ($data as &$user){
    //把数据库中0 1 2所代表的转为中文
    if($user['Permission']==0){
        $user['Permission'] = '普通用户';
    }else if($user['Permission']==1){
        $user['Permission'] = '管理员';
    }else{
        $user['Permission'] = '超级管理员';
    }

    if($user['State']==0){
        $user['State'] = '正常';
    }else if($user['State']==1){
        $user['State'] = '禁言';
    }
}

$arr = [
    "code"=> 0, //code必须为0才会显示
    "msg"=>"测试获取数据成功",
    "count"=>$count,
    "data"=>$data
];

echo  json_encode($arr,true);exit;//把数组转为array发送回去
