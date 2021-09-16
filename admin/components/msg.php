<?php if(isset($_SESSION['msg'])){ ?>
    <div class="alert alert-<?php echo $_SESSION['msg']['type']=='error'?'danger':$_SESSION['msg']['type']; ?> alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>
	<strong><?=$_SESSION['msg']['type']?></strong> <?=$_SESSION['msg']['msg'] ?>
	</div>

<?php } unset($_SESSION['msg']) ?>