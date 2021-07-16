<?php

namespace App\Controllers;
 
class HomeController extends \Core\BaseController {
    
    function index() {

        $this -> loadView('layouts.default', [
            'view' => 'pages.home.index'
        ] );

    }
    
    function store() {
        echo __METHOD__;
    }
}

?>