<?php 
//本程序由Chuanrui（hvjg2578）编写
//尊重版权，请勿删除页脚“Powered By”提示
// include("function.php");
include_once("config.php");
include_once("Parsedown.php");
global $information;
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php global $information; echo $information['site_title']; ?></title>
    <meta name="description" content="<? echo $information['description'];?>">
    <meta name="keyword" content="<? echo $information['keyword'];?>">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"/>
	<link href="/css/prettify.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="/css/prettify.js"></script>
	<script src="/css/html5media.min.js"></script> 
	<style>
	div
{
}
* {box-sizing: border-box;}
.subbox table {margin: 40px auto;text-align: left;border-spacing: 0; color: #333; border: 1px solid #ddd; border-radius: 4px;overflow:hidden;box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);}
.subbox td {padding: 8px 16px;font-size: 14px;border-bottom: 1px solid #f4f4f4;}
.subbox th {padding: 16px;}
.subbox img {width: 40px;border-radius: 50%;}
.subbox tr:last-child > td {border: 0;}
.subbox tbody > tr:hover {background-color: rgba(221, 221, 221, 0.2);}
.subbox thead {text-transform: uppercase;font-size: 12px;background-color: #efefef;letter-spacing: 0.5px;color: rgba(0, 0, 0, 0.4);}
.option {display: inline-block;padding: 5px 10px;background-color: #ddd;border-radius: 4px;margin-right: 15px;}
.name {min-width: 110px;display: inline-block;}
.comment {white-space: nowrap;overflow: hidden;text-overflow: ellipsis;max-width: 300px;display: inline-block;}
a{color: #585858;}a:hover,a:active{text-decoration:none;}
img {max-width: 100%;height: auto;}
video {max-width: 100%;height: auto;}
.option.is-blue {background-color: #bceefd;}
.option.is-orange {background-color: #ffd89e;}
.option.is-purple {background-color: #e9cbff;}
.option.is-green {background-color: #bef1a9;}
</style>
</head>
<body onload="prettyPrint()">
<script src="//cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"></script>
<script>
    function goup()
    {
        window.history.go(-1);
    }
</script>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="#"><? echo $information['site_title']; ?></a>
	</div>
	<div>
		<ul class="nav navbar-nav">
			
				</ul>
			</li>
		</ul>
	</div>
	</div>
</nav>
<?php
  echo "<div class=container>";
   echo "<a class='btn btn-warning' onclick=goup() >返回上一级</a>";
       echo "<a class='btn btn-success' href='".$_GET['url']."'".'>'."下载此文件</a>";
  if(checkvalue(".jpg",$_GET['url']) || checkvalue(".png",$_GET['url']) || checkvalue(".gif",$_GET['url']) || checkvalue(".jpeg",$_GET['url'])|| checkvalue(".bmp",$_GET['url']))
  {echo "<div class=container><img src='".$_GET['url'] ."'" .'>'."</img></div></div>";  }
  else if(checkvalue(".mp4",$_GET['url']) || checkvalue(".webp",$_GET['url']) || checkvalue(".ogg",$_GET['url'])|| checkvalue(".webm",$_GET['url']))
  {echo "<div class=container><video controls autoplay src='".$_GET['url'] ."'".'>'."</video></div></div>";}
  else if(checkvalue(".xml",$_GET['url']))
  {echo "<div class=container style=height:700px><iframe style='height:100%;width:100%;' src='".$_GET["url"]."'".'>'."</iframe></div>";}
  else if(checkvalue(".mp3",$_GET['url'])||checkvalue(".wav",$_GET['url'])||checkvalue(".mid",$_GET['url'])||checkvalue(".midi",$_GET['url'])||checkvalue(".aiff",$_GET['url'])||checkvalue(".au",$_GET['url'])||checkvalue(".m4a",$_GET['url']))
  {echo "<div class=container><audio controls autoplay width=100% src='".$_GET['url'] ."'".'>'."</audio></div>";}
  else if(checkvalue(".ppt",$_GET['url']) ||checkvalue(".pptx",$_GET['url'])||checkvalue(".doc",$_GET['url']) ||checkvalue(".docx",$_GET['url'])||checkvalue(".xls",$_GET['url'])||checkvalue(".xlsx",$_GET['url']))
  {$srcurl=rawurlencode($_GET['url']);$fileurl= "https://view.officeapps.live.com/op/embed.aspx?src=".$srcurl;
        echo "<div class=container style=height:700px><iframe  width='100%' height='800px' frameborder='0' src='".$fileurl."'".'>'."</iframe></div>";}
  else if(checkvalue(".md",$_GET['url']))
  {$srcurl=$_GET['url'];$mdfile=file_get_contents($srcurl);$mdfile=strToUtf8($mdfile);
  echo "<div class=container>";echo "<div class='typo subbox table-fluid'>";echo "<table class='table  table-hover table-striped' style='height:90%;'><tr><th>MarkDown文件</th></tr><tr><td>";
        $Parsedown = new Parsedown();
        echo $Parsedown->text($mdfile); 
        echo "</td></tr></table></div></div>";
  }
  else if(checkvalue(".txt",$_GET['url']))
  {
        $content = file_get_contents($_GET['url']); echo "<div class=container>";echo "<div class='typo subbox table-fluid'>"; echo "<table class='table  table-hover table-striped' style='height:90%;'><tr><th>TXT文本文件</th></tr><tr><td>";
        $content=strToUtf8($content);echo str_replace("\r\n","<br />",$content);; 
        echo "</td></tr></table></div></div>";
  }
  else if(checkvalue(".cpp",$_GET['url'])||checkvalue(".c",$_GET['url'])||checkvalue(".java",$_GET['url'])||checkvalue(".cs",$_GET['url'])||checkvalue(".py",$_GET['url'])||checkvalue(".h",$_GET['url'])||checkvalue(".hpp",$_GET['url'])||checkvalue(".hxx",$_GET['url'])||checkvalue(".cc",$_GET['url'])||checkvalue(".cxx",$_GET['url'])||checkvalue(".html",$_GET['url'])||checkvalue(".css",$_GET['url'])||checkvalue(".php",$_GET['url'])||checkvalue(".vbp",$_GET['url'])||checkvalue(".frm",$_GET['url'])||checkvalue(".ctl",$_GET['url'])||checkvalue(".bas",$_GET['url'])||checkvalue(".cls",$_GET['url'])||checkvalue(".sql",$_GET['url'])||checkvalue(".go",$_GET['url'])||checkvalue(".json",$_GET['url'])||checkvalue(".sh",$_GET['url'])||checkvalue(".htm",$_GET['url'])||checkvalue(".cmd",$_GET['url'])||checkvalue(".bat",$_GET['url']))
  {echo "<div class=container>";echo "<div class='typo subbox table-fluid'>";echo "<table class='table  table-hover table-striped' style='height:90%;'><tr><th>Code</th></tr><tr><td><pre width=100% class='prettyprint linenums'>";
        $codefile = file_get_contents($_GET['url']);$codefile= str_replace("<","&lt;",$codefile);$codefile= str_replace(">","&gt;",$codefile);
        echo strToUtf8($codefile);echo "</pre></td></tr></table></div></div>";
  }
function checkvalue($abb,$value1)
{$houzhui=strrev($value1);$houzhui=".".strrev(strchr($houzhui,'.',true));;if(strcasecmp($houzhui,$abb)==0){return true;}else {return false;}}
function strToUtf8($str){$encode = mb_detect_encoding($str, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));if($encode == 'UTF-8'){return $str;}else{return mb_convert_encoding($str, 'UTF-8', $encode);}}?>
</div>
</body>
