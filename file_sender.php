<?php
/**
 * file sender
 *
 * 2013-05-06 create by csk83
 */

define('THE_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);

require THE_DIR.'file_config.php';
require THE_DIR.'file_snoopy.php';

if(file_exists(PFSR_SENDER_PID)){
    exit;
}else{
    file_put_contents(PFSR_SENDER_PID, time());
}

$dir = PFSR_SENDER_DIR;
sendDirFiles($dir);

unlink(PFSR_SENDER_PID);

function sendDirFiles($dir){
    if (is_dir($dir)) {
        if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {
                if($file == '.' || $file == '..'){
                }else{
                    $file_type = filetype($dir.$file);
                    if($file_type == 'dir'){
                        sendDirFiles($dir.$file);
                    }else if($file_type == 'file'){
                        $r = sendFile($dir.$file);
                        if($r === true)
                            rename($dir.$file, PFSR_SENDER_SUCCESS_DIR.$file);
                        else{

                        }
                    }
                }
            }
            closedir($dh);
        }else{
            return false;
        }
    }else{
        return false;
    }
    return true;
}


function sendFile($file){
    $submit_url = PFSR_SENDER_URL;

    $file_md5 =  md5_file($file);
    $submit_vars = array(
        'k' => $file_md5,
        's' => md5(PFSR_SIGN_KEY . $file_md5 . PFSR_SIGN_KEY)
    );
    $submit_files = array('f' => $file);

    $snoopy = new Snoopy();
    $snoopy->set_submit_multipart();
    $snoopy->submit($submit_url, $submit_vars, $submit_files);
    $r = $snoopy->results;
    $r = trim($r);
    if($r == 'SUCCESS'){
        return true;
    }else{
        return $r;
    }
}