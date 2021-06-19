<?php 
function GetClientMac(){

    $ip=$_SERVER['REMOTE_ADDR'];
    $out=shell_exec('arp -a '.$ip .'');
    $hasmac=strpos($out,'at')!==false;
    if($hasmac)
    {
        $start=strpos($out,'at')+3;
        $length=strpos($out,' ',$start)-$start;
        $mac=substr($out,$start,$length);
        return $mac;
    }
}
GetClientMac(); 