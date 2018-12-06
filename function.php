<?php
/**
 * Function class 
 * Hz xs 函数库
 */
header('Content-type:text/html;Charset=utf-8');

/**
 * 1. 函数名 -- 函数用途
 * 2. 参数 -- 参数说明
 * 3. 返回值 -- 返回说明
 * 4. demo -- 函数用法
 */



// 1. encryptDecrypt($key,$string,$decrypt) 	  PHP加密解密---使用了base64和MD5加密和解密
// 2. generateRandomString($len)				        PHP生成随机字符串
// 3. getExtension($filename)					          PHP获取(绝对路径)文件扩展名（后缀）
// * 18. retrieve($url)							            php url(http)获取文件名 -- 正则匹配
// * 19. getExt($url)							              php获取文件扩展名 
// 4. formatSize($size)							            PHP获取文件大小并格式化
// 5. stringParser($string,$replace_array)		  PHP替换标签字符
// 6. listDirFiles($DirPath)					          PHP列出目录下的文件名
// 7. curPageURL()								              PHP获取当前页面URL
// 8. download($filename)						            PHP强制下载文件
// 9. cutStr()									                PHP截取字符串长度
// 10. getIp()									                PHP获取客户端真实IP
// 11. injCheck($sql_str)						            PHP防止SQL注入
// 12. message($msgTitle,$message,$jumpUrl)		  PHP页面提示与跳转
// 13. changeTimeType($seconds)					        PHP计算时长
// 14. logResult($str='')						            PHP写日志
// 15. getthemonth($date)						            PHP获取当前月份第一天和最后一天
// 16. visit($url)								              PHP检查是否宕机
// 17. highlighter($text, $words)				        PHP搜索和高亮显示字符串中的关键字
// 20. ajaxReturn($info,$status = 0,$data = null)                     php AJAX返回json数据
// 21. imgSetWord($pic,$word,$font,$size,$x,$y,$newpic='',$print=0)   php图片设置文字水印
// 22. scanDirs($dir,$filter=array())           PHP扫描目录（过滤指定目录/文件）,返回目录/文件 数组
// 23. getFiles($path)                          PHP获取目录下的文件和目录(一级)
// 24. copyDir($strSrcDir, $strDstDir)          PHP复制目录
// 25. delDir($path)                            PHP删除目录级目录下文件
// 26. handle_isolation_str_to_arr($str,$delimiter)     将一个字符串通过一个特定的分割符拆分成多个字符串
// 27. curl_get($api)                           curl接口调用【get】
// 28. curl_post($api,$data)                    curl接口调用【post】
// 
// 
// 


if (!function_exists('encryptDecrypt')) {
  /**
   * 1. PHP加密解密---使用了base64和MD5加密和解密
   * PHP加密和解密函数可以用来加密一些有用的字符串存放在数据库里，并且通过可逆解密字符串
   * @param  [type] $key     [ 处理字串的类型 ]
   * @param  [type] $string  [ 需要加密的字串 ]
   * @param  [type] $decrypt [ 0 加密, 1 解密 ]
   * @return [type]          [ 字符串 ]
   *
   * demo
   * 
   * 以下是将字符串“Helloweba欢迎您”分别加密和解密
   * 加密：
   * echo encryptDecrypt('password', 'Helloweba欢迎您',0);
   * 解密：
   * echo encryptDecrypt('password', 'z0JAx4qMwcF+db5TNbp/xwdUM84snRsXvvpXuaCa4Bk=',1);
   */
  function encryptDecrypt($key, $string, $decrypt){
      if($decrypt){
          $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
          return $decrypted;
      }else{
          $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
          return $encrypted;
      }
  }
}


if (!function_exists('generateRandomString')) {
  /**
   * 2. PHP生成随机字符串
   * @param  integer $length [ 生成字符串长度 ,不填默认为10 ]
   * @return [type]          [ 返回一个指定长度的随机字符串 ]
   *
   * demo
   * generateRandomString(5);
   */
  function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, strlen($characters) - 1)];
      }
      return $randomString;
  }
}

