<?php
$page=[
    'isprotected'=>false,
    'name'=>'login'
  ];
  include 'includes/config.php';
  include 'includes/checksession.php';
?><!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php';?>
<body>
  
<?php include 'components/msg.php' ?>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="cont/login.php" method="post">
        <h2 class="form-login-heading">Admin login</h2>
        <div class="login-wrap">
          <input name="username" type="text" class="form-control" placeholder="Username" autofocus>
          <br>
          <input name="password" type="password" class="form-control" placeholder="Password">
          <br>
          <button type="submit" name="login" class="btn btn-theme btn-block" ><i class="fa fa-lock"></i> SIGN IN</button>
        </div>
      </form>
    </div>
  </div>
  <?php include 'components/scripts.php'; ?>
  <script>
    $.backstretch("img/bg.jpg", {
      speed: 500
    });
  </script>
</body>

</html>
