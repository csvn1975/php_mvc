<?php

namespace App\Controllers;

class CartController extends \Core\BaseController {

    private $productModel;

    function addToCart() {
        logData('INFO', "add to cart");
        try {
            $id = getPOST('id');
            if ($id) {
                $cart = new \Classes\Cart();
                $cart->add($id);

                echo json_encode ([ "status" => 200, 
                    "cartItemsCount" => $cart->quantity,
                    "message" => "Item was added to your Cart"]); 

            } else {
                echo json_encode ([ "status" => 500, 
                "message" => "Item can not add to your Cart (id is empty)"]);
            } 

        } catch (\Throwable $th) {
            echo json_encode ([ "status" => 500, 
                "message" => "Item can not add to your Cart"]);
        }
    }

    function updateCart() {
        
        try {
            $product_id = getPOST('id');
            $quantity = floatVal(getPOST('quantity'));

            if (!!$product_id) {
                $cart = new \Classes\Cart();
                $cart->update($product_id, $quantity);
                
                echo json_encode ([ "status" => 200, 
                    "cartItemsCount" => $cart->quantity,
                    
                    "totalItemPrice" => gerCurrency($cart->items[$product_id]['totalPrice']),
                    "subtotalPrice" => gerCurrency($cart->subtotalPrice),
                    "totalTaxPrice" => gerCurrency($cart->totalTaxPrice),
                    "totalPrice" => gerCurrency($cart->totalPrice),

                    "message" => "Your cart has been updated"]); 

            } else {
                echo json_encode ([ "status" => 501, 
                "message" => "Your cart can not update"]);
            } 

        } catch (\Throwable $th) {
            logData('INFO', $th);
            echo json_encode ([ "status" => 500, 
                "message" => "Your cart can not update." .  $th]);
        }
    }

    function removeCart() {
        try {
            $product_id = getPOST('id');
            if ($product_id) {
                $cart = new \Classes\Cart();
                $cart->remove($product_id);

                echo json_encode ([ "status" => 200, 

                    "cartItemsCount" => $cart->quantity,
                    "subtotalPrice" => gerCurrency( $cart->subtotalPrice),
                    "totalTaxPrice" => gerCurrency( $cart->totalTaxPrice),
                    "totalPrice" => gerCurrency($cart->totalPrice),

                    "message" => "Item was been removed from your cart"]); 

            } else {
                echo json_encode ([ "status" => 501, 
                "message" => "Your cart can not remove"]);
            } 

        } catch (\Throwable $th) {
            logData('INFO', $th);
            echo json_encode ([ "status" => 500, 
                "message" => "Your cart can not remove." .  $th]);
        }
    }

    public function list(){
        $cart = new \Classes\Cart();
        $this->loadView('layouts.master' , [
            'view' => 'pages.frontend.cart.list',
            'cart' => $cart,
            'pageTitle' => 'Cart List'
        ]);
    }

}

?>