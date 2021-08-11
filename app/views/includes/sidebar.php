<?php

/**
 * array $main: [field_id, title]
 * array $subMenus: [[field_id, href, title]...]
 */
function makeSubMenu($main, $subMenus)
{
    $html = "<li id= '$main[0]' class='main-menu main-menu__item'> 
            $main[1]<i class='fas fa-sort-down float-right'></i></li>";
    $html .= "<ul class='sub-menu'>";
    foreach ($subMenus as $item) {
        $html .= "<li class='sub-menu__item' id= '$item[0]'><a class='sub-menu__item--link' 
                    href='$item[1]'>$item[2]</a></li>";
    };
    $html .= '</ul>';

    echo $html;
}

function makeMenu($field_id, $href, $title)
{
    echo "<li id= '$field_id' class='main-menu main-menu__item'>
            <a class='sub-menu__item--link' href='$href'>$title</a></li>";
}
?>


<ul id="main-menu">

    <?php
    makeMenu("home", "/home", "Home");
    makeMenu("dashboard", "/admin/dashboard", "Dashboard");

    makeSubMenu(["category", "Categories"],[['category-list', '/admin/category', 'Category List'], 
        ['category-add', '/admin/category/create', 'Add new category']]
    );

    makeSubMenu(["product", "Products"], [
        ['product-list', '/admin/product', 'Product List'],
        ['product-add', '/admin/product/create', 'Add new product']
    ]);

    makeSubMenu(["user", "Users"], [
        ['user-list', '/admin/user', 'User List'],
        ['user-add', '/admin/user/create', 'Add new user']
    ]);
    
    ?>

</ul>