<?php
namespace Core;
class Database {  

    static $instand;
    protected $dbcon;

    public function __construct()
    {
        if (Self::$instand == null) {
            Self::$instand = new \mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME );
            // Check connection
            if (Self::$instand -> connect_errno) {
                echo "Failed to connect to MySQL: " . Self::$instand -> connect_error;
                exit();
            }

            Self::$instand -> set_charset("utf8");
            $this->dbcon = Self::$instand;
        } 
        else {
            $this->dbcon = Self::$instand;
        }
    }
}

?>