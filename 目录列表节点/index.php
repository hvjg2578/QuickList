<?php
include("config.php");
include("header.php");
include("Parsedown.php");
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
                $readme="";
                if ($rewrite) 
                {
                    $url=$information['site_url'] . rawurldecode($listdata["data"]["pre"]);
                    $url=EncodeUrl($url);
                    echo '<tr><td><i class="mdui-icon material-icons">&#xe317;</i><a href="' . $url. '">&nbsp; 上级目录</a></td>';
                }
                else 
                {
                    $url=$information['site_url'] . '?f=' . urldecode($listdata{"data"}["pre"]);
                    $url=EncodeUrl($url);
                    echo '<tr><td><i class="mdui-icon material-icons">&#xe317;</i><a href="' . $url. '">&nbsp; 上级目录</a></td>';
                }
                echo '<td>Dir</td><td>' . $listdata{"data"}["date"] . '</td></tr>';
                for ($in=0;$in < $listdata["data"]["dirnum"];$in++)
                {
                    echo '<tr>';
                    if(!$rewrite) $url=$information["site_url"]."?f=".$f."/".$listdata["data"]["list"]['dirs'][$in]["name"]; else $url=$information["site_url"]."".$f."/".$listdata["data"]["list"]['dirs'][$in]["name"];
                    $url=rawurldecode($url);
                    $url=EncodeUrl($url);
                    echo '<td><i class="mdui-icon material-icons">&#xe2c7;</i><a href="' . $url . '">'.'&nbsp; '.$listdata["data"]["list"]['dirs'][$in]["name"].'</a></td>';
                    echo '<td>Dir</td><td>' . $listdata["data"]['list']['dirs'][$in]["date"] . '</td>';
                    echo "</tr>";
                }
                for ($in=0;$in < $listdata["data"]["filenum"];$in++)
                {
                    $url=$listdata["data"]["list"]['files'][$in]["url"];
                    $url=EncodeUrl($url);
                    if($listdata["data"]["list"]['files'][$in]["name"]=="readme.md"){$readme=file_get_contents($url);continue;}
                    $iconnum=geticon($listdata["data"]["list"]['files'][$in]["name"]);
                    if($iconnum!="&#xe24d;") {$url=rawurlencode($url);$url=$information["site_url"]."/remotemedia.php?url=".$url;}
                    echo '<td><i class="mdui-icon material-icons">'.$iconnum.'</i><a href="' . $url . '">'.'&nbsp; '.$listdata["data"]["list"]['files'][$in]["name"].'</a></td>';
                    echo '<td>'.$listdata["data"]['list']['files'][$in]["size"].'</td><td>' . $listdata["data"]['list']['files'][$in]["date"] . '</td>';
                    echo "</tr>";
                }?>
                </tbody>
                </table></div></div>
                <?php 
                  if($readme!="")
                  {
                    echo "<div class=container>";
                      echo "<div class='typo subbox table-fluid'>";
                      echo "<table class='table  table-hover table-striped' style='height:90%;'><tr><th>readme.md</th></tr><tr><td>";
                      $Parsedown = new Parsedown();
                    echo $Parsedown->text($readme); 
                echo "</td></tr></table></div></div>";
                }
function checkvalue($abb,$value1)
{$houzhui=strrev($value1);$houzhui=".".strrev(strchr($houzhui,'.',true));;if(strcasecmp($houzhui,$abb)==0){return true;}else {return false;}}
function geticon($value)
{
    if(checkvalue(".png",$value)||checkvalue(".jpg",$value)||checkvalue(".gif",$value))
    {return "&#xe1bc;";}
    else if (checkvalue(".mp4",$value)||checkvalue(".webp",$value)||checkvalue(".gif",$value))
    {return "&#xe639;";}
    else if (checkvalue(".mp3",$value)||checkvalue(".wav",$value)||checkvalue(".mid",$value)||checkvalue(".aiff",$value)||checkvalue(".midi",$value)||checkvalue(".au",$value)||checkvalue(".m4a",$value))
    {return "&#xe405;";}
    else if (checkvalue(".md",$value))
    {return "&#xe23f;";}
    else if (checkvalue(".ppt",$value)||checkvalue(".pptx",$value)||checkvalue(".doc",$value)||checkvalue(".docx",$value)||checkvalue(".xls",$value)||checkvalue(".xlsx",$value))
    {return "&#xe23f;";}
    else if (checkvalue(".txt",$value))
    {return "&#xe264;";}
    else if (checkvalue(".cpp",$value)||checkvalue(".c",$value)||checkvalue(".java",$value)||checkvalue(".cs",$value)||checkvalue(".py",$value)||checkvalue(".h",$value)||checkvalue(".hpp",$value)||checkvalue(".hxx",$value)||checkvalue(".cc",$value)||checkvalue(".cxx",$value)||checkvalue(".html",$value)||checkvalue(".css",$value)||checkvalue(".php",$value)||checkvalue(".vbp",$value)||checkvalue(".frm",$value)||checkvalue(".ctl",$value)||checkvalue(".bas",$value)||checkvalue(".cls",$value)||checkvalue(".sql",$value)||checkvalue(".go",$value)||checkvalue(".json",$value)||checkvalue(".sh",$value)||checkvalue(".htm",$value)||checkvalue(".bat",$value)||checkvalue(".cmd",$value))
    {return "&#xe86f;";}
    else{return "&#xe24d;";}
}
function EncodeUrl($url)
{$url=rawurlencode($url);$url=str_replace("%3A%2F%2F","://",$url);$url=str_replace("%2F%2F","/",$url);$url=str_replace("%2F","/",$url);$url=str_replace("%3Ff%3D","?f=",$url);return $url;}
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
