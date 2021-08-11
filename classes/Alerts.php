<?php

namespace Classes;

    class Alerts {          
        function __construct(){
 
        }

        public function getAlerts(){
            $data = [

                [
                    'logo'  => 'fas fa-file-alt text-white',
                    'color' => 'bg-primary',    
                    'href'  => '#',        
                    'message' => 'A new monthly report is ready to download!',
                    'created' => 'December 12, 2019'
                ],

                [
                    'logo'  => 'fas fa-donate text-white',
                    'color' => 'bg-success',  
                    'href'  => '#',          
                    'message' => '$290.29 has been deposited into your account!',
                    'created' => 'December 07, 2019'
                ],

                [
                    'logo'  => 'fas fa-exclamation-triangle text-white',
                    'color' => 'bg-warning', 
                    'href'  => '#',           
                    'message' => 'Spending Alert: We\'ve noticed unusually high spending for your account.',
                    'created' => 'December 02, 2019'
                ],
      
            ];
            return $data;    
        }

        public function showAlerts(){
            $data = $this->getAlerts();
            $output='
                    <h6 class="dropdown-header">
                    Alerts Center
                    </h6>';

            foreach($data as $row){
                $output .='
                    <a class="dropdown-item d-flex align-items-center" href= "' .$row["href"]. '">
                        <div class="mr-3">
                            <div class="icon-circle ' .$row["color"]. '">
                                <i class="' .$row["logo"]. '"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">' .$row["created"]. '</div>
                            <span class="font-weight-bold">' .$row["message"]. '</span>
                        </div>
                    </a>
                    ';
            };  
            $output .='<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>';
            return $output;
        }
}

?>