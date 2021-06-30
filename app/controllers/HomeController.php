<?php

namespace App\Controllers;

class HomeController extends \Core\BaseController {
    
    function index() {

        $this -> loadView('layouts.master', [
            'view' => 'pages.home.index'
        ] );

    }

    function store() {
        echo __METHOD__;
    }
}

?>