<?php
require_once('../model/ClassesModel.class.php');
$classId = $_REQUEST['classId'];
$classesModel = new ClassesModel();
$arrayClasses = $classesModel-> getClassesByClassId($classId);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE">
<title>修改班级信息</title>
<style type="text/css">
th,td{
    border:solid 1px #999;
    padding: 5px;   
}
</style>
</head>

<body>
    <div id="main">
        <form id="formClass" action="../controller/classesController.php?flag=edit&classId=<?php echo $classId ?>" method="post" onSubmit="return InputCheck(this)">
            <table>
                 
                  <tr>
                    <td>
                         班级编号
                    </td>
                    <td>
                        <?php echo $classId ?>
                    </td>
                 </tr>
                 <tr>
                    <td>
                         班级名称
                    </td>
                    <td>
                       <input type="text" name="className"  value="<?php echo $arrayClasses[0]['className']; ?>"  required>
                    </td>
                 </tr>
                 <tr>
                    <td>
                         专业名称
                    </td>
                    <td>
                        <input type="text" name="major"  value="<?php echo $arrayClasses[0]['major']; ?>"  required>
                    </td>
                 </tr>
                 <tr>
                    <td>
                         研究方向
                    </td>
                    <td>
                        <input type="text" name="direction"  value="<?php echo $arrayClasses[0]['direction']; ?>"  required>
                    </td>
                 </tr>
                    <td colspan="2" align="center">
                        <input type="submit" name="btnSubmit" id="btnSubmit" value="保存"  onClick="return InputCheck()">
                        <input type="button" name="btnReturn" id="btnReturn" value="返回" 
                        onClick="javascript:window.location.href='classList.php'" >
                    </td>
                  </tr> 
            </table>              
        </form>
    </div>
</body>
</html>
<?php
    if(isset($_REQUEST['flag'])){//判断flag是否存在
        if ($_REQUEST['flag']=='0') {
            $classId = $_REQUEST['classId'];
            echo '<script>
            alert("修改失败");
            </script>';
        }
    }
?>