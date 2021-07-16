<?php

namespace App\Controllers;
 
class HomeController extends \Core\BaseController {
    
    function index() {
        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.home.index',
            'pageTitle' => 'Home Page',
        ]);
    }
    
}

?>