if (!function_exists('getExtension')) {
  /**
   * 3. PHP获取文件扩展名（后缀）
   * @param  [type] $filename [指定文件名]
   * @return [type]           [返回文件后缀(.)之后文件类型]
   *
   * demo
   * $filename = '我的文档.doc'; 
   * echo getExtension($filename);
   * 
   */
  function getExtension($filename){
    $myext = substr($filename, strrpos($filename, '.'));
    return str_replace('.','',$myext);
  }
}


if (!function_exists('formatSize')) {
  /**
   * 4. PHP获取文件大小并格式化
   * @param  [type] $size [ 文件大小 ]
   * @return [type]       [ 文件大小单位转换 ]
   *
   * demo
   * $thefile = filesize('test_file.mp3'); 
   * echo formatSize($thefile);
   */
  function formatSize($size) {
      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
      if ($size == 0) { 
          return('n/a'); 
      } else {
        return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]); 
      }
  }
}


if (!function_exists('stringParser')) {
  /**
   * 5. PHP替换标签字符 -- 有时我们需要将字符串、模板标签替换成指定的内容
   * @param  [type] $string   [ 带有自定义模板的字串 ]
   * @param  [type] $replacer [ 自定义模板替换对应数组 ]
   * @return [type]           [ 返回替换之后的函数 ]
   *
   * demo
   *
   * $string = 'The {b}anchor text{/b} is the {b}actual word{/b} or words used {br}to describe the link {br}itself'; 
   * $replace_array = array('{b}' => '<b>','{/b}' => '</b>','{br}' => '<br />'); 
   *
   * echo stringParser($string,$replace_array);
   */
  function stringParser($string,$replacer){
      $result = str_replace(array_keys($replacer), array_values($replacer),$string);
      return $result;
  }
}


if (!function_exists('listDirFiles')) {
  /**
   * 6. PHP列出目录下的文件名
   * @param  [type] $DirPath [ 检索的文件目录 ]
   * @return [type]          [ 返回指定目录下的文件名(不包含目录) ]
   *
   * demo
   * 
   * listDirFiles('D:/phpStudy/WWW/other/');
   */
  function listDirFiles($DirPath){
      if($dir = opendir($DirPath)){
           while(($file = readdir($dir))!== false){
                  if(!is_dir($DirPath.$file))
                  {
                      echo "filename: $file<br />";
                  }
           }
      }
  }
}

if (!function_exists('curPageURL')) {
  /**
   * 7. PHP获取当前页面URL
   * @return [type] [ 返回访问当前页的url ]
   *
   * demo
   *
   * echo curPageURL();
   */
  function curPageURL() {
      $pageURL = 'http';
      if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
      $pageURL .= "://";
      if ($_SERVER["SERVER_PORT"] != "80") {
          $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
      } else {
          $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
      }
      return $pageURL;
  }
}


if (!function_exists('download')) {
  /**
   * 8. PHP强制下载文件
   * @param  [type] $filename [ 下载文件目录 ]
   * @return [type]           [ 文件下载选项 ]
   *
   * demo
   *
   * download(dirname(__FILE__).'/test.zip')
   */
  function download($filename){
      if ((isset($filename))&&(file_exists($filename))){
         header("Content-length: ".filesize($filename));
         header('Content-Type: application/octet-stream');
         header('Content-Disposition: attachment; filename="' . $filename . '"');
         readfile("$filename");
      } else {
         echo "Looks like file does not exist!";
      }
  }
}

