<?php
$host = "120.26.86.149";
$db_username = "root";
$db_password = "jk1803_SE";
$db_database = "u606804608_MuseumSpider";

$conn = new mysqli($host,$db_username,$db_password,$db_database);

if($conn->connect_errno){
    die("连接失败");
}
/*连接测试
$sql = "select * from Collection";
$museumData = mysqli_query($conn,$sql);
$wg = $museumData->fetch_row();
for ($i=0;$i<5;$i++){
    $wg = $museumData->fetch_row();
    echo $wg[2];
}*/

?>