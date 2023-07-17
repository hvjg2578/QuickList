<?php
include_once("config.php");
include_once("SDK/functions.php");

include_once("SDK/init.php");
if($rewrite==false and $_SERVER['REQUEST_URI']=="/")
{
    header("Location: ".$information["site_url"]."/?f=");
}
if(isset($_REQUEST["f"])){
    $f=fParse($_REQUEST["f"]);
}
else{
    $f="/";
}
$listdata=getListdata($f);
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title><?php if (!empty($page_title)) echo $page_title . " - ";
            echo $information["site_title"]; ?></title>
    <meta name="description" content="<? echo $information['description'];?>">
    <meta name="keyword" content="<? echo $information['keyword'];?>">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="/css/prettify.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/mdui@1.0.1/dist/css/mdui.min.css"/>
	<script type="text/javascript" src="/css/prettify.js"></script>
	<!--<body style="background-image:url('https://dss0.bdstatic.com/k4oZeXSm1A5BphGlnYG/skin/71.jpg?2');background-repeat:no-repeat;background-attachment: fixed; ">-->
	<style>

@-moz-keyframes myfirst /* Firefox */
{
	0%   {background:red;}
	/*25%  {background:yellow;}*/
	/*50%  {background:blue;}*/
	100% {background:green;}
}

@-webkit-keyframes myfirst /* Safari and Chrome */
{
	0%   {background:red;}
	/*25%  {background:yellow;}*/
	/*50%  {background:blue;}*/
	100% {background:green;}
}

@-o-keyframes myfirst /* Opera */
{
	0%   {background:red;}
	/*25%  {background:yellow;}*/
	/*50%  {background:blue;}*/
	100% {background:green;}
}
	
.footer-V{
    background: #333;
    flex: 0 0 auto;
}
	    .foot-container_2X1Nt {
	       /*width: 100%;*/
    height:100px;   /* footer的高度一定要是固定值*/ 
    /*position:absolute;*/
    bottom:0px;
    text-align: left;
    height: 42px;
    line-height: 42px;
    border-top: none;
    margin-top: 0;
    background: #f5f6f5;
}
* {
  box-sizing: border-box;
}

.subbox table {
  /*max-width: 800px;*/
   /*border-radius: 25px;*/
  margin: 40px auto;
  text-align: left;
  border-spacing: 0;
  color: #333;
  border: 1px solid #ddd;
  border-radius: 4px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 0.1);
}

.subbox td {
    background: #f4f4f4;
    opacity: 0.9;
  padding: 8px 16px;
  font-size: 14px;
  border-bottom: 1px solid #f4f4f4;
  /*display: block;*/
}

.subbox th {
  padding: 16px;
}

.subbox img {
  width: 40px;
  border-radius: 50%;
}

.subbox tr:last-child > td {
  border: 0;
}

.subbox tbody > tr:hover {
  background-color: rgba(221, 221, 221, 0.6);
  /*box-shadow: 0 5px 12px rgba(0, 0, 0, 0.1);*/
 box-shadow:2 5px 10px 0 rgba(0,0,0,0.1);
 opacity:1;
 /*background:rgba(27,27,27,0.8)*/
}

.subbox thead {
  text-transform: uppercase;
  font-size: 12px;
  background-color: #efefef;
  letter-spacing: 0.5px;
  color: rgba(0, 0, 0, 0.4);
}

.option {
  display: inline-block;
  padding: 5px 10px;
  background-color: #ddd;
  border-radius: 4px;
  margin-right: 15px;
}

.name {
  min-width: 110px;
  display: inline-block;
}

.comment {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 300px;
  display: inline-block;
}

a{
    color: #585858;
    /*display: block;*/
    /*text-decoration:none;*/
}
a:hover,a:active
{
	/*background-color:#7A991A;*/
	text-decoration:none;
}

.option.is-blue {
  background-color: #bceefd;
}

.option.is-orange {
  background-color: #ffd89e;
}

.option.is-purple {
  background-color: #e9cbff;
}

.option.is-green {
  background-color: #bef1a9;
}
	</style>
</head>
<body>
<script src="//cdn.jsdelivr.net/npm/mdui@1.0.1/dist/js/mdui.min.js"></script>
<nav class="navbar navbar-default" role="navigation">
	<div class="container">
	<div class="navbar-header">
		<a class="navbar-brand" href="#"><? echo $information["site_title"]; ?></a>
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
include_once("Parsedown.php");
?>
<div class="container">
    <div class="typo subbox table-fluid">
        <table class="table  table-hover" style="height:90%;">
            <thead>
                <tr>
                    <th>文件名</th>
                    <th>文件大小</th>
                    <th>修改日期</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $readme=listDirsAndFiles($listdata);
                ?>
                </tbody>
                </table></div></div>
                <?php 
                  if($readme!="")
                  {
                    displayReadme($readme);
                }


?>
<br><br>
<footer class="navbar navbar-default navbar-fixed-bottom">
   <div class="container foot-container_2X1Nt">
       <ul> 
      Copyright &copy; 2021    <strong><a href="//www.1314.cool/" target="_blank">Chuanrui </a></strong>&nbsp;
     All Rights Reserved. 备案号：<a target="_blank" rel="nofollow" href="https://beian.miit.gov.cn/"><? echo $information["beian"];?></a>
     Powered By <a href="//www.1314.cool/" target="_blank">Chuanrui 文件目录列表程序</a>
     <!--尊重版权，请勿删除Powered By版权提示-->
     </ul>
 </footer>
