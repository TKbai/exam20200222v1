<?php
require '../public/Db.class.php';
$db = new Db();
//$db->link();
//$db->close();
$sql = "SELECT university_name, major_name FROM exam_major LIMIT 10";
$result = $db->dql($sql);
echo '<pre>';
var_dump($result);//var_dump是什么意思
echo '<pre>';

//$sql = "UPDATE `exam_score` SET `score`='88.8'WHERE (`id`='3') ";
//$result = $db->dml($sql);
//if($result){
//	echo "执行成功！";
//}else{
//	echo "执行失败！";
//}

