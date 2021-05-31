<?php
include "../../application/config/config.php";

$id =  $_POST['id'];
$museum =  $_POST['museum'];
$title2 =  $_POST['title2'];
$author =  $_POST['author'];
$time =  $_POST['time'];
$content =  $_POST['content'];
$url =  $_POST['url'];
$emotions=  $_POST['emotions'];


$sql =  "UPDATE `newsall` SET `museum` = '$museum',
                                               `title2` = '$title2', 
                                               `author` = '$author',
                                               `time` = '$time',
                                               `content` = '$content', 
                                               `url` = '$url',
                                               `emotions` = $emotions
                                                WHERE `id` = $id";

$result=mysqli_query($conn, $sql);
if($result==true)
echo json_encode(array('status' => 'success'));
else 
	echo json_encode(array('status' => 'failure'));