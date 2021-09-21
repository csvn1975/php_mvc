<?php

namespace App\Controllers;
 
class HomeController extends \Core\BaseController {
    
   
    private $productModel;
    private $categoryModel;

    public function __construct(){

        $this->productModel = new \App\Models\ProductModel();
        $this->categoryModel = new \App\Models\CategoryModel();
    
    }

    function index() {
        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.home.index',
            'pageTitle' => 'Home Page'
        ]);
    }

    
    function products($page = 1) {
        if ($page<1) $page = 1;
        $perPage = 8;
        $total = $this -> productModel -> getTotal();
        $offset = $perPage * ($page -1); 

        $products =  $this->productModel -> getAll([
            'limit' => $offset . ", " . $perPage, 
            'order by' => 'name asc',
            ]
        );
        
        $page_count = ceil($total / $perPage);

        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.products.index',
            'products' => $products,
            'page_count' => $page_count,
            'page_index' => $page,
            'pageTitle' => 'Home Page'
        ]);
    }

}

?>