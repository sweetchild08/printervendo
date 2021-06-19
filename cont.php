<?php

include 'config.php';

if(isset($_GET['trigger']))
{
    $mac=$_GET['trigger'];
    $end=strtotime(date('H:i:s').' + 15 seconds');
    $end=date('H:i:s',$end);
    $r=$db->run("select * from config where id=1");
    if($r->rowCount()==0)
    {
        $db->insert('config',['id'=>1,'mac'=>$mac,'endtime'=>$end]);
    }
    else
    {  
        if($data=$r->fetch())
        {
            // echo $data['endtime'];echo '<br>';
            // echo date('H:i:s');
            $endtime=strtotime($data['endtime']);
            if($endtime>strtotime(date('H:i:s')))
            {
                http_response_code(400);
                die('another user was on session');
            }
            $db->update('config',['mac'=>$mac,'endtime'=>$end],['id'=>1]);
            echo 'timer starts';
        }
    }
}

if(isset($_GET['coins']))
{
    $mac=$_GET['coins'];
    $r=$db->run("select credits from clients where mac=:mac",[':mac'=>$mac]);
    if($data=$r->fetch(PDO::FETCH_ASSOC))
    {
        echo json_encode($data);
    }
}
if(isset($_GET['addcoin']))
{
    $r=$db->run("select * from config where id=1");
    if($data=$r->fetch(PDO::FETCH_ASSOC))
    { 
        $mac=$data['mac'];
        $endtime=strtotime($data['endtime']);
        if($endtime>strtotime(date('H:i:s')))
        {
            $db->run("update clients set credits=credits+1 where mac=:mac",[':mac'=>$mac]);
            die("coin inserted");
        }
        die("no session detected");
    }
}

if(isset($_GET['session']))
{
    $r=$db->run("select * from config where id=1");
    if($data=$r->fetch(PDO::FETCH_ASSOC))
    {
        $endtime=strtotime($data['endtime']);
        if($endtime>strtotime(date('H:i:s')))
        {
            die('1');
        }
        die('0');
    }
}

if(isset($_GET['prices']))
{
    $r=$db->run("select * from price");
    $d=[];
    while($data=$r->fetch(PDO::FETCH_ASSOC))
    {
        array_push($d,$data);
    }
    echo json_encode($d);
}

