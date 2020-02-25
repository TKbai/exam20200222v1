<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>添加班级信息</title>
</head>
<body>
    <div>
        <h1>添加班级信息</h1>
        <form name="frmClass" 
        	  action="../controller/classesController.php?flag=add" 
        	  method="post" 
       		  onSubmit="return InputCheck(this)">
            <table>
                <tr>
                    <td>
                         班级编号
                    </td>
                    <td>
                        <input type="text" name="classId" required>
                    </td>
                </tr>
                <tr>
                    <td>
                         班级名称
                    </td>
                    <td>
                        <input type="text" name="className" required>
                    </td>
                </tr>
                <tr>
                    <td>
                         专业名称
                    </td>
                    <td>
                        <input type="text" name="major" required>
                    </td>
                </tr>
                <tr>
                    <td>
                         研究方向
                    </td>
                    <td>
                        <input type="text" name="direction" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="center">
                        <input type="submit" name="btnSubmit" id="btnAdd"value="保存">
                        <input type="reset"  name="btnReset"  id="btnReset"value="重填" >
                        <input type="button" value="返回" onClick="location.href='classesList.php'" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
  
</body>
</html>