<?php
   echo '<h1>PHP MVC</h1>';
   $user = (new \App\Models\UserModel())->authUser();
?>

<div class="float-right">
   <?php if (!$user) : ?>
      <a class="btn btn-success btn-lg"
         href = "/admin"
      >Login</a>
      <a class="btn btn-success btn-lg"
         href = "/admin/register"
      >Register</a>
      <?php else : ?>
         <a class="btn btn-success btn-lg"
         href = "/admin/logout"
      ><?= $user['name'] ?> | Logout</a>
   <?php endif ?> 
</div>

