<?php

session_start();

unset($_SESSION['user']);
$_SESSION['msg']=['type'=>'success','msg'=>'You have Logged out'];
header('location:/login.php');