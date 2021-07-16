<?php
if (isset($pageTitle))
    echo "<h1> $pageTitle </h1>";
?>

<div class="row">
    <div class="col-6">

    <form action="/product/update/<?= $product['id'];?>" 
            id= "product-edit"
            method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="categories">Category</label>
                <select class="form-control" rules="required" name="category_id" id="category_id">
                    <option value="" disabled>Select a category ...</option>
                    <?= $htmlOptionCategory ?>
                </select>
                <span class="form-message">Please choose a category</span>
            </div>

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" rules="required" 
                        value = "<?= $product['name']; ?>"      
                        name="product_name" id="product_name" placeholder="Enter a product name">
                <span class="form-message">Please enter a product name</span>
            </div>

            <div class="form-group">
                <label for="">Price</label>
                <input type="text" class="form-control" 
                rules="required|price" 
                name="product_price" id="product_price"

                value = "<?= $product['price'] ?>"
                placeholder="Enter a product price">
                <span class="form-message">Please enter a price (example 499,98)</span>
            </div>

            <!-- choose Image  -->
            <div class="form-group">
                <label for="image">Product image</label><br>
                <p class="btn btn-lg btn-primary" onclick="chooseFile()">Choose Image</p>
                <input type="file" name='image' class="form-control-file" id="image" hidden>
                <label rules="required" 
                    name='file-name'>
                    <?= $product['img'] ?>
                </label><br>
                <input name = "old-image" hidden value ="<?= $product['img'] ?>">
            </input> 
                <span class="form-message"> Please choose a image </span>
            </div>
            <!-- end choose Image -->

            <!-- show image -->
            <div class="form-group image-display show">
                <img src= "<?= UPLOAD_FOLDER . $product['img']; ?>"
                name="output" alt="" id="output" width="150" max-height="150" />
            </div>
            <!-- end show image -->

            <!-- button form -->
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success">Save</button>
                <button class="btn btn-lg btn-danger" type="button" onclick="window.location = '/product';">Cancel
                </button>
            </div>
            <!-- end button -->

        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#product', '#product-add')

    });

    let imageInput = document.querySelector('.form-control-file');
    let imageOutput = document.querySelector('#output');

    function chooseFile() {
        imageInput.click();
    }

    imageInput.onchange = function() {
        var ownerParent = this.parentElement;
        var imageOutputParent = imageOutput.parentElement;

        if (imageInput.files[0]) {
            ownerParent.querySelector('label[name=file-name]').innerText  = imageInput.files[0].name;
            ownerParent.querySelector('span').setAttribute('hidden', true);
            imageOutput.src = URL.createObjectURL(imageInput.files[0]);
        }
        imageOutput.src ? imageOutputParent.classList.add('show') : imageOutputParent.classList.remove('show');
    }

    var validatorForm = new validator('#product-edit');

    validatorForm.onsubmit = function(data) {
       // doSomething
    }
</script>