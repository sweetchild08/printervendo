<?php

if(isset($_POST['reqid'])){
    $id=$_POST['reqid'];
    $comm="cancel ".$id;
    echo $out=shell_exec($comm);
}