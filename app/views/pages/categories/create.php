<?php
if (isset($pageTitle))
    echo "<center><h1> $pageTitle </h1></center>";
?>

<div class="row">
    <div class="col-6">
        <form action="/category/store" id="category-create" method="POST">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Category</label>
                <select class="form-control" name="category_id" id="categories">
                    <option value=-1></option>
                    <?php echo $htmlOptionCategory ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="category_name" rules="required" class="form-control" placeholder="Category name">
                <span class="form-message"> Please enter a category</span>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-success">Create</button>
                <button class="btn btn-lg btn-danger">Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#product', '#product-add')
    });

    var validatorForm = new validator('#category-create');
    validatorForm.onsubmit = function(data) {}
</script>