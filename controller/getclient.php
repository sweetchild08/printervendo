<?php

function GetClientMac($db){

    $ip=$_SERVER['REMOTE_ADDR'];
    $out=shell_exec('arp -a '.$ip .'');
    $hasmac=strpos($out,'at')!==false;
    if($hasmac)
    {
        $start=strpos($out,'at')+3;
        $length=strpos($out,' ',$start)-$start;
        $mac=substr($out,$start,$length);
        $r=$db->run('select credits from clients where mac=:mac',[':mac'=>$mac]);
        $credits=0;
        if($r->rowCount()==0)
            $db->insert('clients',['mac'=>$mac,'ip'=>$ip,'credits'=>0]);
        else
        {
            if($res=$r->fetch())
                $credits=$res['credits'];
        }
        return [
            'ip'=>$ip,
            'mac'=>$mac,
            'credits'=>$credits,
            'dirname'=>str_replace(':','',$mac)
        ];
    }

}
$client=GetClientMac($db); 