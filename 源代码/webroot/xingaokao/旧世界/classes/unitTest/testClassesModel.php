<?php
require __DIR__ . '/../model/ClassesModel.class.php';
$classesModel = new ClassesModel();
require __DIR__ . '/../model/Classes.class.php';
$classes = new Classes();
//$result = $classesModel->classesDel(444);
//echo $result;
require __DIR__ . '/../util/Page.class.php';
$page = new Page();
$page->setPageId(1);
$page->setPageSize(1);
$page->setGotoUrl("/../view/classesList.php");
$classesModel->getClassByPage($page);
echo '<pre>';
var_dump($page->getResult());
echo '</pre>';