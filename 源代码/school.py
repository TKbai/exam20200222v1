import os
import requests
#  正则表达式库
import re
#  excel操作库
import xlwt
import json
#  下载一个网页http://xkkm.sdzk.cn/zy-manager-web/gxxx/selectAllDq#
url = "http://xkkm.sdzk.cn/zy-manager-web/gxxx/selectAllDq#"
# 伪装头部
head = {
    'Content-Type': 'application/json',
    'Accept': 'application/json, text/javascript, */*; q=0.01',
    'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36'
}

#  模拟浏览器发送http请求。
response = requests.get(url)
response.encoding = 'utf-8'
#  获取网页源码
html = response.text
# 将省份代号和省份保存到pravice中
pravice = re.findall(r':#C0C0C0;" onclick="selectByDqYx\((.*?)\)">(.*?)</a>', html ,re.S )
print(pravice)

#写入某省市各个大学创建excel文件
xls = xlwt.Workbook()
sheet1 = xls.add_sheet("school")
sheet1.write(0, 0, '学校')
sheet1.write(0, 1, '学校网址')

#打开名字为“学校信息”的文件夹，如果没有则创建
if not os.path.exists('学校信息'):
    os.mkdir('学校信息')

for daihao, pro in pravice:
    #获取各个省市中json数据中的的url
    url2="http://xkkm.sdzk.cn/zy-manager-web/gxxx/selectByDqYx?dqdm=%s" %daihao
    #获取省市中的json数据
    r = requests.post(url2, headers=head)
    data = r.json()

    #测试json
    print(data)


    i = 1
    # for循环中遍历各个学校的字典类型信息
    for json in data:
        print(json['xxmc'], json['url'])
        sheet1.write(i, 0, json['xxmc'])
        sheet1.write(i, 1, json['url'])
        i+=1
    # 将Excel文件保存到‘学校信息’目录中
    xls.save('学校信息' + '/' + '%s.xls' %pro)
    exit()