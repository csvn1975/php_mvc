<?php includeView('includes.head') ?>

<div class="sidebar">
    <?php includeView('includes.sidebar') ?>
</div>

<!-- MAIN CONTENT -->
<div class="main">
    <!-- HEADER -->
    <div class="header">
        <?php includeView('includes.header') ?>
    </div>

    <div class="content">
        <?php if (isset($view))
            $view = str_replace(".", "/", $view);
        include VIEW_FOLDER_NAME . $view . ".php";
        ?>
    </div>

    <!-- FOOTER -->
    <div class="footer">
        <?php
        includeView('includes/footer')
        ?>
    </div>
</div>
<!-- END MAIN CONTENT -->
<?php
include VIEW_FOLDER_NAME . "includes/foot.php";
?>