<?php

function getGET($key)
{
    return isset($_GET[$key]) ?  $_GET[$key] : '';
}

function getPOST($key)
{
    return isset($_POST[$key]) ?  $_POST[$key] : '';
}

function getCOOKIE($key) {
	return isset($_COOKIE[$key]) ? $_COOKIE[$key] : ''  ;
}

function md5Security($pwd) {
	return md5(md5($pwd).MD5_PRIVATE_KEY);
}

function gerCurrency($value){
    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::CURRENCY );
    return $fmt->formatCurrency(floatval($value), "EUR");
}

function authToken() {
    return (new \App\Models\UserModel())->authUser();  
}

/**
 * @ return error-info or null
 */ 
function makeAuthToken($email,$password) {
    
    if ($email && $password) {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->getLoginUser($email, $password);

        /* generate token */
        if (isset($user['error'])){
            return $user['error'];
        }
        else 
        {
            $token = str_shuffle($email . time());
            setcookie('token', $token, time() + 7 * 24 * 60 * 60, '/');
            $userModel->saveLoginToken($user['id'], $token);
        }
    } 
    else {
        return ['error' => 'email or password is empty'];
    }
}

function logData(string $level, string $message, ?array $data = null)
{
    $today = date('Y-m-d');
    $now = date('Y-m-d H:i:s');
    if (!is_dir(LOG_DIR)) {
        mkdir(LOG_DIR, 0777, true);
    }
    $logFile = LOG_DIR . '/log-' . $today . '.log';

    $logData = '[' . $now . '-' . $level . '] ' . $message . "\n";

    if ($data) {
        $dataString = print_r($data, true) . "\n";
        $logData .= $dataString;
    }
   
    file_put_contents($logFile, $logData, FILE_APPEND);
}

function logEnd($string = '*')
{
    logData('INFO', '<br>' . str_repeat($string ,100));
}

?>