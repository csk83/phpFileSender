<?php
/**
 * file sender and receiver config file
 *
 * 2013-05-06 create by csk83
 */

define('PFSR_THIS_DIR', dirname(__FILE__).DIRECTORY_SEPARATOR);

define('PFSR_SIGN_KEY', 'file_sign_key');
define('PFSR_DATA_DIR', PFSR_THIS_DIR.'files'.DIRECTORY_SEPARATOR);
define('PFSR_LOG_NAME', PFSR_THIS_DIR.'logs'.DIRECTORY_SEPARATOR.date('Y-m-dTH:i:s').'.txt');
define('PFSR_PID_DIR', PFSR_THIS_DIR.'tmp'.DIRECTORY_SEPARATOR);



// sender config
define('PFSR_SENDER_PID', PFSR_PID_DIR.'file_sender.pid');
define('PFSR_SENDER_DIR', PFSR_DATA_DIR.'out'.DIRECTORY_SEPARATOR);
define('PFSR_SENDER_SUCCESS_DIR', PFSR_DATA_DIR.'out_success'.DIRECTORY_SEPARATOR);
define('PFSR_SENDER_URL', 'http://www.mdrj.net/demo/phpFileSender/test/file_receiver.php');

// receiver config
define('PFSR_RECEIVER_DIR', PFSR_DATA_DIR.'in'.DIRECTORY_SEPARATOR);
define('PFSR_TIMEOUT', 60*10); // seconds

