<?php
$redirect=false;
if(!isset($page['public']))
{
    if($page['isprotected'])
    {
        if(!isset($_SESSION['user']))
        {
            $_SESSION['msg']=['type'=>'danger','msg'=>'You must login first'];
            header('location:/login.php');
            $redirect=true;
        }
    }
    else
    {
        if(isset($_SESSION['user']))
        {
            $_SESSION['msg']=['type'=>'danger','msg'=>'You are already logged in'];
            header('location:/home.php');
            $redirect=true;
        }
    }
}