<?php
if (isset($pageTitle))
    echo "<center><h1> $pageTitle </h1></center>";
?>

<div class="row">
    <div class="col-6">
        <form action="/category/save/<?= $category['id'] ?>" id="category-edit" method="POST">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Category</label>
                <select class="form-control" name="category_id" id="categories">
                    <option value=-1></option>
                    <?php echo $htmlOptionCategory ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="category_name" rules="required" value="<?php echo $category['name'] ?>" placeholder="Category name">
                <span class="form-message"> Please enter a category</span>
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-success">Save</button>
                <button class="btn btn-lg btn-danger">Cancel
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#category', '#category-list');
    });

    var validatorForm = new validator('#category-edit');
    validatorForm.onsubmit = function(data) {}
</script>