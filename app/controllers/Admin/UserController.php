<?php

namespace App\Controllers\Admin;

class UserController extends \Core\BaseController {
    
    private $UserModel;

    public function __construct(){

        $this->userModel = new \App\Models\UserModel();
        if (!$this->userModel->authUser()) 
            $this->redirect('/admin');   
    }
    
    function index($page = 1) {
        if ($page<1) $page = 1;

        $total = $this -> userModel -> getTotal();
        $offset = PER_PAGE_COUNT * ($page -1); 

        $users =  $this->userModel -> getAll([
            'whereNot' => ['id' => $this->userModel->authUser()['id']]
        ]);

        $page_count = ceil($total / PER_PAGE_COUNT);

        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.users.index',
            'users' => $users,
            'page_count' => $page_count,
            'page_index' => $page,
            'pageTitle' => 'User List'
        ]);
    }


    /* form create new item */
    function create() {
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.users.create',
            'pageTitle' => 'Create new user'
        ]);
    }

    /* submit create new item  */
    function store() {
        $fileName  = \Core\Helpers::uploadFile('avatar', '.' . AVATAR_FOLDER);
        if ($fileName) {
            $user = [
                'name' => $_POST['fullname'], 
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'avatar' => $fileName, 
            ];

            $this->userModel->store($user);
            $this -> redirect('/admin/user');
        }
        else  {
            $this ->redirect('/admin/user/create');
        }
    }
    
    # form edit
    function edit($id) {       
        $user =  $this->userModel->findByID($id); 
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.users.edit',
            'user' => $user,
            'pageTitle' => 'Edit user '
        ]); 
    }
 
    /* submit edit item  
    */
    function update($id) {

        $fileName  = \Core\Helpers::uploadFile('avatar', '.' . AVATAR_FOLDER);
        $fileName = $fileName ? $fileName : getPOST('oldAvatar');

        if ($fileName) {
            $user = [
                'name' => getPOST('fullname'), 
                'email' => getPOST('email'), 
                'avatar' => $fileName, 
            ];
            
            /* check change password */
            $password = getPOST('password');
            if ($password != 'OLD_VALUE' ){
                $user['password'] = password_hash($password, PASSWORD_BCRYPT); 
            }
            
            $this->userModel->save($id, $user);
            $this ->redirect('/admin/user');
        }
        else  {
            $this ->redirect('/admin/user/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $this -> userModel->destroy($id);
        $this -> redirect('/admin/user');
    }
}
?>