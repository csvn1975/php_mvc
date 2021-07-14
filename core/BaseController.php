<?php

namespace Core;

class BaseController {
    
    public function redirect($route) {
        header('location:' . $route);
    }

    /**
     * @ $path: view-file with folder from folder views
     * $data: input-parameter in array
     */
    protected function loadView($path, $data = []) {
        
        /**
         * conver array in variable-name
         * view-file in format: folder.name 
         */ 
        foreach ( $data as $key => $value ) {
            $$key = $value;
        }
        
        require VIEW_FOLDER_NAME . str_replace("." , "/", $path) . ".php";
    }

    protected function loadModel($path) {
        require_once MODEL_FOLDER_NAME . str_replace(".", "/", $path) . ".php";
    }

}

?>