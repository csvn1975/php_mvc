<?php

namespace App\Controllers;
 
class ContactController extends \Core\BaseController {
    
    function index() {
        
        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.contacts.index',
            'pageTitle' => 'Contact',
        ]);
    }
    
}

?>