if (!function_exists('cutStr')) {
  /**
   * 9. PHP截取字符串长度
   * @param  [type]  $string [ 待处理字符串 ]
   * @param  [type]  $sublen [ 截取长度 ]
   * @param  integer $start  [ 开始位置 默认为 0]
   * @param  string  $code   [ 字符编码 Utf-8,gb2312 默认为Utf-8 ]
   * @return [type]          [ 处理后的字串 ]
   */
  function cutStr($string, $sublen, $start = 0, $code = 'UTF-8'){
      if($code == 'UTF-8'){
          $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
          preg_match_all($pa, $string, $t_string);
    
          if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
          return join('', array_slice($t_string[0], $start, $sublen));
      }else{
          $start = $start*2;
          $sublen = $sublen*2;
          $strlen = strlen($string);
          $tmpstr = '';
    
          for($i=0; $i<$strlen; $i++){
              if($i>=$start && $i<($start+$sublen)){
                  if(ord(substr($string, $i, 1))>129){
                      $tmpstr.= substr($string, $i, 2);
                  }else{
                      $tmpstr.= substr($string, $i, 1);
                  }
              }
              if(ord(substr($string, $i, 1))>129) $i++;
          }
          if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
          return $tmpstr;
      }
  }
}

if (!function_exists('getIp')) {
  /**
   * 10. 获取用户真实IP
   * @return [type] [ 返回IP地址 ]
   *
   * demo 
   * echo getIp();
   */
  function getIp() {
      if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
          $ip = getenv("HTTP_CLIENT_IP");
      else
          if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
              $ip = getenv("HTTP_X_FORWARDED_FOR");
          else
              if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                  $ip = getenv("REMOTE_ADDR");
              else
                  if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                      $ip = $_SERVER['REMOTE_ADDR'];
                  else
                      $ip = "unknown";
      return ($ip);
  }
}

if (!function_exists('injCheck')) {
  /**
   * 11. PHP防止SQL注入
   * @param  [type] $sql_str [ 待过滤字符串内容 ]
   * @return [type]          [ 返回字符串内容，含有非法字符，返回非法字符！ ]
   *
   * demo
   * echo injCheck('123456');
   */
  function injCheck($sql_str) { 
      $check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
      if ($check) {
          echo '非法字符！！';
          exit;
      } else {
          return $sql_str;
      }
  }
}

if (!function_exists('message')) {
  /**
   * 12. PHP页面提示与跳转--提示用户操作结果，并跳转到相关页面
   * @param  [type] $msgTitle [提示标题]
   * @param  [type] $message  [提示内容]
   * @param  [type] $jumpUrl  [跳转链接]
   * @return [type]           [description]
   *
   * demo
   * message('操作提示','操作成功！','http://www.helloweba.com/');
   */
  function message($msgTitle,$message,$jumpUrl){
      $str = '<!DOCTYPE HTML>';
      $str .= '<html>';
      $str .= '<head>';
      $str .= '<meta charset="utf-8">';
      $str .= '<title>页面提示</title>';
      $str .= '<style type="text/css">';
      $str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}';
      $str .= '</style>';
      $str .= '</head>';
      $str .= '<body>';
      $str .= '<div class="message">';
      $str .= '<h3>'.$msgTitle.'</h3>';
      $str .= '<div class="msg_txt">';
      $str .= '<h4 class="red">'.$message.'</h4>';
      $str .= '<p>系统将在 <span id="seconds" style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="'.$jumpUrl.'">这里</a> 跳转</p>';
      $str .= "<script>setTimeout('location.replace(\'".$jumpUrl."\')',2000)</script>";
      // $str .= "<script>setTimeout('function(){var s = document.getElementById(\'seconds\'); alert(s) }',2000)</script>";
      $str .= '</div>';
      $str .= '</div>';
      $str .= '</body>';
      $str .= '</html>';
      echo $str;
  }
}


if (!function_exists('changeTimeType')) {
  /**
   * 13. PHP计算时长--需要计算当前时间距离某个时间点的时长
   * @param  [type] $seconds [ 时间戳/时间戳  ]
   * @return [type]          [ 返回 hh:mm:ss 格式时间 ]
   *
   * demo
   * $seconds = 3712;
   * echo changeTimeType($seconds);
   */
  function changeTimeType($seconds) {
      if ($seconds > 3600) {
          $hours = intval($seconds / 3600);
          $minutes = $seconds % 3600;
          $time = $hours . ":" . gmstrftime('%M:%S', $minutes);
      } else {
          $time = gmstrftime('%H:%M:%S', $seconds);
      }
      return $time;
  }
}


