<?php
	
?>
<!--<?php
	$university_name = $_POST['university_name'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style>
			table{
					border-collapse: collapse;
					margin: 0 auto;
				}
				th, td{
					border: solid 1px #ccc;
					padding: 5px;
				}
		</style>	
		<title>山东省新高考志愿填报辅助系统</title>
	</head>
	<body>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "123456";
		$dbname = "db_exam";
		 
		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// 检测连接
		if (!$conn) {
		    die("连接失败: " . $conn->connect_error);
		} 
		
		$sql = "SELECT university_name, major_name, min2019 
		FROM exam_major 
		WHERE university_name LIKE '%{$university_name}%'";#别忘了university_name前面的$
		#echo $sql;
		$result = $conn->query($sql);
		echo '<table>';
			echo'<tr>';
				echo'<th width=100px>院校名</th>';
				echo'<th width=400px>专业名</th>';
				echo'<th width=100px>2019年录取最低分</th>';
			echo'</tr>';
//		echo'</table>';
		if($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc()){
//				echo '<table>';
				echo '<tr>';
				echo "<td>";
				echo $row["university_name"];
				echo "</td>";
				echo "<td>";
				echo $row["major_name"];
				echo "</td>";
				echo "<td>"; 
				echo $row["min2019"];
				echo "</td>";
				echo '</tr>';
				
			}
			echo '</table>';
		}
			
		else{
			echo "没有数据！";
		}
		$conn->close();
		?>
	</body>
</html>-->