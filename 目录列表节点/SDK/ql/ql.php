<?php
function getQlListdata($f){
    global $information,$ql;
$name=$f.'password';
if(isset($_COOKIE[$name])){$password=$_COOKIE[$name];}else{$password="";}
if(isset($_POST["password"])){$password=$_POST["password"];}else{/*$password="";*/}



$url = $ql["remotesite_url"]."listpass.php?f=".$f."&username=".$ql["remotesite_username"]."&password=".$ql["remotesite_password"]."&token=".$ql["remotesite_token"]."&dirpassword=".$password;
$array = get_headers($url,1);
if(preg_match('/200/',$array[0])){ }else{echo "<div class=container><h1>无法连接到数据节点</h1><h2>请检查服务器配置</h2></div>";exit;}
$listdata=file_get_contents($url);
$listdata=json_decode($listdata,true);
    if ($listdata['code']=="700") 
    {
        $jump=$listdata["data"]['url'];
        $jump=urlencode($jump);
        $jump=str_replace("%3A%2F%2F","://",$jump);
        $jump=str_replace("%2F","/",$jump);
        header("Location: ".$jump);
        exit;
    } else if($listdata["code"]=="600"){
        include('404.php');
        exit;
    } 
    
    if($listdata["code"]=="200" && $password !=""){
        $name=$f.'password';
        //$name=str_replace("/","###",$name);
    setcookie($name,$password,time()+$ql["password_date"]);
//函数原型:int setcookie(string name,string value,int expire,string path,string domain,int secure)
    }
    if($listdata["code"]=="100")
{include("password.php");exit;}
else if($listdata["code"]=="500")
{echo "<div class=container><h1>数据节点配置的Token、用户名或密码配置不正确</h1><h2>请检查服务器配置</h2></div>";exit;} 
else if($listdata["code"]=="000")
{echo "<div class=container><h1>数据节点的文件信息传递（listpass）功能已经关闭</h1><h2>请检查服务器配置</h2></div>";exit;} 

    return $listdata;
}
    