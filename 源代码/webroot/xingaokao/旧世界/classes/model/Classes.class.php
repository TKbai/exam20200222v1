<?php		  

class Classes{
  private $classId;
  private $className;
  private $major;
  private $direction;
 
public function __set($name,$value) {
	$this->$name = $value;
}

public function __get($name) {
	return isset($this->$name) ? $this->$name : null;
}
//public function setClassId($classId){
//  $this->classId = $classId;
//}
//
//public function getClassId(){
//  return $this->classId;
//}
//
//public function setClassName($className){
//  $this->className = $className;
//}
//
//public function getClassName(){
//  return $this->className;
//}
//public function setMajor($major){
//  $this->major = $major;
//}
//
//public function getMajor(){
//  return $this->major;
//}
//
//public function setDirection($direction){
//  $this->direction = $direction;
//}
//
//public function getDirection(){
//  return $this->direction;
//}
  
}