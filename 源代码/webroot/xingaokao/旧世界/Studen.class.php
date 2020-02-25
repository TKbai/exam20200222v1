<?php
/*
 * 文件名
 * 描述
 * 作者
 * 时间
 * 版权
 */
class Student {
	//属性
	private $name;//姓名
	private $gender;//性别
	
	/*
	 * 
	 */
	public function setName($name){
		$this->name = $name;
	}
	/*
	 * 获得姓名
	 */
	public function getName(){
		return $this->name;
	}
	
	public function __construct($name){
		$this->name = $name;
		echo '打开冰箱门：';
	}
//	
//	public function __destruct(){
//		echo '<br>', '关上冰箱门！';
//	}
}
?>