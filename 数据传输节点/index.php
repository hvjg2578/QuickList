<?php
include('listpassconfig.php');
if(isset($_REQUEST["f"])){$f = str_replace("//", "/", $_REQUEST["f"]);}else{$f="";}
if (!is_dir($localdir . $f)) 
{
    if (file_exists($localdir . $f)) 
    {
        include('filepass.php');
        exit;
    } else {
        include('404.php');
        exit;
    }
}