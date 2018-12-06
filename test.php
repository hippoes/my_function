<?php
header('Content-type:text/html;Charset=utf-8');
include('./function.php');

// 加密函数
// var_dump(encryptDecrypt('password', '123456',0)); 

// 解密函数
// var_dump(encryptDecrypt('password', 'kcDaitlZC9y6iHGC9olX35wsuStNwEW4z9Wp2Wy27SA=',1));
 
// 生成随机字串
// var_dump(generateRandomString(5));



// 获取文件名(.)后缀
// var_dump(getExtension('1.txt'));

// 文件大小+单位格式化
/*
$size = filesize(dirname(__FILE__));
var_dump(formatSize($size));
*/

// 字符串 内部自定义模版替换
/*
$string = 'Hello words! {t} {r}!';
$replace_array = array('{t}'=>'template','{r}'=>'replace');
var_dump(stringParser($string,$replace_array));
*/

// 获取目录中的文件名 (不包含目录)
// var_dump(listDirFiles('D:/phpStudy/WWW/other/'));


// 获取当前页面url
// echo curPageURL();

// PHP强制下载文件
// download(dirname(__FILE__).'/test.zip');


// PHP截取字符串长度
// $str = 'jQuery插件实现的加载图片和页面效果';
// echo cutStr($str,15);

// PHP获取客户端真实IP
// echo getIp();

// PHP防止SQL注入
// echo injCheck('1 or 1=1');

// PHP页面提示与跳转
// message('操作提示','操作成功！','http://www.helloweba.com/');

// PHP计算时长
/*$seconds = 2712;
echo changeTimeType($seconds);*/

// PHP写日志
// logResult('./log/log.txt',"获取数据reselt=123123\r\n");


// PHP获取当前月份第一天和最后一天
/*$today = date("Y-m-d");
$day=getthemonth($today);
echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1];*/


// PHP检查是否宕机
/*if (visit("http://localhost/other/my_php/test.php")){
    echo "www.qq.com is OK"; 
}else{
    echo "Website DOWN";
}*/

// PHP搜索和高亮显示字符串中的关键字
/*$string = "基于Zepto的内容滑动插件：zepto.hwSlider.js"; 
$words = "zepto"; 
echo highlighter($string ,$words);*/


// 获取文件名
// echo retrieve(dirname(__FILE__).'/test.php');
// 获取文件后缀名
// echo getExt(dirname(__FILE__).'/test.php');


// ajaxReturn 返回json数据
/*$data = array('新增数据','修改数据','更新数据');
$result = ajaxReturn('操作成功','0',$data);
echo "<pre>";
var_dump(json_decode($result,true));
echo "</pre>";*/


// 图片加文字水印
/*$font = './font/yahei.ttf';
imgSetWord('./image/02.png','何泽小生',$font,12,0,100,'./image/test.png',1);*/

// 扫描(获取)文件目录
/*$filter = array('yahei.ttf');
$file_names = scanDirs('.',$filter);
echo "<pre>";
var_dump($file_names);
echo "</pre>";
*/

// 获取目录下的文件和目录
/*$data = getFiles('.');
echo "<pre>";
var_dump($data);
echo "</pre>";*/

// 复制目录
// echo copyDir('./image','./images');

// 删除指定目录
// delDir('./images');

// 字符串指定字符拆分
/*$str='123##345##567##869476##10823974';
$array = handle_isolation_str_to_arr($str,'##');
echo "<pre>";
var_dump($array);
echo "</pre>";*/


// echo file_get_contents('http://www.baidu.com');


// echo curl_get('http://localhost/other/my_php/data.php?id=1&pid=2');

// echo curl_get('http://localhost/other/my_php/data.php?id=1&name=zhangsan');

// echo my_sys_uptime();

//echo "<pre>";
//var_dump(get_area('101.132.113.116'));
//echo "</pre>";

//冒泡排序
/*$arr=array(101,1,43,54,62,21,66,32,78,36,76,39);
echo "<pre>";
var_dump(bubbleSort($arr));
echo "</pre>";*/


// 快速排序
/*$arr=array(101,1,43,54,62,21,66,32,78,36,76,39);
echo "<pre>";
var_dump(quickSort($arr));
echo "</pre>";*/



// 堆排序
/*$arr = array(101,2,4,5,2,4,6,3,1,2,7,8);
echo '<pre>';
var_dump(heapSort($arr));
echo '</pre>';*/

// 归并排序
/*$arr = array(101,2,4,5,2,4,6,3,1,2,7,8);
echo '<pre>';
var_dump(MergeSort($arr));
echo '</pre>';*/

$arr = array(101,2,4,5,2,4,6,3,1,2,7,8);
MergeSort($arr);
var_dump($arr);