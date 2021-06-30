<?php

namespace App\Controllers;

class CategoryController extends \Core\BaseController {

    private $categoryModel;
    public function __construct(){
        $this->loadModel('CategoryModel');
        $this->categoryModel = new \App\Models\CategoryModel();
    }

    function index($page = 1) 
    {
        if ($page<1) {
            $page = 1;
        }

        $total = $this->categoryModel->getTotal();
        $offset = PER_PAGE_COUNT * ($page -1); 
    
        $categories =  $this->categoryModel -> getAll(
            ['select' => 'id, name, parent',
             'order by' => 'name asc',  
             'limit' => $offset . ", " . PER_PAGE_COUNT, 
            ]); 

        $page_count = ceil($total / PER_PAGE_COUNT);
        
        # var_dump($categories);
        
        $this -> loadView('layouts.master' , [
            'view' => 'pages.categories.index',
            'categories' => $categories,
            'pageTitle' => 'Category Lists', 
            'page_count' => $page_count,
            'page_index' => $page,
        ]);
    }

    function delete($id){
        #delete auch die children-category
        $this->categoryModel->destroy($id);
        header('location: /category');
    }



    function create() 
    {
        $htmlOptionCategory = $this -> categoryModel -> categorySelectOption();
        $this->loadView('layouts.master' , [
            'view' => 'pages.categories.create',
            'pageTitle' => 'Create  new category',
            'htmlOptionCategory' => $htmlOptionCategory,
        ]);
 
    }

    function store() {
        $catecory = [
            'parent' =>  $_POST['category_id'],
            'name' =>  $_POST['category_name'],
        ]; 
        $this -> categoryModel -> store($catecory);
        $this->redirect('/category');
    }

    #form edit
    function edit($id) {
        $category = $this -> categoryModel -> findById($id);
        
        # selected parent        
        $htmlOptionCategory = $this -> categoryModel -> categorySelectOption($category['parent'], $id);

        $this->loadView('layouts.master' , [
            'view' => 'pages.categories.edit',
            'pageTitle' => 'Editing category',
            'htmlOptionCategory' => $htmlOptionCategory,
            'category' => $category,
        ]);
    }
    
    function save($id) {
        $category = [
            'parent' =>  $_POST['category_id'],
            'name' =>  $_POST['category_name'],
        ]; 

        $this-> categoryModel -> save($id, $category);
        $this->redirect('/category');
    }


}

?>