<?php

namespace App\Controllers;
class AuthController extends \Core\BaseController  {
    
    private $userModel;
    
    public function __construct(){
        $this->loadModel('UserModel');
        $this->userModel = new \App\Models\UserModel();
    }

    function index() {
        $this->loadView('pages.auths.login', [
            'pageTitle' => 'Login', 
        ]);
    }

    function login() {
        $email = getPOST('email');
        $password = getPOST('password');
       
        $user = $this->userModel->getUser([
            "where" => ["email" => $email,
                       "password" => md5($password)
                       ],
        ]);
        
        /* generate token */
        if ($user) {
            $token = md5Security($email.time());
            $this->userModel->saveUserToken($user['id'], $token);
            setcookie('token', $token, time() + (7*24*60*60));

            $this->redirect('/dashboard');               
        } else {
            $this->loadView('pages.auths.login', [
                'pageTitle' => 'Login',
                'error' => "Login failed" 
            ]);
        }
                    
    }

    function logout() {
        /* delete von database !!! */
        $this->userModel->deleteLoginToken();
        setcookie('token', '' , time() - 100); 
        $this->redirect('/dashboard');         
    }
}
