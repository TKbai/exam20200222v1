<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="stylesheet" href="teachercss.css">
    <style>
        #title {
            margin-bottom: 20px;
        }
        #notice_title {
            font-size: 18px;
            color: #0e7bd8;
        }
        #position {
            width:90%;
            font-size: 14px; 
            text-align: right;
            border-bottom:solid 3px #0e7bd8;
            float:right
        }
        /*li {
            list-style-image: url(' list-ye.gif');
            list-style-position:inside
        }*/
       ul{
       	list-style-image: url('list-ye.gif');
       	padding-left: 22px;
       }
        #notice_date {
            float: right;
        }
        #a1{
        	width:308px;
        	display:block;
        	overflow:hidden;
        	word-break:keep-all;/*加以研究*/
        	white-space:nowrap;
        	text-overflow:ellipsis;
        	margin-left: 10px;
        }
  </style>
    <title>通知公告</title>
</head>
<body>
    <div id="container">
        <?php include 'header.php' ?>
        <?php include 'nav.php' ?>
        <div id="content">
            <div id="title">
                <span id="notice_title">通知公告</span>
                <span id="position">当前位置：首页>>通知公告</span>
            </div>
            <ul>
                <li>
                    <a id="a1" href="http://www.sdzk.cn/NewsInfo.aspx?NewsID=4722"
                    target="_blank"  
                    title="近三年普通高考本科普通批首次志愿录取情况统计表" >
                      <!--山东省教育厅新型冠状病毒感染的肺炎疫情防控工作领导小组关于组织收看疫情防控特别节目的通知-->
                      This paragraph contains some text. This line will-break-at-hyphenates.
                    </a>
                    <span style="margin-top: -20px;" id="notice_date">2020年2月5日</span>
                    
                </li>
                
            </ul>
        </div>
        <?php include 'footer.php' ?>
    </div>
</body>
</html>