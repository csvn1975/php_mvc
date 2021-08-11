<?php

namespace Classes;

    class Cart {  
        
        private $items = []; 

        protected $useCookie = false; 

        private $itemsCount = 0;
        private $quantity = 0;
        private $totalPrice = 0;
        private $subtotalPrice = 0;
        private $totalTaxPrice = 0;

        private $productModel; 

        public function __construct(){
            $this->productModel = new \App\Models\ProductModel();   
            #$this->clear(); 
            $this->loadItems(); 
            $this->calcAllValue(); 
        }


        /** 
         * Check if the cart is empty.
         * @ return bool 
         */

        public function isEmpty()
        {
          return empty(array_filter($this->items));
        }

        # save items to Cookie or Session
        private function saveItems(){
            # save to coockie or Session
            if ($this->useCookie) 
                setcookie('cart', json_encode(array_filter($this->items)), time() + 604800, "/");
            else 
                $_SESSION['cart'] = json_encode($this->items);
            
            $this->calcAllValue();
        }

        # calculate total price, quantity
        private function calcAllValue() {
             $this->resetAllValueOfItems();

             foreach ($this->items as $item) {
                $this->totalPrice += $item['totalPrice'];
                $this->subtotalPrice += $item['subtotalPrice'];
                $this->totalTaxPrice += $item['totalTaxPrice'];
                $this->itemsCount += 1;
                $this->quantity += $item['quantity'];
            }
        }

        private function resetAllValueOfItems() {
                $this->totalPrice = 0;
                $this->subtotalPrice = 0;
                $this->totalTaxPrice = 0;
                $this->itemsCount = 0;
                $this->quantity = 0;
        }

        public function __get($key)
        {   
            return $this->$key;
        }


        # load items from Cookie or Session
        private function loadItems()
	    {   
            if ($this->useCookie)
		        $this->items = json_decode ( isset ($_COOKIE['cart']) ? $_COOKIE['cart'] : '[]', true);
            else            
		        $this->items = json_decode ( isset ($_SESSION['cart']) ? $_SESSION['cart'] : '[]' , true);
	    }
       
        # load items from Cookie or Session
        public function clear()
	    {   
            $this -> items = [];
            $this -> saveItems();
	    }

        private function updateItemPrice(&$item) {
            $item['totalPrice'] =  $item['price'] * $item['quantity'];
            $item['subtotalPrice'] =  $item['totalPrice']/ 1.19;
            $item['totalTaxPrice'] =  $item['totalPrice'] - $item['subtotalPrice'];
        }   

        /* add item to cart
            $data = array(
                ....    
                'coupon'  => 'XMAS-50OFF'
                'option'  => ['size' => 36, 'color' => 'red']
            );
        */

        /* add item to cart */
        public function add($id, $quantity = 1) {
            $product = $this->productModel->findById($id);
            if ( isset($product) ){
                if ( isset($this->items[$id])) 
                {
                    $this->items[$id]['quantity'] += $quantity;
                    $this->updateItemPrice($this->items[$id]);
                }
                else {
                    $price = Floatval($product['price']);

                    $this->items[$id] = [
                        'name' => $product['name'],
                        'quantity' => $quantity,
                        'price' => $price,
                        'totalPrice' => $price * $quantity,
                        'subtotalPrice' => ( $price * $quantity /1.19 ),
                        'totalTaxPrice' => ( $price * $quantity * 0.19 / 1.19 ),
                        'thumbnail' => $product['thumbnail']
                    ];
                }
                $this->saveItems();
            }
        }

        # update item
        public function update($id, $quantity) {
            if ($this->items[$id]) {
                $this->items[$id]['quantity'] = $quantity;
                $this->updateItemPrice($this->items[$id]);                
                $this->saveItems();
            }
        }

        # delete item
        public function remove($id) {
            unset($this->items[$id]);
            $this->saveItems();
        }

        # get item by id
        public function item($id) {
            return $this->items[$id];
        }
}

?>