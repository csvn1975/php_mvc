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

?>