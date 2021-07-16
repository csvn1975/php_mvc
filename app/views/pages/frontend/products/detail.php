<div class="container">
	<div class="row">
		<div class="col-md-5">
			<img style="width: 100%" src="<?= UPLOAD_FOLDER . $product['thumbnail']?>">
		</div>
		<div class="col-md-7">
			<h4><?=$product['name']?></h4>
			<p style="font-size: 36px; color: red"> 
            <?= \Core\Helpers::gerCurrency($product['price']) ?></p>
            <p>
                <a class="btn btn-success" style="width: 100%; font-size: 30px;" 
                href = "/cart/addToCart/<?= $product['id']?>">Add to cart</a>
            </p>            
                <div class="col-md-12 mt-5">
                   <?= $product['detail'] ?>
              </div>
		</div>
	</div>
</div>

