<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<link rel="stylesheet" href="css/页面设置css.css">
		<title>山东省新高考志愿填报辅助系统</title>
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
			<div id="header">
				<img id="banner" src="jpg/banner.jpg" alt="banner">
			</div>
			<div id="nav">
				<a id="a">通知公告</a>
				<a id="a">权威发布</a>
				<a id="a">查专业</a>
				<a id="a">查大学</a>
				<a id="a">填志愿</a>
				<a id="a">联系我们</a>
			</div>
			<div id="content">
				<div class="pp">
					<p class="p">晚风轻轻</p>
				</div>
			</div>
			<div id="footer">
				Copyright &copy;凤鸣科技
			</div>
		</div>
	</body>

</html>