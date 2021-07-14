<?php

namespace App\Controllers;

class DashboardController extends \Core\BaseController {
        
    function index() {

        $this->loadView('layouts.default' , [
            'view' => 'pages.dashboard.index',
            'pageTitle' => 'Dashboard Page', 
        ]);
    }

    
}

?>