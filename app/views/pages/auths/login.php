<?php
  includeView('includes/head');
?>


    <div class="col-12 bg-danger py-5" style="height: 80vh">
        <?php
         if (isset($pageTitle))
            echo "<center><h1 class ='py-5 text-white'> $pageTitle </h1></center>";
        ?>
        <div class="row">
            <div class="col-4 offset-4 bg-light px-5 py-5">
                <form id="login" 
                    action="/auth/login"    
                    method="POST" >
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" 
                        rules="required"
                        name="email"
                        value ="hd5@admin.com"
                        class="form-control" id="email">
                        <span class="form-message"> Please enter a email</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" 
                        rules="required"
                        name="password"
                        value ="123456"
                        class="form-control" id="password">
                        <span class="form-message"> Please enter a password</span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Submit</button>
                    <?php if (isset($error)) 
                           echo "<span class='form-message'> $error </span>"; ?>
                </form>
            </div>
        </div>
    </div>
<?php
    includeView('includes/foot')
?>



<script>
     var validatorForm = new validator('#login');
</script>