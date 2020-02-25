<?php
/**
 * 文件名：Page.class.php
 * 描述：分页实体类
 * 作者：杨磊
 * 日期：2020年2月8日
 */
class Page {
	private $result; //用于存放当前页结果集的数组 
	private $pageId; //当前页码
	private $pageSize; //每页记录数 
	private $pageCount; //总页数 
	private $recordCount; //记录总数
	private $navigate; //分页导航，字符串类型
	private $gotoUrl; //表示把分页请求提交给哪个页面

	public function __set($name, $value)
	{
		$this->$name = $value;
	}

	public function __get($name)
	{
		return isset($this->$name) ? $this->$name : null;
	}

	// public function getResult()
	// {
	// 	return $this->result;
	// }

	// public function getPageId()
	// {
	// 	return $this->pageId;
	// }

	// public function getPageSize()
	// {
	// 	return $this->pageSize;
	// }

	// public function getPageCount()
	// {
	// 	return $this->pageCount;
	// }

	// public function getRecordCount()
	// {
	// 	return $this->recordCount;
	// }

	// public function getNavigate()
	// {
	// 	return $this->navigate;
	// }

	// public function getGotoUrl()
	// {
	// 	return $this->gotoUrl;
	// }

	// public function setResult($result)
	// {
	// 	$this->result = $result;
	// }

	// public function setPageId($pageId)
	// {
	// 	$this->pageId = $pageId;
	// }

	// public function setPageSize($pageSize)
	// {
	// 	$this->pageSize = $pageSize;
	// }

	// public function setPageCount($pageCount)
	// {
	// 	$this->pageCount = $pageCount;
	// }

	// public function setRecordCount($recordCount)
	// {
	// 	$this->recordCount = $recordCount;
	// }

	// public function setNavigate($navigate)
	// {
	// 	$this->navigate = $navigate;
	// }
	// public function setGotoUrl($gotoUrl)
	// {
	// 	$this->gotoUrl = $gotoUrl;
	// }
}

/**
 * PHP文件必须使用Unix风格的换行符
 * 每行代码不应该超过80个字符
 * 每行末尾不能有空格
 * 每行只能有一条语句
 * 可以在适当的地方添加空行提高代码的阅读性
 * 最后要有一个空行，仅包含PHP代码的文件而且不能使用PHP关闭标签?>
 * 不加上?>关闭标签，可以避免意料之外的输出错误
 * 如果加上关闭标签，且在关闭标签后有空行，那么空行会被当成输出，导致意想不到的错误。
 */
