<?php

namespace App\Controllers;

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
            $this->redirect('/dashboard');

        } else {
            $this->loadView('pages.admin.login', [
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
                $this->loadView('pages.admin.login', [
                    'pageTitle' => 'Login',
                    'message' => $error
                ]);
            } 
            else {
                $this->redirect('/dashboard');
            }
        }
    }

    function logout() {
        $this->userModel->deleteLoginToken();
        setcookie("token", "", time() - 3600, '/');
        $this->redirect('/dashboard');
    }

    function register($message = '')
    {
        $this->loadView('layouts.default', [
            'view' => 'pages.admin.register',
            'pageTitle' => 'REGISTRIERUNG',
            'message' => $message,
        ]);
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

        if ($user){ 
            if (makeAuthToken($email, $password)) {
                $this->redirect('/dashboard');
            } 
        }   
    }
}
?>