<!DOCTYPE html>
<html>
<body>
<?php
//$str = "This is some <b>bold</b> text.";
//echo htmlspecialchars($str);
//echo '<br>';
//echo $str;
//echo '<br>';

$html = file_get_contents('https://www.sdjzu.edu.cn/');
//echo htmlspecialchars($html);
echo '<br>';
//echo $html;
?>

<p>把 < 和 > 转换为实体常用于防止浏览器将其用作 HTML 元素。当用户有权在您的页面上显示输入时，对于防止代码运行非常有用。</p>

</body>
</html>