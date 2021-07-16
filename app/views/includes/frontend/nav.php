<?php
    $user = (new \App\Models\UserModel())->authUser();
    $cart = [];
    if (isset($_COOKIE['cart'])) {
        $json = $_COOKIE['cart'];
        $cart = json_decode($json, true);
    }
    $count = 0;
    foreach ($cart as $item) {
        $count += $item['num'];
    }
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
        </ul>
        
        <div class="float-right">
            <a href="cart.php">
                <button type="button" class="btn btn-lg btn-primary">
                    Cart <span class="badge badge-light"><?= $count ?></span>
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