if (!function_exists('logResult')) {
  /**
   * 14. PHP写日志
   * @param  string $str [ 填写日志内容 ]
   * @return [type]      [ 日志填写内容 ]
   *
   * demo
   * logResult('获取数据reselt=xxx');
   * 
   */
  function logResult($file_path,$str='') {
      $fp = fopen($file_path,"a");
      flock($fp, LOCK_EX) ;
      fwrite($fp,"执行日期：".strftime("%Y%m%d%H%M%S",time())."\n".$str."\n");
      flock($fp, LOCK_UN);
      fclose($fp);
  }
}


if (!function_exists('getthemonth')) {
  /**
   * 15. PHP获取当前月份第一天和最后一天
   * @param  [type] $date [ date('Y-m-d') ]
   * @return [type]       [ 返回本月第一天日期和最后一天日期 ]
   *
   * demo
   * $today = date("Y-m-d");
   * $day=getthemonth($today); 
   * echo "当月的第一天: ".$day[0]." 当月的最后一天: ".$day[1];
   */
  function getthemonth($date){
     $firstday = date('Y-m-01', strtotime($date));
     $lastday = date('Y-m-d', strtotime("$firstday +1 month -1 day"));
     return array($firstday,$lastday);
  }
}


if (!function_exists('visit')) {
  /**
   * 16. 测试出问题--待解决
   * 
   * PHP检查是否宕机 -- 定时任务去执行访问网站上的固定页面，如果访问出错就有可能是宕机了
   * @param  [type] $url [ 检查服务器上可访问 url ]
   * @return [type]      [返回 true or false]
   *
   * demo
   * if (visit("http://www.qq.com")) 
   * 	echo "www.qq.com is OK"; 
   * else 
   * 	echo "Website DOWN";
   */
  function visit($url){ 
    $agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
    $ch=curl_init(); 
    curl_setopt ($ch, CURLOPT_URL,$url ); 
    curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt ($ch,CURLOPT_VERBOSE,false); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch,CURLOPT_SSLVERSION,3); 
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, FALSE); 
    $page=curl_exec($ch); 
    // echo curl_error($ch); 
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
    curl_close($ch); 
    if($httpcode>=200 && $httpcode<300) return true; 
    else return false; 
  }
}


if (!function_exists('highlighter')) {
  /**
   * 17. PHP搜索和高亮显示字符串中的关键字
   * @param  [type] $text  [description]
   * @param  [type] $words [description]
   * @return [type]        [description]
   */
  function highlighter($text, $words) { 
    $split_words = explode(" " , $words ); 
    foreach($split_words as $word) { 
      $color = "#4285F4"; 
      $text = preg_replace("/($word)/i" , "<span style=\"color:".$color.";\"><b>$1</b></span>", $text ); 
    } 
    return $text; 
  }
}


if (!function_exists('retrieve')) {
  /**
   * 18. php获取文件名 -- 正则匹配
   * @param  [type] $url [http/https url]
   * @return [type]      [ 连接对应的文件名 ]
   */
  function retrieve($url) { 
  	preg_match('/\/([^\/]+\.[a-z]+)[^\/]*$/',$url,$match); 
  	return $match[1]; 
  }
}


if (!function_exists('getExt')) {
  /**
   * 19. php获取文件扩展名 
   * @param  [type] $url [ 文件地址 ]
   * @return [type]      [ 文件后缀名 ]
   */
  function getExt($url) {
  	$path=parse_url($url); 
  	$str=explode('.',$path['path']); 
  	return $str[1]; 
  } 
}


