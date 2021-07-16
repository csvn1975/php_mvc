<?php
if (isset($pageTitle))
    echo "<h1> $pageTitle </h1>";
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Category</th>
            <th scope="col" class="text-right">Price</th>
            <th scope="col" class="text-right">Image</th>
            <th scope="col" class="text-right" style="width:15%">Action</th>
        </tr>
    </thead>

    <tbody>
        <?php 
            $row = ($page_index -1) * PER_PAGE_COUNT;
            foreach ($products as $product) : 
                $row++; ?>  
            <tr>
                <td><?= $row ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['category'] ?></td>
                <td class="text-right"><?= \Core\Helpers::gerCurrency($product['price']) ?></td>
                <td class="text-right">
                  <img style="height: 40px"  src ="<?= UPLOAD_FOLDER . $product['thumbnail']?>" />  
        
                </td>
                <td class="text-right">
                    <?= makeHTMLLinkEdit("/admin/product/edit/", $product['id']) ?>
                    <?= makeHTMLLinkDelete("/admin/product/delete/", $product['id'])?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<!-- Pagination -->
<?php if ($page_count>1) : ?>            
    <nav aria-label="Page navigation">
    <ul class="pagination">
        <li class="page-item" data="prev">
            <a class="page-link" href="/admin/product/index/<?= ($page_index-1) ?>">Previous</a>
        </li>

        <?php for ($i = 1; $i <= $page_count ; $i++) : ?>
            <li class="page-item" data="number">
            <a class="page-link" href="/admin/product/index/<?= $i ?>"><?= $i ?></a></li>
        <?php endfor ?>    

        <li class="page-item" data="next">
            <a class="page-link" href="/admin/product/index/<?= ($page_index + 1) ?>" >Next</a>
        </li>

    </ul>
    </nav>
<?php endif ?>
<!-- end Pagination -->

<script>
    let currentPage = "<?php echo $page_index; ?>"
    let pageCount = "<?php echo $page_count; ?>"    
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#product', '#product-list');
        setPaginationStatus(currentPage, pageCount)
    });
</script>