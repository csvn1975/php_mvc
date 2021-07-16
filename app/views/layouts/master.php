<?php includeView('includes.head') ?>

<!-- navbar -->
<?php includeView('includes.frontend.nav') ?>

<!-- MAIN CONTENT -->
<div>
    <!-- HEADER -->
    <?php includeView('includes.frontend.header') ?>

    <div class="content">
        <?php if (isset($view))
             $view = str_replace(".", "/", $view);
             include VIEW_FOLDER_NAME . $view . ".php";
        ?>
    </div>

    <!-- FOOTER -->
    <?php  includeView('includes.frontend.footer') ?>

</div>
<!-- END MAIN CONTENT -->


<?php
    includeView ("includes.foot");
?>