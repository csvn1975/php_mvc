<?php

namespace Classes;

    class Messages {          
        function __construct(){
 
        }

        public function getAlerts(){
            $data = [
                [
                    'image'  => 'img/undraw_profile_1.svg',
                    'color'  => 'bg-success', 
                    'href'  => '#',   
                    'message' => 'Hi there! I am wondering if you can help me with a problem I\'ve been having.',
                    'username' => 'Emily Fowler · 58m'
                ],
                [
                    'image'  => 'img/undraw_profile_2.svg',
                    'color'  => 'bg-success', 
                    'href'  => '#',   
                    'message' => 'I have the photos that you ordered last month, how would you like them sent to you?',
                    'username' => 'Jae Chun · 1d'
                ],

                [
                    'image'  => 'img/undraw_profile_2.svg',
                    'color'  => 'bg-success', 
                    'href'  => '#',   
                    'message' => 'Last month\'s report looks great, I am very happy with the progress so far, keep up the good work!',
                    'username' => 'Morgan Alvarez · 2d'
                ],

                [
                    'image'  => 'img/undraw_profile_3.svg',
                    'color'  => 'bg-warning', 
                    'href'  => '#',   
                    'message' => 'Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren\'t good...',
                    'username' => 'Chicken the Dog · 2w'
                ],

      
            ];
            return $data;    
        }

        public function showMessages(){
            $data = $this->getAlerts();
            
            $output='
                <h6 class="dropdown-header">
                    Message Center
                </h6>';

                foreach($data as $row){
                    $output .='
                        <a class="dropdown-item d-flex align-items-center" href="' .$row['href']. '">
                        <div class="dropdown-list-image mr-3">
                            <img class="rounded-circle" src="' .$row['image']. '"alt="">
                            <div class="status-indicator ' .$row['color']. '"></div>
                        </div>
                        <div>
                            <div class="text-truncate">' .$row['message']. '</div>
                            <div class="small text-gray-500">' .$row['username']. '</div>
                        </div>
                    </a>
                    ';
                };  
            $output .='<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>';
            return $output;
        }
}

?>