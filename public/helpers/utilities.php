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
    echo "dadasd";
    
    return (new Core/UserModel())->authUser();  
}

?>