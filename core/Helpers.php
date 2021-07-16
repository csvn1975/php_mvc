<?php

namespace Core;

class Helpers
{

    /**
     * @parameter 
     * $filesField: fieldname
     * $targetPath: save folder
     */
    public static function uploadFile($fileField, $targetPath)
    {

        if (!isset($_FILES[$fileField]))
            die('$_FILES[' . $fileField . '] does not found');

        if (!file_exists($targetPath)) {
            if (!mkdir($targetPath, 0777, true)) {
                die("The folder $targetPath does not exist");
            }
        }

        if (!empty($_FILES) && $_FILES[$fileField]['name']) {
            $targetFileName =  uniqid() . '_' . $_FILES[$fileField]['name'];
            if (move_uploaded_file($_FILES[$fileField]["tmp_name"], $targetPath . $targetFileName))
                return $targetFileName;
        } else {
            return false;
        }
    }

     /**
     * @parameter 
     * $filesField: fieldname
     * $targetPath: save folder
     */
    public static function uploadMultiFiles($filesField, $targetPath)
    {

        if (!isset($_FILES[$filesField]))
            die('$_FILES[' . $filesField . '] does not found');

        if (!file_exists($targetPath)) {
            die("The folder $targetPath does not exist");
        }

        $filesList = [];

        if (!empty($_FILES)) {
            try {
                foreach ($_FILES[$filesField]['tmp_name'] as $index => $file) {
                    $targetFileName = uniqid() . '_' . $_FILES[$filesField]['name'][$index];
                    if (move_uploaded_file($file, $targetPath . $targetFileName))
                        array_push($filesList, $targetFileName);
                };
                return true;
            } catch (\Throwable $th) {
                return false;
            }
        } else {
            echo "choose a file please";
            return false;
        }
        return $filesList;
    }

    /**
     * @parameter mixed $value
     */
    public static function gerCurrency($value)
    {
        $fmt = new \NumberFormatter( 'de_DE', \NumberFormatter::CURRENCY );
        return $fmt->formatCurrency($value, "EUR") ;
    }

    public static function formatDate($date)
    {
        return date('F j, Y, g:i a', strtotime($date));
    }
    
    /**
     * @string $date
     */
    public static function gerDateFormat(String $date)
    {
        return date('d.m.Y', strtotime($date));
    }

    /**
     * @string $date
     */
    public static function gerDateTimeFormat(String $date)
    {
        return date('d.m.Y H:i:s', strtotime($date));
    }
    
    public static function textShorten($text, $limit = 400)
    {
        $text = $text . " ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text . ".....";
        return $text;
    }

    public static function validation($data)
    {
        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
}
