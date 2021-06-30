<?php

namespace Core;

class Helpers{

    public static function uploadFile($fileField, $targetPath) {

        if (!isset($_FILES[$fileField])) 
           die('$_FILES[' . $fileField . '] does not found');

        if ( !file_exists($targetPath) ) {
            die ("The folder $targetPath does not exist");
        } 

        if (!empty($_FILES) && $_FILES[$fileField]['name']) {          
            $targetFileName =  uniqid() . '_' . $_FILES[$fileField]['name'];
            if ( move_uploaded_file( $_FILES[$fileField]["tmp_name"], $targetPath . $targetFileName))
                return $targetFileName; 
        }
        else {
           return false ;
        }
    }

    public static function uploadMultiFiles($filesField, $targetPath) {
     
        if (!isset($_FILES[$filesField])) 
           die('$_FILES[' . $filesField . '] does not found');

        if ( !file_exists($targetPath) ) {
            die ("The folder $targetPath does not exist");
        } 
        
        $filesList = [];
        
        if (!empty($_FILES)) { 
            try 
            {
                foreach($_FILES[$filesField]['tmp_name'] as $index => $file) {
                    $targetFileName = uniqid() . '_' . $_FILES[$filesField]['name'][$index];
                    if (move_uploaded_file($file, $targetPath . $targetFileName))
                      array_push($filesList, $targetFileName);
                };
                return true;
            } catch (\Throwable $th) 
            {
                return false;
            }
        }
        else
        {
            echo "choose a file please";
            return false;
        }
        return $filesList;
    } 

}
