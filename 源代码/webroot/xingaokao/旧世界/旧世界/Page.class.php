<?php
/*
* 文件名：Page.class.php
*  描    述：分页实体类
*/
class Page{
	private $result; //用于存放当前页结果集的数组 
	private $pageId; //当前页码
	private $pageSize; //每页记录数 
	private $pageCount; //总页数 
	private $recordCount; //记录总数
	private $navigate; //分页导航，字符串类型
	private $gotoUrl; //表示把分页请求提交给哪个页面

	public function getResult()
	{
		return $this->result;
	}

	public function getPageId()
	{
		return $this->pageId;
	}

	public function getPageSize()
	{
		return $this->pageSize;
	}

	public function getPageCount()
	{
		return $this->pageCount;
	}

	public function getRecordCount()
	{
		return $this->recordCount;
	}

	public function getNavigate()
	{
		return $this->navigate;
	}

	public function getGotoUrl()
	{
		return $this->gotoUrl;
	}

	public function setResult($result)
	{
		$this->result = $result;
	}

	public function setPageId($pageId)
	{
		$this->pageId = $pageId;
	}

	public function setPageSize($pageSize)
	{
		$this->pageSize = $pageSize;
	}

	public function setPageCount($pageCount)
	{
		$this->pageCount = $pageCount;
	}

	public function setRecordCount($recordCount)
	{
		$this->recordCount = $recordCount;
	}

	public function setNavigate($navigate)
	{
		$this->navigate = $navigate;
	}
	public function setGotoUrl($gotoUrl)
	{
		$this->gotoUrl = $gotoUrl;
	}
}

