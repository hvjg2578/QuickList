<?php
require_once('cos-sdk-v5-7.phar');
$cosClient;
if($tencent["keyType"]=="temp")
{
    $cosClient = new Qcloud\Cos\Client(
    array(
        'region' => $tencent["region"],
        'schema' => $tencent["schema"], //协议头部，默认为http
        'credentials'=> array(
            'secretId'  => $tencent["secretId"],
            'secretKey' => $tencent["secretKey"],
            'token' => $tencent["tmpToken"])));
}
else {
    $cosClient = new Qcloud\Cos\Client(
    array(
        'region' => $tencent["region"],
        'schema' => $tencent["schema"], //协议头部，默认为http
        'credentials'=> array(
            'secretId'  => $tencent["secretId"],
            'secretKey' => $tencent["secretKey"])));
}





function gettencentListdata($f)
{
    $listdata=array();
    $listdata["code"]="200";
    $listdata["data"]=array();
    $listdata["data"]["pre"]=dirname($f);
    $listdata["data"]["date"]="";
    $listdata["data"]["list"]["files"]=array();
    $listdata["data"]["list"]["dirs"]=array();
    $listdata["data"]["totalnum"]=0;
    $listdata["data"]["dirnum"]=0;
    $listdata["data"]["filenum"]=0;
    global $tencent,$cosClient,$information;
    try {
    $result = $cosClient->listObjects(array(
        'Bucket' => $tencent["bucketId"], //存储桶名称，由BucketName-Appid 组成，可以在COS控制台查看 https://console.cloud.tencent.com/cos5/bucket
        'Delimiter' => "/", //Delimiter表示分隔符, 设置为/表示列出当前目录下的object, 设置为空表示列出所有的object
        //'EncodingType' => 'url',//编码格式，对应请求中的 encoding-type 参数
        // 'Marker' => 'prefix/picture.jpg',//起始对象键标记
        'Prefix' => parsePerfix($f), //Prefix表示列出的object的key以prefix开始
        'MaxKeys' => 1000, // 设置最大遍历出多少个对象, 一次listObjects最大支持1000
    ));
    // 请求成功
    $result=$result->toArray();
    } catch (\Exception $e) {
        // 请求失败
        echo($e);
    }
    if(isset($result['Contents']))
    {
        $contents = $result['Contents'];
        foreach ($contents as $content) {
    $key = $content['Key'];
    $lastModified = $content['LastModified'];
    $etag = $content['ETag'];
    $size = $content['Size'];
    $storageClass = $content['StorageClass'];
    $owner = $content['Owner'];
    if($key==parsePerfix($f))
    {
        $listdata["data"]["date"]=parseDatetime($lastModified);
    }else
    {
        $file["name"]=basename($key);
        $file["date"]=parseDatetime($lastModified);
        $file["url"]=$information["site_url"].trim("/")."/goLink.php?key=".$key;
        $file["size"]=size_unit($size);
        $listdata["data"]["list"]["files"][]=$file;
    }
    $listdata["data"]["filenum"]=count($listdata["data"]["list"]["files"]);
    
}
    }



// 遍历CommonPrefixes数组
if(isset($result['CommonPrefixes']))
{
    $commonPrefixes = $result['CommonPrefixes'];
    foreach ($commonPrefixes as $prefixData) {
    $prefix = $prefixData['Prefix'];
    $dir["name"]=basename($prefix);
    $dir["date"]="";
    $listdata["data"]["list"]["dirs"][]=$dir;
    }
$listdata["data"]["dirnum"]=count($listdata["data"]["list"]["dirs"]);
}

    //print_r($listdata);
    return $listdata;
    
}
function parsePerfix($f)
{
    $f = trim($f, '/');
    $f = trim($f, './');
    if($f!="")
    {
        $f=$f."/";
    }
    return $f;
    
}

function parseDatetime($datetimeString)
{
    $pattern = '/(\d{4}-\d{2}-\d{2})\w+(\d{2}:\d{2}:\d{2})/';
    preg_match($pattern, $datetimeString, $matches);

    if (count($matches) === 3) {
        $datePart = $matches[1];
        $timePart = $matches[2];
        $formattedDatetime = date("Y-m-d H:i:s", strtotime("$datePart $timePart"));
    }
    return $formattedDatetime;
}
function getDownloadUrl($key)
{
    global $tencent,$cosClient;
    try {    
    $bucket = $tencent["bucketId"]; //存储桶，格式：BucketName-APPID
    $key = $key;  //此处的 key 为对象键，对象键是对象在存储桶中的唯一标识
    $signedUrl = $cosClient->getObjectUrl($bucket, $key, '+10 minutes');
    // 请求成功
    return $signedUrl;
} catch (\Exception $e) {
    // 请求失败
    print_r($e);
}

}



