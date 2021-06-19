<?php

include '../helper/config.php';
if(isset($_POST['login']))
	{
		$username=$_POST['username'];
		$password=$_POST['password'];
		if($username==''||$password=='')
		{
			$_SESSION['msg']=['type'=>'danger','msg'=>'*Please Complete Fields'];
			header("location:/login.php");
			return;
		}
		if($row=$db->run("SELECT * FROM user WHERE username = :username", ['username'=>$username])->fetch())
		{
            echo $username;
			if($row['password']==md5($password))
			{
                $_SESSION['msg']=['type'=>'success','msg'=>'Login Successful'];
				$_SESSION['user']=['username'=>$username];
                header("location:/home.php");
				return;
			}
		}
        $_SESSION['msg']=['type'=>'danger','msg'=>"Invalid Credentials"];
		// header("location:/login.php");
	}