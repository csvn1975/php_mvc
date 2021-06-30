<?php
if (isset($pageTitle))
    echo "<center><h1> $pageTitle  </h1></center>";
?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col" style="width:10%">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php 
            $index = ($page_index -1) * PER_PAGE_COUNT;
            foreach ($categories as $category) : 
                $index++;
            ?>
            <tr>
                <td><?= $index ?></td>
                <td><?= $category['name'] ?></td>
                <td>
                    <a href="/category/edit/<?= $category['id'] ?>" class="btn btn-primary btn-sm edit mr-1"><i class="fas fa-pen"></i></a>
                    <a href="/category/delete/<?= $category['id'] ?>" class="btn btn-danger btn-sm delete mr-1"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<!-- Pagination -->
<nav aria-label="Page navigation">
  <ul class="pagination">

    <li class="page-item" data="prev">
        <a class="page-link" href="/category/index/<?= ($page_index-1) ?>">Previous</a>
    </li>

    <?php for ($i = 1; $i <= $page_count ; $i++) : ?>
         <li class="page-item" data="number">
         <a class="page-link" href="/category/index/<?= $i ?>"><?= $i ?></a></li>
    <?php endfor ?>    

    <li class="page-item" data="next">
        <a class="page-link" href="/category/index/<?= ($page_index + 1) ?>" >Next</a>
    </li>

  </ul>
</nav>
<!-- end Pagination -->

<script>
    let currentPage = "<?php echo $page_index; ?>"
    let pageCount = "<?php echo $page_count; ?>"    
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#category', '#category-list')
        setPaginationStatus(currentPage, pageCount)
    });
</script>