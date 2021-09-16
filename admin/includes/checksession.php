<?php
if(!isset($page['public']))
{
    if($page['isprotected']==true)
    {
        if(!isset($_SESSION['user']))
        {
            $_SESSION['msg']=['type'=>'error','msg'=>'You must login first'];
            header('location:/admin/login.php');
            return;
        }
        else
        {
            if($page['name']=='login'){
                $_SESSION['msg']=['type'=>'error','msg'=>'You are already logged in'];
                header('location:/admin/index.php');
                return;
            }
        }
    }
    else
    {
        if(isset($_SESSION['user']))
        {
            if($page['name']!='home'){
                $_SESSION['msg']=['type'=>'error','msg'=>'You are already logged in'];
                header('location:/admin/index.php');
                return;
            }
        }
    }
}
