<?php

namespace Core;

class App{

    protected $controller = "HomeController";
    protected $action="index";
    protected $params=[];
    
    function __construct(){

        $arr = $this->UrlProcess();
        $controllerName = $this -> controller;
        //default ControllerFile
        $controllerFile = CONTROLLER_FOLDER_NAME . $controllerName . ".php";  

        // Controller -----------------------
        if (isset($arr[0])){
            $controllerFile = CONTROLLER_FOLDER_NAME . ucfirst($arr[0]) . "Controller.php";        
            if( file_exists($controllerFile) ){
                $controllerName = ucfirst($arr[0]) . 'Controller';
            }
            else {
                die("That controller $controllerFile is not exists");
            }
            array_shift($arr);
        } 
        

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
        #$class = $diContianer->get_class($class);
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