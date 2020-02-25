<?php 
	require_once __DIR__ . '/../model/ClassesModel.class.php';
//	$classesModel = new ClassesModel();
//	$arrayClasses = $classesModel->getClasses();
	require_once('../util/Page.class.php');
	$page = new Page();
	$page->setPageSize(3);
	if(empty($_GET['pageId'])){
		$page->setPageId(1);
	}else{
		$page->setPageId($_GET['pageId']);
	}
	$page->setGotoUrl("classesList.php");
	$classesModel = new ClassesModel();
	$classesModel->getClassByPage($page);
	$arrayClasses = $page->getResult();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
<title>班级信息管理</title>
<link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css">
<style type="text/css">
th,td{
    border:solid 1px #999;
    padding: 2px;  
    text-align: center;
}
tr a{
  color: black;
    text-decoration: none;
}
tr a:hover{
    color: red;
}

tr{
    height: 50px;
}
/*a{
    text-decoration: none; 
    color: black;
}*/
.btu{
    font-size:16px; 
    height:2em; 
    border-radius: 2px;
}
</style>
</head>
<body>
	<div id="main" >
          <a href="classesAdd.php">
                    <i class="fa fa-plus" style="font-size: 1em;">添加班级</i>
          </a>
        <table align="center" >
          <tr>
                <th style="width: 100px;">班级编号</th>
                <th style="width: 100px;">班级名称</th>
                <th style="width: 100px;">专业名称</th>
                <th style="width: 100px;">研究方向</th>
                <th style="width: 200px;">
                操作
                </th>
            </tr>
            <?php
			       foreach($arrayClasses as $value){
			       ?>
            <tr>
                <td>
                   <?php echo $value['classId'];?>
                </td>
                <td>
                 <?php echo $value['className'];?>
                </td>
                 <td>
                  <?php echo $value['major'];?>
                </td>
                 <td>
                    <?php echo $value['direction'];?>
                </td>
              
                <td>
                   <a href="classesEdit.php?classId=<?php echo $value['classId']; ?>">
                     <i class="fa fa-edit" style="font-size:1em;">                  	
                     </i>修改
                     </a>
                    <a href="../controller/classesController.php?flag=del&classId=<?php echo $value['classId']; ?>" 
                    onClick="return confirm('确定要删除吗？');">
                        <i class="fa fa-trash" style="font-size:1em;"></i>
                        	   删除
                    </a>
                </td>
            </tr>
            <?php
        		  }
        		?>
		</table> 
		<table>
			 <?php echo $page->getNavigate(); ?>
		</table>
	</div>
</body>
</html>
<?php
    if(isset($_REQUEST['flag'])){//判断flag是否存在
        if($_REQUEST['flag']=='1'){
            echo '<script type="text/javascript">
                      alert("删除成功");
                      window.location.href="classesList.php";
                  </script>';
        }elseif ($_REQUEST['flag']=='2') {
            echo '<script type="text/javascript">
                      alert("添加成功");
                      window.location.href="classesList.php";
                  </script>';
        }elseif ($_REQUEST['flag']=='3') {
            echo '<script type="text/javascript">
                      alert("修改成功");
                      window.location.href="classesList.php";
                  </script>';
        }elseif ($_REQUEST['flag']=='0') {
            echo '<script type="text/javascript">
                      alert("操作失败");
                      window.location.href="classesList.php";
                  </script>';
        }
    }
?>