<?php

namespace App\Controllers;

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

        $this->loadView('layouts.default' , [
            'view' => 'pages.users.index',
            'users' => $users,
            'page_count' => $page_count,
            'page_index' => $page,
            'pageTitle' => 'User Lists '
        ]);
    }


    /* form create new item */
    function create() {
        $this->loadView('layouts.default' , [
            'view' => 'pages.users.create',
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
            $this -> redirect('/user');
        }
        else  {
            $this ->redirect('/user/create');
        }
    }
    
    # form edit
    function edit($id) {       
        $user =  $this->userModel->findByID($id); 
        $this->loadView('layouts.default' , [
            'view' => 'pages.users.edit',
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
            if (getPOST('password') !== 'OLD_VALUE' )
                $user['password'] = password_hash(getPOST('password'), PASSWORD_BCRYPT); 
            

            $this->userModel->save($id, $user);
            $this ->redirect('/user');
        }
        else  {
            $this ->redirect('/user/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $this -> userModel->destroy($id);
        $this -> redirect('/user');
    }
}
?>