<?php
//本程序由Chuanrui（hvjg2578）编写
//尊重版权，请勿删除页脚“Powered By”提示
//修改配置时一定要理清目录列表节点与数据传输节点的区别！设置错会出现问题！
$rewrite = false;//目录列表节点是否开启伪静态？
$information=array();
$information["site_title"] = "QuickList云资料存储";//站点名称
$information['description'] = '';//站点描述
$information['keyword'] = '';//站点关键词，用','分割
$information['beian'] = "XICP备xxxxxxxx号";//备案号
$information["remotesite_url"]="";//数据传输节点地址,如果非80，443，要带端口、斜杠以及http前缀,例如http://cfdlser.test.1314.cool/
$information["remotesite_token"]="chuanrui12345";//数据传输节点用于身份验证的Token
$information["remotesite_username"]="admin";//数据传输节点用于身份验证的用户名
$information["remotesite_password"]="admin";//数据传输节点用于身份验证的密码
$information["site_url"]="";//目录列表节点地址，例如http://cfdlclient.test.1314.cool/
