<?php 
/** 
* @ClassName:Db
* @Description:Db类
* @Author 杨磊 
* @Version 3.0 
* @Date 2020年2月8日
*/ 
require_once 'config.php';
//当html语句中有
//<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
//则不必加下面这句
header('Content-type: text/html; charset=UTF-8');
class Db
{
    //单例模式调用
    private static $instance; //这是Db的对象实例
    private $mysqli; //这是mysqli的对象实例
    private static $hostname = HOSTNAME; //主机名
    private static $username = USERNAME; //用户名
    private static $password = PASSWORD; //密码
    private static $database = DATABASE; //数据库名
    	
	/*
     * 方法名：__construte()
     * 功  能：构造函数，用于建立数据库连接
     * 参  数：无
     * 返回值：无
     */
    private function __construct()
    {
        //连接数据库
        $this->mysqli = @new mysqli(self::$hostname, self::$username, self::$password, self::$database) or die('数据库连接失败！');
        // if ($this->mysqli->connect_errno) 
        // {
        //     die('数据库连接失败！' . $this->mysqli->connect_error);
        // }
        $this->mysqli->set_charset('utf8');
        // $this->mysqli->query('SET NAMES utf8');
    }
	
    /*
     * 方法名：__destruct()
     * 功  能：析构函数，用于关闭数据库连接
     * 参  数：无
     * 返回值：无
     */
    public function __destruct()
    {
        //关闭数据库连接
        if ($this->mysqli) {
            @$this->mysqli->close();
        }
    }
	
    /**
     * 获得单例对象的公共接口方法
     * @return object 单例的对象
     */
    public static function getInstance()
    {
        //判断是否实例化过
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }
        //返回对象
        return self::$instance;
    }

    //私有克隆
    private function __clone() {}

	/*
     * 方法名：dql($sql)
     * 功  能：执行sql查询
     * 参  数：$sql，查询语句
     * 返回值：$arrayResult存放查询结果集的二维数组
     */
	public function dql($sql)
	{
		$result = $this->mysqli->query($sql) 
                  or die('数据库操作失败！' . $this->mysqli->error);
		$arrayResult = array();
		while ($row = $result->fetch_assoc()) {
			// $arrayResult[] = $row;//注意这里不要少了[]
            array_push($arrayResult, $row);
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
	public function dml($sql)
	{
		$result = $this->mysqli->query($sql) 
                  or die('数据库操作失败！' . $this->mysqli->error);
		if (!$result) {
			return 0;//表示操作失败
		} else {
			if ($this->mysqli->affected_rows > 0) {
				return 1;//表示操作成功	
			} else {
				return 2;//表示没有行受到影响
			}
		}
	}
    
	/*
     * 方法名：dqlByPage($sql1, $sql2, $page)
     * 功　能：分页查询
     * 参　数：$sql1, $sql2, $page
     * $sql1 = "SELECT * FROM 表名 LIMIT offset, rows";
     * $sql2 = "SELECT COUNT(*) FROM 表名";
     * 返回值：无，实际是返回对象$page
     */
    public function dqlByPage($sql1, $sql2, $page)
    {
        //1 获得存放结果集的数组
        $result = $this->mysqli->query($sql1) or die('数据库操作失败！');
        $arrayResult = array();
        while ($row = $result->fetch_assoc()) {
            array_push($arrayResult, $row);
        }
        $result->free(); //释放结果集
        $page->result = $arrayResult; //获得存放结果集的数组

        //2 获得总记录数、总页数
        $result = $this->mysqli->query($sql2) or die('数据库操作失败！');
        if ($row = $result->fetch_row()) {
            //2.1 获得总记录数
            $page->recordCount = $row[0];
            //2.2 获得总页数
            $page->pageCount = ceil($page->recordCount / $page->pageSize);
        } 
        $result->free(); //释放结果集

        //3 获得分页导航字符串
        $gotoUrl = $page->gotoUrl;
        //这个变量初始化一下是非常必要的
        $navigate = "<div id='navigate'>"; 
        $navigate .= "<form method='get' action=" . $gotoUrl .">";
        //1、首页
        if ($page->pageId != 1) {
            $navigate .= "<a href='" . $gotoUrl . "&pageId=1'>首页</a> &nbsp;";
        } else {
            $navigate .= "首页&nbsp;";
        }
        //2、上一页
        if ($page->pageId>1) {
            $prePage = $page->pageId-1;
            $navigate .= "<a href='" . $gotoUrl . "&pageId=" . $prePage . "'>上一页</a>&nbsp;";
        } else {
            $navigate .= "上一页&nbsp;";
        }
        //3、下一页
        if ($page->pageId<$page->pageCount) {
            $nextPage = $page->pageId+1;
            $navigate .= "<a href='" . $gotoUrl . "&pageId=" . $nextPage . "'>下一页</a>&nbsp;";
        } else {
            $navigate .= "下一页&nbsp;";
        }
        //4、尾页
        if ($page->pageId!=$page->pageCount) {
            $navigate .= "<a href='" . $gotoUrl . "&pageId=" . $page->pageCount . "'>尾页</a>&nbsp;";
        } else {
            $navigate .= "尾页&nbsp;";
        }
        //5、页次：第*页 | 共*页 转到：第*页
        $navigate .= "第" . $page->pageId . "页&nbsp;|&nbsp;";
        $navigate .= "共" . $page->pageCount . "页&nbsp;";
        $navigate .= "转到：";
        // $navigate .= "<select name='pageId' onChange='this.form.submit()'>";
        $navigate .= "<select name='pageId' id='pageId' " . 
"onChange=\"pageId1 = document.getElementById('pageId').value;
            window.location.href='" . $gotoUrl
            . "&pageId=' + pageId1;\""
         . ">";
        for ($i=1; $i<=$page->pageCount; $i++) {
            $navigate .= "<option value='{$i}' ";
            if ($i == $page->pageId) {
                $navigate .= " selected";
            }
            $navigate .= ">第{$i}页</option>";
        }
        $navigate .= "</select>";
        $navigate .= "</form>";
        $navigate .= "</div>";
        $page->navigate = $navigate;
    }
}
