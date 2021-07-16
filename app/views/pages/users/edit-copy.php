<?php
if (isset($pageTitle))
    echo "<h1> $pageTitle </h1>";
?>

<div class="row">
    <div class="col-6">

        <form action= "/user/update/<?= $user['id']; ?>" 
            method="post" 
            id="user-update" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" rules="required" 
                value = <?= $user['name'] ?>
                placeholder="Fullname" name="fullname" 
                class="form-control" id="fullname">
                <span class="form-message"> Please enter a Fullname</span>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" rules="required" 
                value = <?= $user['email'] ?>
                placeholder="Email address" name="email" class="form-control" id="email">
                <span class="form-message"> Please enter a email</span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                    rules="required"
                    value = "OLD_VALUE"
                    class="form-control" id="password">
                <span class="form-message"> Please enter a password</span>
            </div>

              <!-- choose Image  -->
              <div class="form-group">
                <label for="avatar">Avatar</label><br>
                <p class="btn btn-lg btn-primary" onclick="chooseFile()">Choose Image</p>
                <input type="file" name='avatar' class="form-control-file" id="avatar" hidden>
                <label rules="required" 
                    name='avatar'>
                    <?php echo $user['avatar']; ?>
                </label><br>
                <input name = "oldAvatar" hidden value ="<?php echo $user['avatar']; ?>" />
                <span class="form-message"> Please choose a image </span>
            </div>
            <!-- end choose Image -->

             <!-- show image -->
             <div class="form-group image-display show">
                <img src= "<?= AVATAR_FOLDER . $user['avatar']; ?>"
                name="output" alt="" id="output" width="150" max-height="150" />
            </div>
            <!--  end show-->

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-success">Save</button>
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
            ownerParent.querySelector('label[name=avatar]').innerText = imageInput.files[0].name;
            ownerParent.querySelector('span').setAttribute('hidden', true);
            imageOutput.src = URL.createObjectURL(imageInput.files[0]);
        }

        imageOutput.src ? imageOutputParent.classList.add('show') : imageOutputParent.classList.remove('show');
    }

    var validatorForm = new validator('#user-update');

    /* validatorForm.onsubmit = function(data) {
         console.log(data);
    } */
</script>