<?php		  
/**
 * 文件名:
 * 描述：
 * 作者：
 * 时间：
 * 版权：济南洋洋信息技术有限公司
 * 版本号：
 */
require_once('../../public/Db.class.php');
//require_once('Classes.class.php');
class ClassesModel{
	/**
	 *函数名：
	 *功能：
	 *参数：
	 *返回值:
	 */
	public function getClasses(){
		$db = new Db();
		$sql = "SELECT * FROM t_class ";
		$arrayClasses = $db->dql($sql);
//		$db->close();
		return $arrayClasses;
		}	/**
	 *函数名：
	 *功能：
	 *参数：
	 *返回值:
	 */
	public function getClassesByClassId($classId){
		$db = new Db();
		$sql = "SELECT * FROM t_class WHERE classId='$classId'";
		$arrayClasses = $db->dql($sql);
//		$db->close();
		return $arrayClasses;
	    }	
	/* *函数名：
	 *功能：
	 *参数：
	 *返回值:
	 */
	public function classesAdd($classes){
//		$classes = new Classes();
		$db = new Db();
		$classId = $classes->classId;
		$className = $classes->className;
		$major = $classes->major;
		$direction = $classes->direction;
		$sql = "INSERT INTO t_class (classId,className,major,direction) VALUES ($classId,'$className','$major','$direction')";
		$result= $db->dml($sql);
//		$db->close();
		return $result;
	}
	/**
	 *函数名：
	 *功能：
	 *参数：
	 *返回值:
	 */
	public function classesEdit($classes){
//		$classes = new Classes();
		$db = new Db();
		$classId = $classes->classId;
		$className = $classes->className;
		$major = $classes->major;
		$direction = $classes->direction;
		$sql = "UPDATE t_class SET className = '$className',major = '$major',direction = '$direction'		 
		WHERE classId = '$classId'";
 		$result = $db->dml($sql);
//		$db->close();
		 return $result;
	}
	/**
	 *函数名：
	 *功能：
	 *参数：
	 *返回值:
	 */
	public function classesDel($classId){
//		$classes = new Classes();
		$db = new Db();
		$sql = "DELETE  FROM `t_class`  WHERE (`classId`=$classId)";
		$result = $db->dml($sql);
		return $result;
	}
	
	/*
	 * 函数名：getClassByPage
	 * 功能：分页查询班级
	 * 参数：$page
	 * 返回值:
	 */
	public function getClassByPage($page){
		$db = new Db();
		$start = ($page->getPageId()-1)*($page->getPageSize());
		$pageSize = $page->getPageSize();
		$sql1 = "SELECT * FROM t_class ORDER BY classId LIMIT $start,$pageSize";
		$sql2 = "SELECT COUNT(*) FROM t_class";
		$db->dqlByPage($sql1,$sql2,$page);
	}
}