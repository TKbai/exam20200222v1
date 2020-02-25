<?php 
/*
 * 文件名：Db.class.php
 * 描  述：数据库操作工具类
 * 作  者：杨磊
 * 时  间：2017年5月20日
 * 版  权：济南洋洋信息技术有限公司
 */
require_once 'config.php';
//header("Content-type:text/html;charset=utf-8");
class Db{
	private $mysqli;
    private static $instance;
	private static $hostname = DB_HOSTNAME;
    private static $username = DB_USERNAME;
    private static $password = DB_PASSWORD;
    private static $database = DB_DATABASE;
    /*
     * 方法名：__construte()
     * 功  能：构造函数，用于建立数据库连接
     * 参  数：无
     * 返回值：无
     */ 
    private function __construct(){
        //完成初始化任务
        $this->mysqli=@new MySQLi(self::$hostname,self::$username,self::$password,self::$database);
        if($this->mysqli->connect_error){
            die("数据库连接失败！".$this->mysqli->connect_error);   
        }
        //设置访问数据库的字符集
        $this->mysqli->query("SET NAMES UTF8");
    }
	/*
     * 获得单例对象的公共接口方法
     * @param  array  $params 数据库连接信息
     * @return object       单例的对象
     * 静态成员方法：
     */
    public static function getInstance()
    {
        //判断是否被实例化过
        if (!self::$instance instanceof self)
        {
            //实例化并保存
            self::$instance = new self();
        }
        //返回对象
        return self::$instance;
    }

    /**
     * 禁止实例被克隆 私有化克隆魔术方法
     */
    private function __clone() 
    { 

    }
	
	
	/*
     * 方法名：close()
     * 功  能：关闭数据库连接
     * 参  数：无
     * 返回值：无
     */
	public function close(){
		//是否需要有连接是否存在的判断？
		$this->mysqli->close();	
	}
	
	/*
     * 方法名：dql($sql)
     * 功  能：执行sql查询
     * 参  数：$sql，查询语句
     * 返回值：$arrayResult存放查询结果集的二维数组
     */
	public function dql($sql){
		$result=$this->mysqli->query($sql) or die("数据库操作失败！".$this->mysqli->error);
		$arrayResult = array();
		while($row=$result->fetch_assoc()){
			$arrayResult[] = $row;//注意这里不要少了[]
		}
		$result->free();//释放资源
		return $arrayResult;
	}
	
	/*
     * 方法名：dml($sql)
     * 功  能：数据操纵
     * 参  数：$sql
     * 返回值：$result 0：表示失败；1：表示成功；2：受影响的行数为0
     */
	public function dml($sql){
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
     * 方法名： execute_dql_page($sql1,$sql2,$page)
     * 功　能：考虑分页的查询
     * 参　数：$sql1,$sql2,$page
     * $sql1 = "SELECT * FROM 表名 LIMIT offset,rows";
     * $sql2 = "SELECT COUNT(*) FROM 表名";
     * 返回值：无，实际是返回对象$page
     */
    public function execute_dql_page($sql1,$sql2,$page){
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