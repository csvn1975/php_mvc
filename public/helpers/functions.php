<?php

/** error info */
function handlingError($errorLevel, $errorstr, $errorfile, $errorline)
{
    echo "Error by file " . $errorfile . " by line " . $errorline;
    echo "Error level " . $errorLevel . " by line " . $errorline;
    echo "Error info " . $errorstr;
    exit;
}

/* class auto load */
spl_autoload_register(function ($class) {
    try {
        //code...
        $listfolder = array(__DIR__ . "/../common/", __DIR__ . "/../config/");
        foreach ($listfolder as $folder) {
            $file = $folder . $class . "php";
            if (is_file($file)) {
                require_once $file;
                return true;
            }
        }
    } catch (\Throwable $th) {
        //throw $th;
    }
});

# load view php 
function includeView($name, $data = [])
{
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    $name = str_replace(".", "/", $name);

    include VIEW_FOLDER_NAME . $name . ".php";
}

# include php
function includeFile($name)
{
    $name = str_replace(".", "/", $name);
    include $name . ".php";
}

function image_check($url)
{
    $url = trim($url);
    return is_file(urldecode($url, "/") ? $url : "/image.jpg");
}

/**
 * check active menu of sidebar => laravel admin
 */
function classGroupMenu($menu, $group)
{
    echo isset($menu[0]) && ($menu[0] == $group) ? "menu-open" : "";
}

function classGroupItem($menu, $group)
{
    echo isset($menu[0]) && ($menu[0] == $group) ? "active" : "";
}

function classMenuItem($menu, $group, $item)
{
    if (isset($menu[0]) && ($menu[0] == $group))
        echo isset($menu[1]) && ($menu[1] == $item) ? "active" : "";
    else
        echo "";
}


/**
 * HTML: delete and Edit button Lind für table
 */
function createBtnEdit($id)
{
    return `
            <button type="button" name="update" 
                id = "$id" class="btn btn-primary btn-sm edit mr-1"
                ><i class="fas fa-pen"></i>
            </button>`;
}

function createBtnDelete($id)
{
    return `
            <button type="button" name="delete"  
                id= "$id" class="btn btn-danger btn-sm delete"
            ><i class="fas fa-trash"></i></button>`;
}

function makeHTMLBtnEdit($id)
{
    return `<button type="button" name="update" id="$id" 
               class="btn btn-primary btn-sm edit mr-1">
               <i class="fas fa-pen"></i></button>`;
}

function makeHTMLBtnDelete($id, $route)
{
   return `<button type="button" name="delete" id="$id"
           class="btn btn-danger btn-sm delete mr-1">
           <i class="fas fa-trash"></i></button>`;
}

function makeHTMLLinkEdit($id, $route)
{
  $output = '<a href="' . $route . $id . '" class="btn btn-primary btn-sm edit mr-1">';
  $output .= '<i class="fas fa-pen"></i></a>';
  return $output;
}

function makeHTMLLinkDelete($id, $route)
{
  $output = '<a href="' . $route . $id . '" class="btn btn-danger btn-sm delete mr-1">';
  $output .= '<i class="fas fa-trash"></i></a>';
  return $output;
}


# ===============================================
# create Category select 
# ===============================================

function createCategoryOption($sourceArray, $seletedId ='')
{
    function recursiveCategory($source, $parent, $level, &$newArray)
    {
        if (count($source) > 0) {
            foreach ($source as $key => $value) {
                if ($value['parent'] == $parent) {
                    $value['level'] = $level;
                    $newArray[]     = $value;
                    unset($source[$key]);
                    $newParent = $value['id'];
                    recursiveCategory($source, $newParent, $level + 1, $newArray);
                }
            }
        }
    }

    $output = '';
    $arrayMenu = [];

    recursiveCategory($sourceArray, 0, 1, $arrayMenu);
    foreach ($arrayMenu as $key => $value) { 
        $seleted =  (!!$seletedId && ($value['id'] ==  $seletedId))  ? 'selected ' : '' ;

        if ($value['level'] == 1) {
            $output .= '<option ' . $seleted . ' value="' . $value['id'] . '">' . $value['name'] . '</option>';
        } 
        else 
        {
            $name = str_repeat('&nbsp;', ($value['level'] - 1) * 5) . '-' . $value['name'];
            $output .= '<option ' . $seleted . ' value="' . $value['id'] . '">' . $name . '</option>';
        }
    }
    return $output;
}

# ===============================================
# Upload File
# ===============================================

function uploadMultiFiles($filesField, $targetPath) {
    $filesList = [];
    if (!empty($_FILES)) { 
        try 
        {
            foreach($_FILES[$filesField]['tmp_name'] as $index => $file) {
                $targetFileName =  uniqid() . '_' . $_FILES[$filesField]['name'][$index];
                if (move_uploaded_file($file, $targetPath . $targetFileName))
                    array_push($filesList, $targetFileName);
            };
            echo "done";
        } catch (\Throwable $th) 
        {
            echo "failure";
        }
    }
    else
    {
        echo "choose a file please";
    }
        return $filesList;
}    

function uploadFile($fileField, $targetPath) {
    if (!empty($_FILES)) {   
        
        $targetFileName =   uniqid() . '_' .$_FILES[$fileField]['name'];

        if ( move_uploaded_file( $_FILES["file"]["tmp_name"], $targetPath . $targetFileName))
            return $targetFileName; 
    }
    else 
    {
        return  '';
    }
}
