<?php
//本程序由Chuanrui（hvjg2578）编写
//尊重版权，请勿删除页脚“Powered By”提示
//修改配置时一定要理清目录列表节点与数据传输节点的区别！设置错会出现问题！
$rewrite = false;//目录列表节点是否开启伪静态？
$information=array();
$information["site_title"] = "QuickList";//站点名称
$information['description'] = '';//站点描述
$information['keyword'] = '';//站点关键词，用','分割
$information['beian'] = "XICP备XXXXXXXX号-X";//备案号
$information["site_url"]="";//目录列表节点地址，例如http://cfdlclient.test.1314.cool/
$information["password_date"]=3600;//自动保存密码过期时间，设置为0则关闭浏览器即过期
$information['type'] = "tencent";//数据存储节点类型 ql：QuickList数据存储节点 tencent：腾讯云COS对象存储

$tencent=array();
$tencent["keyType"]="permanent" ;// 密钥类型：permanent：永久密钥，temp：临时密钥
$tencent["secretId"]="";
$tencent["secretKey"]="";
$tencent["schema"]="http"; //与腾讯云COS服务器通信时的协议头，若未配置 HTTPS 证书，则需要填入http，若填入 https 会出现 certificate problem。若您需要配置证书，可参考 https://cloud.tencent.com/document/product/436/56142
$tencent["region"] = "ap-beijing"; //用户的 region，已创建桶归属的 region 可以在控制台查看，https://console.cloud.tencent.com/cos5/b
$tencent["tmpToken"] = ""; //临时密钥的 Token,如使用永久密钥，此项留空，临时密钥生成和使用指引参见 https://cloud.tencent.com/document/product/436/14048
$tencent["bucketId"]="";





$ql["remotesite_url"]="";//数据传输节点地址,如果非80，443，要带端口、斜杠以及http前缀,例如http://cfdlser.test.1314.cool/
$ql["remotesite_token"]="";//数据传输节点用于身份验证的Token
$ql["remotesite_username"]="";//数据传输节点用于身份验证的用户名
$ql["remotesite_password"]="";//数据传输节点用于身份验证的密码