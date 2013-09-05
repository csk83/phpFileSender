<?php
/**
 * file receiver
 *
 * 2013-05-06 create by csk83
 */

define('THE_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);

require THE_DIR.'file_config.php';



$k = (isset($_POST['k']) && !is_array($_POST['k'])) ? $_POST['k'] : '';
if(empty($k)){
    exit('1 file key null.');
}

$s = (isset($_POST['s']) && !is_array($_POST['s'])) ? $_POST['s'] : '';
if(empty($s)){
    exit('2 sign data null.');
}

$t = md5(PFSR_SIGN_KEY . $k . PFSR_SIGN_KEY);
if($t != $s){
    exit('3 data be changed.');
}

if(!isset($_FILES['f'])){
    exit('4 no file be uploaded.');
}
$file = $_FILES['f'];
if(isset($file['error']) && isset($file['tmp_name']) && isset($file['name']) && isset($file['size'])){
    // 文件里面信息结构正常
}else{
    exit('5 file info not complete.');
}


$_error = $file['error'];
$_tmp_name = $file['tmp_name'];
$_name = $file['name'];
$_size = $file['size'];
//判断是否一个文件域上传多个文件信息
if(is_array($_error)){
    exit('6 multi files not support.');
}


if(is_uploaded_file($_tmp_name)){
    if($k != md5_file($_tmp_name)){
        @unlink($_tmp_name);
        exit('7 file md5 verify failed.');
    }
    $save = PFSR_RECEIVER_DIR.$_name;
    if (move_uploaded_file($_tmp_name, $save)) {
        chmod($save, 0600);
        exit('SUCCESS');
    }else{
        @unlink($_tmp_name);
        exit('8 move upload file to dir failed.');
    }
}else{
    exit('9 upload failed.');
}



