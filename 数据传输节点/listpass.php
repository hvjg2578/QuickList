<?php
header("Content-Type: application/json");
include("listpassconfig.php");
if(!$listpassopen) {$jieguo["code"]="000";$json=urldecode(json_encode($jieguo));
$json=str_replace("&quot;","'",$json);
echo $json;exit;}
$jieguo;
$f;
if(isset($_REQUEST['token']) && isset($_REQUEST['username'])&& isset($_REQUEST['password'])&&isset($_REQUEST['f']))
{
    $_REQUEST["token"]!=$token;$_REQUEST["username"]!=$username;$_REQUEST["password"]!=$password;
    if($_REQUEST["token"]!=$token || $_REQUEST["username"]!=$username || $_REQUEST["password"]!=$password)
    {
        $jieguo["code"]="500";$jieguo["data"]["num"]="0";$jieguo["data"]["list"]="";
    }
    else 
    {
        $f=$_REQUEST['f'];
        dirpasswordcheck();
        
    }
}
else 
{
        $jieguo["code"]="500";$jieguo["data"]["num"]="0";$jieguo["data"]["list"]="";
}

function dirpasswordcheck()
{
    global $localdir,$f,$information,$jieguo,$rewrite;
    if(is_file($localdir.$f))
    {
        $jieguo["code"]="700";
        if($information["download_method"]=="php")
        {
            if($rewrite){$jieguo["data"]["url"]=$information["site_url"].$f;}else{
            $jieguo["data"]["url"]=$information["site_url"]."?f=".$f;}
        }
        else {$jieguo["data"]["url"]=$information["site_url"].$localdir.$f;}
        $jieguo["data"]["url"]=str_replace("./","/",$jieguo["data"]["url"]);
        $json=urldecode(json_encode($jieguo));
        $json=str_replace("&quot;","'",$json);
        echo $json;
        exit;
    }
    else if(!is_dir($localdir."/".$f)){
        $jieguo["code"]="600";
        $json=urldecode(json_encode($jieguo));
        $json=str_replace("&quot;","'",$json);
        echo $json;
        exit;
    }
    if(file_exists($localdir . $f.'/'.$information["Dirpassword"]))
    {
        if(isset($_REQUEST['dirpassword']))
        {
            $dirpassword=file_get_contents($localdir . $f.'/'.$information["Dirpassword"]);
            if($_REQUEST['dirpassword']==$dirpassword)
            {
                listdata();
            }
            else
            {
                $jieguo["code"]="100";$jieguo["data"]["num"]="0";$jieguo["data"]["list"]="";
            }
        }
        else
        {
            $jieguo["code"]="400";$jieguo["data"]["num"]="0";$jieguo["data"]["list"]="";
        }
    }
    else
    {
        listdata();
    }
}
function listdata()
{
    global $localdir,$f,$information,$jieguo,$rewrite;
    
    if(file_exists($localdir. $f.'/'))
    {
        if (dirname(rawurldecode($f)) == '/') $p = '';
        else $p = rawurlencode(dirname($f));
        $dir = scandir($localdir . $f,1);
        $i=0;
        $dirs=0;
        $files=0;
        $jieguo["data"]["pre"]=$p;
        $jieguo["data"]['date']=date("Y-m-d H:i:s", filemtime($localdir));
        foreach ($dir as $value) 
        {
            $sub_path = $localdir . $f . '/' . $value;
            if ($value == '.' || $value == '..' || $value == $information["Dirpassword"]) 
            {
                continue;
            } 
            if(is_dir($sub_path))
            {
                
                $jieguo["data"]["list"]['dirs'][$dirs]["name"]=$value;
                $jieguo["data"]["list"]['dirs'][$dirs]['date']=date("Y-m-d H:i:s", filemtime($localdir.$f."/".$value));
                $dirs++;
            }
            else
            {
                if($information["download_method"]=="php")
                {
                    $url=$information["site_url"].$f.'/'.$value;
                    if(!$rewrite){$url=$information["site_url"]."?f=".$f.'/'.$value;}
                    if(checkvalue(".php",$value)==true||checkvalue(".html",$value)==true){$url=$information["site_url"]."/appcodedl.php?f=".$f.'/'.$value;}
                }
                else
                {
                    $url=$information["site_url"].$localdir.$f.'/'.$value;
                    if(!$rewrite){$url=$information["site_url"]."?f=".$localdir.$f.'/'.$value;}
                    if(checkvalue(".php",$value)==true||checkvalue(".html",$value)==true){$url=$information["site_url"]."/appcodedl.php?f=".$f.'/'.$value;}
                }
                $url=str_replace("//","/",$url);
                $url=str_replace("./","/",$url);
                $url=str_replace("http:/","http://",$url);
                $url=str_replace("https:/","https://",$url);
                $jieguo["data"]["list"]['files'][$files]['name']=$value;
                $jieguo["data"]["list"]['files'][$files]['date']=date("Y-m-d H:i:s", filemtime($localdir . $f."/".$value));
                $jieguo["data"]["list"]['files'][$files]['url']=rawurlencode($url);
                $jieguo["data"]["list"]['files'][$files]['size']=size_unit(filesize($sub_path));
                $files++;
            }
            $i++;
        }
        $jieguo["code"]="200";$jieguo["data"]["totalnum"]=$i;$jieguo["data"]["dirnum"]=$dirs;$jieguo["data"]["filenum"]=$files;
    }
    else
    {
        $jieguo["code"]="300";$jieguo["data"]["totalnum"]="0";$jieguo["data"]["list"]="";
    }
}
function checkvalue($abb,$value1)
{$houzhui=strrev($value1);$houzhui=".".strrev(strchr($houzhui,'.',true));;if(strcasecmp($houzhui,$abb)==0){return true;}else {return false;}}
function size_unit($num){
    $p = 0;
    $format='Byte';
    if($num>0 && $num<1024){
        $p = 0;
        return number_format($num).' '.$format;
    }
    if($num>=1024 && $num<pow(1024, 2)){
        $p = 1;
        $format = 'KB';
    }
    if ($num>=pow(1024, 2) && $num<pow(1024, 3)) {
        $p = 2;
        $format = 'MB';
    }
    if ($num>=pow(1024, 3) && $num<pow(1024, 4)) {
        $p = 3;
        $format = 'GB';
    }
    if ($num>=pow(1024, 4) && $num<pow(1024, 5)) {
        $p = 3;
        $format = 'TB';
    }
    $num /= pow(1024, $p);
    return number_format($num, 3).' '.$format;
}
$json=urldecode(json_encode($jieguo));
$json=str_replace("&quot;","'",$json);
echo $json;
