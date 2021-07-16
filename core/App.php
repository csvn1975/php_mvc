<?php

namespace Core;

class App{

    protected $controller = "";
    protected $action="index";
    protected $params=[];

    function __construct(){

        $arr = $this->UrlProcess();
        $isAdmin = (isset($arr[0]) && strtolower($arr[0]) == 'admin');
        
        $this->controller = $isAdmin ? "AdminController" : 'HomeController';
        $controllerPath = CONTROLLER_FOLDER_NAME . ($isAdmin ? 'admin/'  : '') ;

        // admin/login, admin/logout, admin/register  => controller admin
        // admin/product/edit => path admin, controller/action: product/edit

        if ($isAdmin  && isset($arr[1])) {
           if ( !in_array( strtolower($arr[1]), ['login', 'logout', 'register']) )
                array_shift($arr);
        }
            
       /*  print_r($arr);
        die(); */

        //default 
        $controllerName = $this -> controller;
        $controllerFile = $controllerPath . $controllerName . ".php";  
       
        // Controller -----------------------
        if (isset($arr[0])){
            $controllerFile = $controllerPath . ucfirst($arr[0]) . "Controller.php";        
            
            if( file_exists($controllerFile) ){
                $controllerName = ucfirst($arr[0]) . 'Controller';
            }
            else {
                die("That controller $controllerFile is not exists");
            }
            array_shift($arr);
        } 
        
        if ($isAdmin) 
            $controllerName = '\\App\\Controllers\\Admin\\' . $controllerName;
        else 
            $controllerName = '\\App\\Controllers\\' . $controllerName;
       
        require_once $controllerFile;
          $this->controller = new $controllerName;


        // Action ---------------------------
        if(isset($arr[0])){
            if ( method_exists( $this->controller , $arr[0]) ){
                $this->action = $arr[0];
            } 
            else {
                die("That method $arr[0] does not exist in the controller \"$controllerName\"");
            }
            array_shift($arr);
        }
        
    
        $this->params = $arr ? array_values($arr) : [];
        
        //call controller/method
        call_user_func_array([ $this -> controller, $this -> action], $this -> params );
    }

    /**
     * @ return Array
     */
    function UrlProcess(){

        if( isset($_GET["url"]) ){ 
            $url = filter_var(trim($_GET["url"], "/"));
        } 
        else {
            $url = preg_replace( "/^\//", '', $_SERVER['REQUEST_URI']);
        }
        if ($url)
           return explode("/", $url);
    }

}
?>