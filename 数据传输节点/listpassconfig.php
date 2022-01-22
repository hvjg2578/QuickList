<?php
//本程序由Chuanrui（hvjg2578）编写
//修改配置时一定要理清目录列表节点与数据传输节点的区别！设置错会出现问题！
$listpassopen=true;//是否开启文件传递
$localdir = './files';//文件存放地址
$information=array();
$information["download_method"]="php";//php或server，如果采用PHP方式，下载限速同config.php设置内容
$information['Dirpassword'] = "ChuanruiDirPassword.txt";//目录密码文件名称（强烈建议更改此文件名称！）
$information["site_url"]="http://cfdlser.test.1314.cool";//数据传输站点网址，末尾不加“/”
$information["download_max_speed"]="4096";//仅当download_method设置为PHP时，此项有效
$rewrite=false;//数据传输站点是否开启伪静态？
$token="chuanrui12345";//用于身份验证的token
$username="admin";//用于身份验证的用户名
$password="admin";//用于身份验证的密码