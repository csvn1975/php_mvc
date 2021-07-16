<?php
if (isset($pageTitle))
    echo "<center><h1> $pageTitle </h1></center>";
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        mainMenuActive('#dashboard');
    });
</script>