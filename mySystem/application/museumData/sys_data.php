<?php
include "../../application/config/config.php";
$page=$_POST['page'];
$limit=$_POST['limit'];
$row_start=($page-1)*$limit;
$res_sql = "select * from MuseumBasicInformation limit {$row_start},{$limit}";
$count_sql = "select * from MuseumBasicInformation";
$res = $conn->query($res_sql);
$data = $res->fetch_all(MYSQLI_ASSOC);

//$count_res = $conn->query($count_sql);
$count = 210;

$text = array("museumID"=>"","museumName"=>"","openingTime"=>"",
    "address"=>"","consultationTelephone"=>"","longitude"=>"","introduction"=>"",
    "latitude"=>"","publicityVideoLink"=>"");

$i = 0;

foreach ($data as $user){
    $text["museumID"] = $user["museumID"];
    $text["museumName"] = $user["museumName"];
    //$text["openingTime"] = str($user["openingTime"]);
   // echo $text["openingTime"] ;
    // $text["introduction"] = $user["introduction"];
    $text["address"] = $user["address"];
    $text["consultationTelephone"] = $user["consultationTelephone"];
    $text["publicityVideoLink"] = $user["publicityVideoLink"];
    $fuck[$i] = $text;
    $i = $i + 1;
}

function str($val1){
    $val1=str_replace('，',',',$val1);
    $val1=str_replace('（','(',$val1);
    $val1=str_replace('）',')',$val1);
    $val1=str_replace('；',';',$val1);
    $val1=str_replace('',' ',$val1);
    $val1=str_replace('。',' ',$val1);
    $val1=str_replace('‘','\'',$val1);
    $val1=str_replace('、',' ',$val1);
    $val1=str_replace('~',' ',$val1);
    $val1=str_replace('：',':',$val1);
    $val1=str_replace('—',' ',$val1);
    return $val1;
}

$arr = [
    "code"=> 0, //code必须为0才会显示
    "msg"=>"",
    "count"=>$count,
    "data"=>$fuck
];

echo  json_encode($arr,true);exit;//把数组转为array发送回去


