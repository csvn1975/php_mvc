<?php

/**
 * array $main: [id, title]
 * array $subMenus: [[id, href, title]...]
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

function makeMenu($id, $href, $title)
{
    echo "<li id= '$id' class='main-menu main-menu__item'>
            <a class='sub-menu__item--link' href='$href'>$title</a></li>";
}
?>


<ul id="main-menu">

    <?php
    makeMenu("dashboard", "/dashboard", "Dashboard");

    makeSubMenu(["category", "Categories"],[['category-list', '/category', 'Category Lists'], 
        ['category-add', '/category/create', 'Add new category']]
    );

    makeSubMenu(["product", "Products"], [
        ['product-list', '/product', 'Product Lists'],
        ['product-add', '/product/create', 'Add new product']
    ]);

    makeSubMenu(["user", "Users"], [
        ['user-list', '/user', 'User Lists'],
        ['user-add', '/user/create', 'Add new user']
    ]);
    ?>

</ul>