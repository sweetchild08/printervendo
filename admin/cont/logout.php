<?php
session_start();
session_destroy();
$_SESSION['msg']=[
'type'=>'error',
'msg'=>'logout successful'
];
header('location:../login.php');
?>