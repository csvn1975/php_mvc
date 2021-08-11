<?php
    $user = (new \App\Models\UserModel())->authUser();
    $cartQuantity = (new \Classes\Cart())->quantity;
?>

<nav class="navbar navbar-expand-sm bg-danger navbar-dark">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="/product">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/product">Shop</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/about">About</a>
            </li>
            <?php if ($user) : ?>
            <li class="nav-item">
                <a class="nav-link" href="/admin/dashboard">dashboard</a>
            </li>
            <?php endif ?>

            
        </ul>
        
        <div class="float-right">
            <a href="/cart/list">
                <button type="button" class="btn btn-lg btn-primary">
                    Cart <span class="badge badge-light" id="cart-items-count"><?= $cartQuantity ?></span>
                </button>
            </a>

            <?php if (!$user) : ?>
                <a class="btn btn-success btn-lg" href="/admin">Login</a>
                <a class="btn btn-success btn-lg" href="/admin/register">Register</a>
            <?php else : ?>
                <a class="btn btn-success btn-lg" href="/admin/logout"><?= $user['name'] ?> | Logout</a>
            <?php endif ?>
        </div>

    </div>
</nav>