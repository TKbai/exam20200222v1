<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
   <link rel="stylesheet" href="css/style2.0.css">
    <title>山东省新高考志愿填报辅助系统</title>
</head>
<body>
    <div id="container">
        <div id="search">
            <form action="search.php" method="post">
                <label for="university_name">院校名：</label>
                <input type="text" 
                       id="university_name" 
                       name="university_name" 
                       placeholder="请输入院校名称">
                <input type="submit" value="查询">
            </form>
        </div>
        <div id="result">
            <?php
            if($_POST['university_name'] == '') {
                echo "请输入要查询的院校名称！";
            } else {
                $hostname = '127.0.0.1';
                $username = 'root';
                $password = '123456';
                $database = 'db_exam';
                $conn = new mysqli($hostname, $username, $password, $database);
                if($conn->connect_error) {
                    die('数据库连接失败！' . $conn->connect_error);
                }
                $university_name = $_POST['university_name'];
                $sql = "SELECT university_name, major_name, min2019 
                        FROM exam_major 
                        WHERE university_name LIKE '%{$university_name}%'";
                $result = $conn->query($sql);
                echo '<table>';
                echo '<tr>';
                echo '<th>院校名</th>';
                echo '<th>专业名</th>';
                echo '<th>2019年录取最低分</th>';
                echo '</tr>';
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td style="width:200px">', $row['university_name'], '</td>';
                        echo '<td style="width:400px">', $row['major_name'], '</td>';
                        echo '<td>', $row['min2019'], '</td>';
                        echo '</tr>';
                    }
                    
                } else {
                    echo '没有数据！';
                }
                echo '</table>';
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>