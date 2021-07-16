    <div class="col-12 py-5">
        <?php
        if (isset($pageTitle))
            echo "<h1 class ='text-center text-danger'> $pageTitle </h1>";
    
        ?>

        <div class="row">
            <div class="col-4 offset-4 rounded bg-light px-5 py-5 ">
                <form id="register"
                    action="/admin/create" 
                    method="POST">
                    <div class="form-group">
                        <label for="fullname">Fullname</label>
                        <input type="text" rules="required" 
                        placeholder="Fullname"
                        name="fullname" 
                        class="form-control" id="fullname">
                        <span class="form-message"> Please enter a Fullname</span>
                    </div>
                   
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="text" rules="required|email" 
                        placeholder="Email address"
                        class="form-control" id="email">
                        <span class="form-message"> Please enter a valid email</span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" rules="required" name="password" value="123456" class="form-control" id="password">
                        <span class="form-message"> Please enter a password</span>
                    </div>

                    <div class="form-group">
                        <label for="confirm">Confirm password</label>
                        <input type="password" 
                        rules="required|confirm: 'password'"
                        placeholder="Confirm password" 
                        name="confirm" class="form-control" id="confirm">
                        <span class="form-message">Confirm password is not correct</span>
                    </div>
                    <button type="submit" class="btn btn-lg btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        //var validatorForm = new validator('#register');
    </script>