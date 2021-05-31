<?php
include "../../application/config/config.php";

$page= $_POST['page'];
$limit= $_POST['limit'];
$row_start=($page-1)*$limit;
$result = mysqli_query($conn,'SHOW TABLES FROM u606804608_MuseumSpider');

$dbs[] = null;
$count = 0;
while($db=$result->fetch_row()){
    $rel = array('tableName'=>$db[0]);
    $dbs[$count] = $rel;
    $count++;
}


$arr = [
    "code"=> 0, //code必须为0才会显示
    "msg"=>"测试获取数据成功",
    "count"=>$count,
    "data"=>$dbs
];

echo  json_encode($arr,true);exit;//把数组转为array发送回去
