<?php 
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}	                           
$university_name = test_input($_POST['university_name']);
$hostname = "127.0.0.1"; 
$username = "root";
$password =	"123456";
$database = "db_exam";
//创建连接
echo "<table>";
echo "<tr>";
echo "<th>院校名称</th>";
echo "<th>专业名称</th>";
echo "<th>2019录取最低分</th>";
echo "</tr>";

$conn = new mysqLi($hostname, $username , $password, $database);
$sql = "SELECT
			university_name,
			major_name,
			min2019
		FROM
			exam_major
		WHERE university_name LIKE '%{$university_name}%'";
$result = $conn -> query($sql);
$result = $conn -> query($sql);
if($result -> num_rows > 0) {
	while($row = $result->fetch_assoc( )){
	echo "<tr><td>",$row["university_name"], "</td><td>", $row["major_name"], "</td><td>",$row["min2019"], "</td></tr>";                            
	}
}else{
echo"没有数据 ! ";
}
echo"</table>";

//关闭数据库连接
$conn->close()
?>