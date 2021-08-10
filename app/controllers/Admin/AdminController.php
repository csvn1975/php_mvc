<?php

namespace App\Controllers\Admin;

class AdminController extends \Core\BaseController {
    
    private $userModel;
    public function __construct()
    
    {
        $this->loadModel('UserModel');
        $this->userModel = new \App\Models\UserModel();
    }

    function index($message = '') {
        /* authenticated_? */
        if ($this->userModel->authUser()) {
            $this->redirect('/admin/dashboard');

        } else {
            $this->loadView('pages.backend.admin.login', [
                'pageTitle' => 'Login',
                'message' => $message
            ]);
        }
    }

    function login()
    {
        $email = getPOST('email');
        $password = getPOST('password');

        if (!$email || !$password) {
            $this->goBack();
        } 
        else 
        {
            $error = makeAuthToken($email, $password);
            if ($error) {   
                $this->loadView('pages.backend.admin.login', [
                    'pageTitle' => 'Login',
                    'message' => $error
                ]);
            } 
            else {
                $this->redirect('/admin/dashboard');
            }
        }
    }

    function logout() {
        $this->userModel->deleteLoginToken();
        setcookie("token", "", time() - 3600, '/');
        $this->redirect('/admin/dashboard');
    }

    function register($data = [])
    {
        $register = [
            'view' => 'pages.backend.admin.register',
            'pageTitle' => 'REGISTRIERUNG',
        ];

        if (!empty($data)){
            $register = array_merge($data, $register);
        }  
        
        $this->loadView('layouts.admin', $register);
        
    }

    function create() {

        $fullname = getPOST('fullname'); 
        $email  = getPOST('email'); 
        $password = getPOST('password');
  
        $user = $this->userModel->create('users', [
            'name' => $fullname,
            'email' => $email,
            'password' => password_hash(getPOST('password'), PASSWORD_BCRYPT),
        ]);

        if ($user) { 
            if (!makeAuthToken($email, $password)) {
                $this->redirect('/admin/dashboard');
            } 
        } else {
            $this->register([
                'message' => 'Can not register.',
                'fullname' => $fullname,
                'email' => $email,
                'password' => $password]);    
        }    
    }

}
?>