if (!function_exists('ajaxReturn')) {
  /**
   * 20. ajax返回 json数据
   * @param  [type]  $info   [ 提示信息 ]
   * @param  integer $status [ 状态 ]
   * @param  [type]  $data   [ 数据 ]
   * @return [type]          [ json数据 ]
   *
   * demo
   * 
   * $data = array('新增数据','修改数据','更新数据');
   * $result = ajaxReturn('操作成功','0',$data);
   * echo $result;
   * 
   */
  function ajaxReturn($info,$status=0,$data=null){
    $result = array();
    $result['status'] = $status;
    $result['info'] = $info;
    $result['data'] = $data;

    // 返回json格式数据到客户端 包含状态信息
    header('COntent-Type:text/html;charset=utf-8');
    return json_encode($result);
  }
}


if (!function_exists('imgSetWord')) {
  /**
   * 21. 图片设置文字水印
   * @param  [type]  $pic    [ 原图片路径 ]
   * @param  [type]  $word   [ 水印文字 ]
   * @param  [type]  $font   [ 文字字体 ]
   * @param  [type]  $size   [ 字体大小 ]
   * @param  [type]  $x      [ 水印x坐标 ]
   * @param  [type]  $y      [ 水印y坐标 ]
   * @param  string  $newpic [ 生成新图片 ]
   * @param  integer $print  [ 是否打印图片 ]
   * @return [type]          [ 打印或生成图片 ]
   *
   * demo
   *
   * $font = './font/yahei.ttf';
   * imgSetWord('./image/02.png','何泽小生',$font,12,0,100,'./image/test.png',0);
   * 
   */
  function imgSetWord($pic,$word,$font,$size,$x,$y,$newpic='',$print=0){
    if($newpic == ''){
      $newpic = $pic;
    }
    // 图片对象
    $dst = imagecreatefromstring(file_get_contents($pic));

    // 字体颜色
    $color = imagecolorallocate($dst, 255, 312, 95);
    imagefttext($dst, $size, 0, $x, $y, $color, $font, $word);

    // 图片宽高等信息
    list($dst_w, $dst_h, $dst_type) = getimagesize($pic);

    if($print == 0){
      switch($dst_type){
        case 1: // GIF
          imagegif($dst,$newpic);
          break;
        case 2: // JPG
          imagejpeg($dst,$newpic);
          break;
        case 3: // PNG
          imagepng($dst,$newpic);
          break;
        default:
          break;    
      }
      return $newpic;
    }else{
      switch($dst_type){
        case 1: // GIF
          header('Content-Type: image/gif');
          imagegif($dst);
          break;
        case 2: //JPEG
          header('Content-Type: image/jpeg');
          imagejpeg($dst);
          break;
        case 3:
          header('Content-Type: image/png');
          imagepng($dst);
          break;
        default:
          break;
      }
    }
  }
}


if (!function_exists('scanDirs')) {
  /**
   * 22. 扫描目录（过滤指定目录/文件）,返回目录/文件 数组
   * @param  [type] $dir    [ 待扫描目录路径 ]
   * @param  array  $filter [ 过滤文件名 ]
   * @return [type]         [ 扫描指定目录下文件/目录数组（一级） ]
   *
   * demo
   * 
   * $filter = array('yahei.ttf');
   * $file_names = scanDirs('.',$filter);
   * var_dump($file_names);
   * 
   */
  function scanDirs($dir,$filter=array()){
    // 扫描文件
    $files = scandir($dir);

    // 过滤指定目录
    $filter[] = '.';
    $filter[] = '..';
    $filter[] = '.git';

    // 去文件夹数组和过滤文件夹数组的交集
    $file = array_diff($files,$filter);
    $file = array_values($file);

    return $file;
  }
}


