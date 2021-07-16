<?php

namespace App\Controllers\Admin;

class DashboardController extends \Core\BaseController {
     
    public function __construct()
    {
        
        if (!(new \App\Models\userModel())->authUser()) 
            $this->redirect('/admin');   
    }

    function index() {
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.dashboard.index',
            'pageTitle' => 'Dashboard Page',
        ]);
    }
}
?>