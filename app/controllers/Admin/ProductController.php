<?php

namespace App\Controllers\Admin;

class ProductController extends \Core\BaseController {
    
    private $productModel;
    private $categoryModel;

    public function __construct(){

        $this->loadModel('ProductModel');
        $this->loadModel('CategoryModel');

        $this->productModel = new \App\Models\ProductModel();
        $this->categoryModel = new \App\Models\CategoryModel();

        if (!(new \App\Models\userModel())->authUser()) 
            $this->redirect('/admin');   
    }
    
    function index($page = 1) {
        if ($page<1)
            $page = 1;

        $total = $this -> productModel -> getTotal();
        $offset = PER_PAGE_COUNT * ($page -1); 

        $products =  $this->productModel -> getAll([
            'select' => 'products.id as id, products.name, products.thumbnail, products.price, categories.name as category', 
            'limit' => $offset . ", " . PER_PAGE_COUNT, 
            'order by' => 'name asc',
            'join'  => 'left outer join categories on (products.category_id = categories.id)'
            ]
        );
        
        $page_count = ceil($total / PER_PAGE_COUNT);
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.products.index',
            'products' => $products,
            'page_count' => $page_count,
            'page_index' => $page,
            'pageTitle' => 'Product List '
        ]);
    }


    /* form create new item */
    function create() {
        $htmlOptionCategory = $this -> categoryModel -> categorySelectOption();
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.products.create',
            'htmlOptionCategory' => $htmlOptionCategory,
            'pageTitle' => 'Create new product '
        ]);
    }

    /* submit create new item  */
    function store() {

        $fileName  = \Core\Helpers::uploadFile('image', '.' . UPLOAD_FOLDER);

        if ($fileName) {
            $product = [
                'category_id'=> $_POST['category_id'], 
                'name' => $_POST['product_name'], 
                'price' => $_POST['product_price'], 
                'thumbnail' => $fileName, 
            ];

            $this->productModel->store($product);
            $this -> redirect('/admin/product');
        }
        else  {

            $this ->redirect('/admin/product/create');
        }
    }
    
    # form edit
    function edit($id) {
        
        $product =  $this->productModel->findByID($id); 
        $htmlOptionCategory = $this -> categoryModel -> categorySelectOption($product['category_id']);
        $this->loadView('layouts.admin' , [
            'view' => 'pages.backend.products.edit',
            'product' => $product,
            'htmlOptionCategory' => $htmlOptionCategory,
            'pageTitle' => 'Edit product '
        ]); 
    }
 
    /* submit edit item  
    */
    function update($id) {

        $fileName  = \Core\Helpers::uploadFile('image', '.' . UPLOAD_FOLDER);
        $fileName = $fileName ? $fileName : $_POST['old-image'];

        if ($fileName) {
            $product = [
                'category_id' => $_POST['category_id'], 
                'name' => $_POST['product_name'], 
                'price' => $_POST['product_price'], 
                'thumbnail' => $fileName, 
            ];
            $this->productModel->save($id, $product);
            $this ->redirect('/admin/product');
        }
        else  {
            $this ->redirect('/admin/product/edit/'. $id);
        }
    }

    public function delete($id)
    {
        $this -> productModel->destroy($id);
        $this -> redirect('/admin/product');
    }
}
?>