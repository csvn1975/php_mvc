<?php
    define('DEBUG', true);
    define('BASE_PATH', './app/');

    define ('BASE_URL', $_SERVER['SERVER_NAME']);
    define ('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);   
    define ('SITE', $_SERVER['SERVER_NAME']);

    define ('VIEW_FOLDER_NAME' , './app/views/');
    define ('MODEL_FOLDER_NAME' , './app/models/');   
    define ('CONTROLLER_FOLDER_NAME' , './app/controllers/');
    
    define ('UPLOAD_FOLDER' , '/public/upload/');

    define ('PER_PAGE_COUNT' , 7);

?>