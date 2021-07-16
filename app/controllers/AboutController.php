<?php

namespace App\Controllers;
 
class AboutController extends \Core\BaseController {
    
    function index() {
        
        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.about.index',
            'pageTitle' => 'About',
        ]);
    }
    
}

?>