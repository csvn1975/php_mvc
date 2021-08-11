<?php

namespace App\Controllers\Admin;

class CategoryController extends \Core\BaseController
{

    private $categoryModel;

    public function __construct()
    {
        $this->loadModel('CategoryModel');
        $this->categoryModel = new \App\Models\CategoryModel();
        
        if (!(new \App\Models\userModel())->authUser()) 
            $this->redirect('/admin');   
    }

    function index($page = 1)
    {
        if ($page < 1)  $page = 1;
        $total = $this->categoryModel->getTotal();
        $offset = PER_PAGE_COUNT * ($page - 1);
        $categories =  $this->categoryModel->getAll(
            [
                'select' => 'id, name, parent',
                'order by' => 'name asc',
                'limit' => $offset . ", " . PER_PAGE_COUNT,
            ]
        );

        $page_count = ceil($total / PER_PAGE_COUNT);

        # var_dump($categories);

        $this->loadView('layouts.admin', [
            'view' => 'pages.backend.categories.index',
            'categories' => $categories,
            'pageTitle' => 'Category List',
            'page_count' => $page_count,
            'page_index' => $page,
        ]);
    }

    function delete($id)
    {
        $this->categoryModel->destroy($id);
        $this->redirect('/admin/category');
    }

    function create()
    {
        $htmlOptionCategory = $this->categoryModel->categorySelectOption();
        $this->loadView('layouts.admin', [
            'view' => 'pages.backend.categories.create',
            'pageTitle' => 'Create  new category',
            'htmlOptionCategory' => $htmlOptionCategory,
        ]);
    }

    function store()
    {
        $this->categoryModel->store([
            'parent' =>  getPOST('category_id'),
            'name' =>  getPOST('category_name'),
        ]);
        $this->redirect('/admin/category');
    }

    #form edit
    function edit($id)
    {
        $category = $this->categoryModel->findById($id);

        # selected parent        
        $htmlOptionCategory = $this->categoryModel->categorySelectOption($category['parent'], $id);

        $this->loadView('layouts.admin', [
            'view' => 'pages.backend.categories.edit',
            'pageTitle' => 'Editing category',
            'htmlOptionCategory' => $htmlOptionCategory,
            'category' => $category,
        ]);
    }

    function save($id)
    {
        $this->categoryModel->save($id, [
            'parent' =>  getPOST('category_id'),
            'name' =>  getPOST('category_name'),
        ]);

        $this->redirect('/admin/category');
    }
}
