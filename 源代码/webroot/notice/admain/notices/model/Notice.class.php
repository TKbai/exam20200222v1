<?php
/**
 * 
 */
class Notice
{
	private $notice_id;//编号
	private $notice_name;//通知名称
	private $notice_time;//通知时间
	private $notice_web;//通知网站
	private $state;//删除标记：1表示未删除， 0表示删除
	
	public function __set($name,$value)
	{
		$this->$name = $value;
	}
	
	public function __get($name)
	{
		return isset($this->$name) ? $this->$name : null;
	}
}
