<?php
   echo '<center><h1>PHP MVC</h1></center>';
   $user = (new \App\Models\UserModel())->authUser();
?>
<?php if (!isset($user)) : ?>
<a class="btn btn-success btn-lg"
   href = "/auth"
>Login</a>
<?php else : ?>
   <a class="btn btn-success btn-lg"
   href = "/auth/logout"
>Logout</a>
<?php endif ?> 

