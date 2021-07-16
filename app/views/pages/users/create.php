<?php
if (isset($pageTitle))
    echo "<h1> $pageTitle </h1>";
?>

<div class="row">
    <div class="col-6 offset-3">
        <form action="#" method="post" 


            id="user-create" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" rules="required" placeholder="Please enter a fullname" 
                name="fullname" class="form-control" id="fullname">
                <span class="form-message"> Please enter a Fullname</span>
            </div>
            
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" rules="required" name="email"
                placeholder="Please enter a email address" 
                class="form-control" id="email">
                <span class="form-message"> Please enter a email</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" rules="required" name="password"
                placeholder="Please enter a password" 
                class="form-control" id="email">
                <span class="form-message"> Please enter a password</span>
            </div>

            <!-- choose Image  -->
            <div class="form-group">
                <label for="image">avatar</label><br>
                <p class="btn btn-lg btn-primary" onclick="chooseFile()">Choose Image</p>
                <input type="file" name='avatar' class="form-control-file" id="avatar" hidden>
                <label rules="required" name='image'></label><br>
                <span class="form-message"> Please choose a image </span>
            </div>

            <div class="form-group image-display">
                <img src="" name="output" alt="" id="output" width="150" max-height="150" />
            </div>
            <!-- end choose Image -->

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success">Create</button>
                <button class="btn btn-lg btn-danger" type="button" onclick="window.location = '/user';">Cancel
                </button>
            </div>
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        menuActive('#user', '#user-add')

    });

    let imageInput = document.querySelector('.form-control-file');
    let imageOutput = document.querySelector('#output');

    function chooseFile() {
        imageInput.click();
    }

    imageInput.onchange = function() {
        var ownerParent = this.parentElement;
        var imageOutputParent = imageOutput.parentElement;
        if (imageInput.files[0]) {
            ownerParent.querySelector('label[name=image]').innerText = imageInput.files[0].name;
            ownerParent.querySelector('span').setAttribute('hidden', true);
            imageOutput.src = URL.createObjectURL(imageInput.files[0]);
        }

        imageOutput.src ? imageOutputParent.classList.add('show') : imageOutputParent.classList.remove('show');
    }

    var validatorForm = new validator('#user-create');

    /* validatorForm.onsubmit = function(data) {
         console.log(data);
    } */
</script>