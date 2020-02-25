<?php

require_once('../model/ClassesModel.class.php');
$classesModel = new ClassesModel();
require_once('../model/Classes.class.php');
$classes = new Classes();
header('Content-type:text/html; charset=utf-8');
if(isset($_REQUEST['flag'])){//判断flag是否存在
	if($_REQUEST['flag']=='add'){
		$classes->classId = $_REQUEST['classId'];
		$classes->className = $_REQUEST['className'];
		$classes->major = $_REQUEST['major'];
		$classes->direction = $_REQUEST['direction'];
		$result = $classesModel->classesAdd($classes);
		if($result == 1){
			header('location:../view/classesList.php?flag=2');
			exit();
		}else{
			header('location:../view/classesList.php?flag=0');
			exit();
		}
	}
	
	/*
	 * 
	 */
	if($_REQUEST['flag'] == 'edit'){
		$classes->classId = $_REQUEST['classId'];
		$classes->className = $_REQUEST['className'];
		$classes->major = $_REQUEST['major'];
		$classes->direction = $_REQUEST['direction'];
		$result = $classesModel->classesEdit($classes);
		if($result == 1 or $result == 2){
			header('location:../view/classesList.php?flag=3');
			exit();
		}else{
			header('location:../view/classesEdit.php?flag=0&classId='.$_REQUEST['classId']);
			exit();
		}
	}
	
	/**
	 * 
	 */
	if($_REQUEST['flag']=='del'){
		$classId = $_REQUEST['classId'];
		$result = $classesModel->classesDel($classId);
		if($result==1){
		   if($result == 1){
			header('location:../view/classesList.php?flag=1');
			exit();
		}else{
			header('location:../view/classesList.php?flag=0');
			exit();
		}
	}
}
}