<div class="container">
    <div class="row">
        <?php
        foreach ($products as $product) 
        {
            echo '<div class="col-md-3 col-6">
            <div class="card px-3 mb-5 product-card">
            <a href="/product/detail/' . $product['id'] . '">
            <img src="' . UPLOAD_FOLDER . $product['thumbnail'] . '" style="width: 100%;"></a>
            <a href="/product/detail/' . $product['id'] . '">
            <p class="card-title">' . $product['name'] . ' </p></a>
            <div class= "d-flex justify-content-between mb-2">
                <p style="color: red">' . \Core\Helpers::gerCurrency($product['price']) . '</p>
                <button data-id = "' . $product['id'] . '" class="btn btn-ms btn-success action_add"
                data-url = "/cart/addToCart"> Add to cart </button>
            </div>
            </div>   
            </div>';
        }
        ?>
    </div>
</div>

<!-- Pagination -->
<?php if ($page_count > 1) : ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item" data="prev">
                <a class="page-link" href="/product/index/<?= ($page_index - 1) ?>">Previous</a>
            </li>

            <?php for ($i = 1; $i <= $page_count; $i++) : ?>
                <li class="page-item" data="number">
                    <a class="page-link" href="/product/index/<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor ?>

            <li class="page-item" data="next">
                <a class="page-link" href="/product/index/<?= ($page_index + 1) ?>">Next</a>
            </li>

        </ul>
    </nav>
<?php endif ?>
<!-- end Pagination -->

<script src="/public/js/actionAddToCart.js"> </script>


