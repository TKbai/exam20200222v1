#网页响应
import requests
#  正则表达式库
import re
#  下载一个网页
url = "https://qxs.la/177913/"
#  模拟浏览器发送http请求。
response = requests.get(url)
#  目标小说主页的网页源码
html = response.text

#  小说名称
title = re.findall(r'<a href="/177913/">(.*?)</a>', html)[0]
#  新建一个文件，保存小说内容
# with open('%s.txt' %title) as f:
fb =open('%s.txt' %title, 'w', encoding = 'utf-8')
#  获取每一章节的信息（章节，url）
dl = re.findall(r'<div class="chapters">.*?<div class="clear">', html, re.S)[0]
chapter_info_list = re.findall(r'href="(.*?)" title=".*?">(.*?)<', dl, re.S)
#  循环每一个章节，分别去下载
for chapter_info in chapter_info_list:
    #   chapter_title = chapter_info[1]
    #   chapter_url = chapter_info[0]
    chapter_url, chapter_title = chapter_info
    chapter_url = "https://qxs.la/%s" %chapter_url
    # 下载章节内容
    chapter_response = requests.get(chapter_url)
    chapter_html = chapter_response.text
    # 提取章节内容，正则表达式
    chapter_content = re.findall(r'type="text/javascript">ad3\(\);</script></td></tr></table>(.*?)<div style="color:#ff6600;font-size:16px">', chapter_html, requests.S)[0]

    chapter_content = chapter_content.replace(' ', '')
    chapter_content = chapter_content.replace('\r', '')
    chapter_content = chapter_content.replace('\n', '')
    chapter_content = chapter_content.replace('<br/>', '')
    chapter_content = chapter_content.replace('\u3000', '')
    chapter_content = chapter_content.replace('</div>', '')
    chapter_content = chapter_content.replace('www!22ff*com', '')
    #  数据持久化
    fb.write(chapter_title + '\n')
    fb.write(chapter_content + '\n')
    print(chapter_url)