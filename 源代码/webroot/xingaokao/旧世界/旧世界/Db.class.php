<?php
	
	require 'config.php';
	class Db {
		private $mysqli;
//		private static $instance;
		private $hostname = DB_HOST;//主机名
		private $username = DB_USER;//用户名
		private $password = DB_PASSWORD;//密码
		private $database = DB_DATABASE;//数据库名
		
		/**
		 * 待发代码
		 */
		public function __construct(){
			//创建连接
			$this->mysqli = new mysqli($this->hostname, $this->username, $this->password, $this->database);
			if($this->mysqli->connect_errno){
				die("连接失败：" . $this->mysqli->connect_error);
			}
			$this->mysqli->set_charset("utf8");
		}
		
		/*
		 *说明：关闭数据链接 
		 */
		public function __destruct() {
			$this->mysqli->close();
		}
		
		/*
		 * dql
		 */
		public function dql($sql) {
			$result = $this->mysqli->query($sql) or die('数据库操作失败！' . $mysqli->error);
			$arrayResult = array();
			while($row = $result->fetch_assoc()){
				$arrayResult[] = $row;
			}
			$result->free();
			return $arrayResult;
  		}
  			
		/*
		 * dml
		 */
		public function dml($sql) {
			$result=$this->mysqli->query($sql) or die("操作失败！".$this->mysqli->error);
			if(!$result){
				return 0;//表示操作失败
			}else{
				if($this->mysqli->affected_rows>0){
					return 1;//表示操作成功	
				}else{
					return 2;//表示没有行受到影响
				}
			}
		}
		
		/*
     * 方法名： dqlByPage($sql1,$sql2,$page)
     * 功　能：考虑分页的查询
     * 参　数：$sql1,$sql2,$page
     * $sql1 = "SELECT * FROM 表名 LIMIT offset,rows";
     * $sql2 = "SELECT COUNT(*) FROM 表名";
     * 返回值：无，实际是返回对象$page
     */
    public function dqlByPage($sql1,$sql2,$page){
        //1 获得存放结果集的数组
        $result = $this->mysqli->query($sql1) or die("数据库操作失败！".$this->mysqli->error);
        $array_result = array();
        while($row=$result->fetch_assoc()){
            $array_result[] = $row;
        }
        $result->free(); //释放结果集
        $page->setResult($array_result); //获得存放结果集的数组
        //2 获得总记录数、总页数
        $result = $this->mysqli->query($sql2) or die("数据库操作失败！".$this->mysqli->error);
        if($row = $result->fetch_row()){
            $page->setRecordCount($row[0]); //获得总记录数
            $page->setPageCount(ceil($page->getRecordCount()/$page->getPageSize())); //获得总页数
        }
        $result->free(); //释放结果集
        
        //3 获得分页导航字符串
        $gotoUrl = $page->getGotoUrl();
        $navigate = "<div id='navigate'>"; //这个变量初始化一下是非常必要的
        $navigate .= "<form method='get' action=" . $gotoUrl .">";
        if($page->getPageId() != 1){
            $navigate .= "<a href='" . $gotoUrl . "?pageId=1'>首页</a> &nbsp;";
        }else{
            $navigate .= "首页&nbsp;";
        }
        
        if($page->getPageId()>1){
            $prePage = $page->getPageId()-1;
            $navigate .= "<a href='" . $gotoUrl . "?pageId=" . $prePage . "'>上一页</a>&nbsp;";
        }else{
            $navigate .= "上一页&nbsp;";
        }
    
        if($page->getPageId()<$page->getPageCount()){
            $nextPage = $page->getPageId()+1;
            $navigate .= "<a href='" . $gotoUrl . "?pageId=" . $nextPage . "'>下一页</a>&nbsp;";
        }else{
            $navigate .= "下一页&nbsp;";
        }
        
        if($page->getPageId()!=$page->getPageCount()){
            $navigate .= "<a href='" . $gotoUrl . "?pageId=" . $page->getPageCount() . "'>尾页</a>&nbsp;";
        }else{
            $navigate .= "尾页&nbsp;";
        }
        
        $navigate .= "页次：<span style='color:red'>" . $page->getPageId() . "</span>/" . $page->getPageCount() . "页&nbsp;" . $page->getPageSize() . "条/页&nbsp;";
        $navigate .= "转到：";
        $navigate .= "<select name='pageId' onChange='this.form.submit()'>";
        for($i=1; $i<=$page->getPageCount(); $i++){
            $navigate .= "<option value='{$i}' ";
            if($i == $page->getPageId()){
                $navigate .= " selected";
            }
            $navigate .= ">第{$i}页</option>";
        }
        $navigate .= "</select>";
        $navigate .= "</form>";
        $navigate .= "</div>";
        $page->setNavigate($navigate);
    }
	}
?>