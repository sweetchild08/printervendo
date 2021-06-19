<?php if(isset($_SESSION['msg'])){ ?>
    <div class="alert alert-<?php echo $_SESSION['msg']['type'] ?>"><?php echo $_SESSION['msg']['msg'] ?></div>
<?php } unset($_SESSION['msg']) ?>