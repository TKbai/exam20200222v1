<?php
require 'Studen.class.php';
$stu1 = new Student('张三');
$stu1->setName('张三');
echo $stu1->getName();
?>