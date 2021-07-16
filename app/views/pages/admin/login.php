<?php includeView('includes.head') ?>
    <div class="col-12 bg-danger rounded" style="height: 100vh">
        <?php
        if (isset($pageTitle))
            echo "<center><h1 class ='py-5 text-white'> $pageTitle </h1></center>";
        ?>
        <div class="row">
            <div class="col-4 offset-4 bg-light rounded px-5 py-5">
                <form id="login" 
                    action = "/admin/login"
                    method="POST">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" rules="required|email" 
                        placeholder="Enter a password"
                        name="email" 
                        class="form-control" id="email">
                        <span class="form-message"> Please enter a valid email</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" rules="required" 
                        name="password" 
                        placeholder="Enter a password"
                        class="form-control" id="password">
                        <span class="form-message"> Please enter a password</span>
                    </div>
                    <?php if (isset($message))
                        echo "<span class='text-danger mb-1 d-block'> $message </span>";
                    ?>
                    <button type="submit" 
                    name="submit" class="btn btn-lg btn-primary">Login</button>
                    <button type="button" 
                        onclick="window.location='/dashboard'"
                    name="cancel" class="btn btn-lg btn-danger">Cancel</button>
                    <?= "<p class='mt-2'>I'm a new user. <a href='/admin/register'>Here register</a></p>"; ?>
                </form>
            </div>
        </div>
    </div>

    <script>
        var validatorForm = new validator('#login');
    </script>
<?php includeView('includes.head') ?>