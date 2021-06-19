<?php
    include '../helper/config.php';
    if(isset($_POST['register']))
    {
        $email=$_POST['email'] ?? '';
        $username=$_POST['username'] ?? '';
        $password=$_POST['password'] ?? '';
        $confirmpassword=$_POST['confirmpassword'] ?? '';
        if($password===$confirmpassword)
        {
            if($username==''||$email==''||$password=='')
            {
                $_SESSION['msg']=['type'=>'danger','msg'=>'*Please Complete Fields'];
                header("location:/register.php");
                return;
            }
            try
            {
                $val=[
                    'email'=>$email,
                    'username'=>$username,
                    'password'=>md5($password)
                ];
                $db->insert('user',$val);
                $_SESSION['msg']=['type'=>'success','msg'=>'Registration Successful'];
                header("location:/login.php");
            }
            catch(Exception $e)
            {
                $mes=$e->getMessage();
                if(strpos(strtolower($mes),'duplicate')!==false)
                {
                    $_SESSION['msg']=['type'=>'danger','msg'=>'username already taken, choose another one'];
                    header('location:/register.php');
                }
                else
                {
                    $_SESSION['msg']=['type'=>'danger','msg'=>$e->getMessage()];
                    header('location:/register.php');
                }
            }
        }
        else
        {
            $_SESSION['msg']=['type'=>'danger','msg'=>'Password Dont Match'];
            header('location:/register.php');
        }
    }
    else
    {
        $_SESSION['msg']=['type'=>'danger','msg'=>'Request Error'];
        header('location:/register.php');
    }


?>;