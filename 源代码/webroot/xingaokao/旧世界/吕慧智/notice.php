<!DOCTYPE html>
<html lang="zh">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<link rel="stylesheet" href="页面设置css.css">
		<title>山东省新高考志愿填报大数据</title>
		<style>
			/*后面斜线↓*/
			p:after {
				display: inline-block;/*行内块状元素*/
				width: 400px;
				height: 3px;
				content: '';/*内容*/
				/*box-sizing: border-box;*/
				background: #0E7BD8;
				
	/*实验*/
	/*content:"- Remember this";
	background-color:yellow;
	color:red;
	font-weight:bold;*/
			}
			/*前面小点↓*/
			p:before {
				position: absolute;/*绝对定位取决于父元素*/
				top: 233px;
				left: 2px;
				display: inline-block;
				width: 4px;
				height: 4px;
				content: '';
				/*box-sizing: border-box;*/
				background: #0E7BD8;
			}
			/*移动文本让小点与文本不重合*/
			.p {
				margin-left: 8px;
			}
		</style>
	</head>

	<body>
		<div id="container">
			<?php include("header.php"); ?>
			<?php include("nav.php"); ?>
			<div id="content">
				<div class="pp">
					<p class="p">晚风轻轻</p>
				</div>
			</div>
			<?php include("footer.php"); ?>
		</div>
	</body>

</html>