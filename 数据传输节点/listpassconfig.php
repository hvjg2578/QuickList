<?php
//本程序由Chuanrui（hvjg2578）编写
//修改配置时一定要理清目录列表节点与数据传输节点的区别！设置错会出现问题！
$listpassopen=true;//是否开启文件传递，如果关闭此项，会立即停止向目录列表节点发送链接，已发送的链接仍然生效
$localdir = './files';//文件存放地址
$information=array();
$information["download_method"]="php";//php或server，如果采用PHP方式，下载限速同config.php设置内容
$information['Dirpassword'] = "ChuanruiDirPassword.txt";//目录密码文件名称（强烈建议更改此文件名称！）在目录内放置此文件，并在文件内填写密码，可设置文件夹密码
$information["site_url"]="";//数据传输站点网址，带http前缀，末尾加“/”例如：http://cfdlser.test.1314.cool
$information["download_max_speed"]="4096";//仅当download_method设置为PHP时，此项有效，单位为KB
$rewrite=false;//数据传输站点是否开启伪静态？
$token="chuanrui12345";//用于身份验证的token
$username="admin";//用于身份验证的用户名
$password="admin";//用于身份验证的密码