if (!function_exists('getFiles')) {
  /**
   * 23. 获取目录下的文件和目录(一级)
   * @param  [type] $path [ 路径 ]
   * @return [type]       [ 返回目录中文件名和目录名的数组集合 ]
   *
   * demo
   *
   * $data = getFiles('./');
   * var_dump($data);
   * 
   */
  function getFiles($path){
    // 判断是否为目录 true 连接 '/*' 获取目录下所有文件
    if(is_dir($path)){
      $path = $path.'/*';
    }

    $data = array();
    $files = array();
    $dirs = array();
    $n = 0;
    $m = 0;

    $temp = glob($path);
    // 遍历文件
    foreach($temp as $key=>$file){
      if(is_file($file)){
        $files[$n]['path'] = $file;
        $files[$n]['name'] = basename($file);
        $files[$n]['size'] = filesize($file);
        $files[$n]['lasttime'] = date("Y-m-d H:i:s",filemtime($file));
        $files[$n]['createtime'] = date("Y-m-d H:i:s",filectime($file));

        $n++;
      }
      if(is_dir($file)){
        $dirs[$m]['path'] = $file;
        $dirs[$m]['name'] = basename($file);
        $dirs[$m]['size'] = filesize($file);
        $dirs[$m]['lasttime'] = date("Y-m-d H:i:s",filemtime($file));
        $dirs[$m]['createtime'] = date("Y-m-d H:i:s",filectime($file));

        $m++;
      }
    }
    $data['file'] = $files;
    $data['dir'] = $dirs;

    return $data;
  }
}


if (!function_exists('copyDir')) {
  /**
   * 24. PHP复制目录
   * @param  [type] $strSrcDir [ 复制源目录 ]
   * @param  [type] $strDstDir [ 生成目录名 ]
   * @return [type]            [ true / false ]
   *
   * demo
   *
   * echo copyDir('./image','./images');
   * 
   */
  function copyDir($strSrcDir, $strDstDir){
    $dir = opendir( $strSrcDir );
    if(!$dir){
      return false;
    }
    if(!is_dir( $strDstDir )){
      if(!mkdir( $strDstDir )){
        return false;
      }
    }

    while( false !== ($file = readdir($dir))){
      if($file=='.' || $file=='..'){
        continue;
      }
      if(is_dir( $strSrcDir.'/'.$file )){
        if(!copydir( $strSrcDir.'/'.$file , $strDstDir.'/'.$file)){
          return false;
        }
      }else{
        if(!copy( $strSrcDir.'/'.$file , $strDstDir.'/'.$file)){
          return false;
        }
      }
    }

    closedir($dir);
    return true;
  }
}


if (!function_exists('delDir')) {
  /**
   * 25. 删除目录级目录下文件
   * @param  [type] $path [ 指定路径 ]
   * @return [type]       [description]
   *
   * demo
   *
   * delDir("./images");
   */
  function delDir($path){
    // 如果是目录则继续
    if(is_dir($path)){

      if(is_dir($path)){
        $len = strlen($path);
        if(substr($path, $len-1,$len)!=='/'){
          $path.='/';
        }
      }
      // 扫描目录下文件
      $p = scandir($path);
      // 遍历文件名
      foreach($p as $val){
        // 排除'.','..'
        if($val!=='.' && $val!=='..'){
          // 路径拼接后检验是目录递归回调 delDir() 函数
          if(is_dir($path.$val)){
            delDir($path.$val.'/');
            // 目录清空后删除空文件夹
            @rmdir($path.$val.'/');
          }else{
            // 如果是文件直接删除
            unlink($path.$val);
          }
        }
      }
      @rmdir($path);
      
    }else{
      // 如果是文件直接删除
      if(is_file($path)){
        unlink($path);
      }
    }
    return true;
  }
}


if (!function_exists('handle_isolation_str_to_arr')) {
  /**
   * 26. 将一个字符串通过一个特定的分割符拆分成多个字符串
   * @param  [type] $str       [ 待处理字符串 ]
   * @param  [type] $delimiter [ 分割字符 ]
   * @return [type]            [ 拆分之后的数组 ]
   *
   * demo
   *
   * $str='123##345##567##789##912';
   * $array = handle_isolation_str_to_arr($str,'##');
   * var_dump($array);
   */
  function handle_isolation_str_to_arr($str,$delimiter){
    if ($str){
      $res=explode($delimiter,$str);
      $i=0;
      foreach ($res as $k=>$v){
        if (empty($v)){
          array_splice($res,($k-$i),1);
          ++$i;
        }
      }
      return $res;
    }else{
      return false;
    }
  }
}


if (!function_exists('curl_get')) {
  /**
   * 27. curl接口调用【get】
   * @param  [type] $api [ 接口地址]
   * @return [type]      [ 成功返回数据，失败返回false ]
   * 
   * demo
   *
   * echo curl_get('http://localhost/other/my_php/data.php?id=1&pid=2');
   */
  function curl_get($api){
      $ch=curl_init();

      curl_setopt($ch, CURLOPT_URL, $api);
      curl_setopt($ch,CURLOPT_HEADER,FALSE);       #设置头文件的信息作为数据流输出
      curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);   #设置获取的信息以文件流的形式返回，而不是直接输出。

      $res=curl_exec($ch);

      curl_close($ch);

      return $res;
  }
}


if (!function_exists('curl_post')) {
  /**
   * 28. curl接口调用【post】
   * @param  [type] $api  [ 接口地址 ]
   * @param  [type] $data [ 传输数据 ]
   * @return [type]       [ 成功返回数据，失败返回false ]
   *
   * demo
   *
   * echo curl_post('http://localhost/other/my_php/data.php',array('id'=>'1','name'=>'zhangsan'));
   * 
   */
  function curl_post($api,$data){
      $ch = curl_init();

      curl_setopt($ch, CURLOPT_URL, $api);
      curl_setopt($ch, CURLOPT_HEADER, FALSE);        #设置头文件的信息作为数据流输出
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);        
      #设置获取的信息以文件流的形式返回，而不是直接输出。
      curl_setopt($ch, CURLOPT_POST, TRUE);      #设置post方式提交
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);       #提交数据

      $res=curl_exec($ch);

      curl_close($ch);

      return $res;
  }
}


if (!function_exists('https_request')) {
    /**
     * 29. GET,POST传参 curl调用接口链接返回状态
     * @param  [type] $url  [访问的接口链接]
     * @param  [type] $data [传参数据]
     * @return [type]       [返回url处理后的json数据]
     *
     * demo
     * echo https_request('http://localhost/other/my_php/data.php?id=1&name=zhangsan');
     * echo https_request('http://localhost/other/my_php/data.php',array('id'=>'1','name'=>'zhangsan'));
     * 
     */
    function https_request($url,$data = null){  
          $curl = curl_init();  
          curl_setopt($curl,CURLOPT_URL,$url);  
          curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);  
          curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);  
          if(!empty($data)){  
              curl_setopt($curl,CURLOPT_POST,1);  
              curl_setopt($curl,CURLOPT_POSTFIELDS,$data);  
          }  
          curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);  
          $output = curl_exec($curl);  
          curl_close($curl); 

          return $output;  
    }
}


if (!function_exists( 'my_sys_uptime' ) ) {
    /**
     * 30. 获取 linux 服务器运行时间
     * @return [type] ['天:时:分:秒']
     *
     * demo
     * 
     * echo my_sys_uptime();
     */
    function  my_sys_uptime() {

        $output='';
        if (false === ($str = @file("/proc/uptime"))) return '00:00:00 仅支持linux系统下使用！';
        $str = explode(" ", implode("", $str));
        $str = trim($str[0]);
        $min = $str / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $output .= $days."天";
        if ($hours !== 0) $output .= $hours."小时";
        if ($min !== 0) $output .= $min."分钟";
        return $output;
    }
}

if (!function_exists( 'get_area' ) ) {
  /**
   * 31. 淘宝接口：根据ip获取所在城市名称
   * @param  string $ip [ 获取城市ip，为空时为本地ip ]
   * @return [type]     [ ip真实存在是返回查询数组，不存在 返回NULL ]
   *
   * demo
   *
   * var_dump(get_area());
   * var_dump(get_area('101.132.113.116'));
   */
  function get_area($ip = ''){
    if($ip == ''){
        $ip = GetIp();
    }
    $url = "http://ip.taobao.com/service/getIpInfo.php?ip={$ip}";
    $ret = https_request($url);
    $arr = json_decode($ret,true);
    return $arr;
  }
}


