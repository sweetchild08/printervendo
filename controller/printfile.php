<?php

include '../config.php';
if(isset($_POST['printfile']))
{
    // print_r($_POST);return;
    $price=computeprice($client,$db);
    $file=$_POST['printfile'];
    if($client['credits']<$price['price']){
        logger('print',$client['mac'].' print '.$file.' :failed-unsufficient credits',$db);
        die('Unsufficient Credits Please Insert more coin');
    }
    $options='-o outputorder=normal'.' ';
    $options.='-o media='.$_POST['size'].' ';
    if($_POST['pages']!='') $options.='-o page-ranges='.$_POST['pages'].' ';
    $options.='-n '.$_POST['copies'].' ';
    $file=FILES_DIR.$client['dirname'].'/'.$file;
    $comm='lp '.$options.' '.$file;
    // echo $comm='lp '.$file;
    echo $out=shell_exec($comm);
    logger('print',$client['mac'].' print '.$file.' :success',$db);
    $db->update('clients',['credits'=>$client['credits']-$price['price']],['mac'=>$client['mac']]);
    $db->insert('printlogs',[
        'client'=>$client['mac'],
        'pages'=>$price['pages'],
        'type'=>$_POST['type'],
        'size'=>$_POST['size'],
        'copies'=>$_POST['copies'],
        'credits'=>$price['price']
    ]);
}

function computeprice($client,$db){
    
    $pages=$_POST['pages'];
    $type=$_POST['type'];
    $size=$_POST['size'];
    $copies=$_POST['copies'];
    $bwprice=getprice('grayscale',$db);
    $colprice=getprice('colored',$db);
    $sizeprice=getprice($size,$db);
    $typeprice=getprice($type,$db);

    $file=strtolower($_POST['printfile']);
    $ext=substr($file,strrpos($file,'.')+1);
    if($ext=='pdf'){
        
        $file=FILES_DIR.$client['dirname'].'/'.$file;
        $out=shell_exec('gs -q  -o - -sDEVICE=inkcov '.$file);
        if(strpos($out,'error')===false){
            $a=explode("\n",$out);
            $asd=array_pop($a);
            $output=[];
            $colored_counter=0;
            $bw_counter=0;
            $colored=[];
            $bw=[];
            foreach($a as $b=>$c){
                $output[$b]=explode('  ',$c);
                $cyan=floatval($output[$b][0]);
                $magenta=floatval($output[$b][1]);
                $yellow=floatval($output[$b][2]);
                // $black=substr($output[$b][3],0,strpos($output[$b][3],' '));
                // foreach(explode('  ',$c) as $colvals){
                //     if(int)
                // }
                if($cyan>0||$magenta>0||$yellow>0){
                     $colored_counter++;
                    array_push($colored,$b+1);
                }
                else {
                    $bw_counter++;
                    array_push($bw,$b+1);
                }
            }
            $res=[
                'pages'=>sizeof($output),
                'colored' =>$colored_counter,
                'bw_counter'=>$bw_counter,
                'bwpages'=>$bw,
                'colored_pages'=>$colored
            ];
            if($pages!=''){
                $pages=explode(',',$pages);
                $pp=[];
                foreach($pages as $page){
                    if(strpos($page,'-')!==false){
                        $p=explode('-',$page);
                        for($i=$p[0];$i<=$p[1];$i++){
                            array_push($pp,$i);
                        }
                    }
                    else{
                        array_push($pp,$page);
                    }
                }
                $pages=$pp;
            }else{
                $pages=array_merge($bw,$colored);
            }
            if($type=='colored'){
                $price=sizeof(array_intersect($pages,$bw))*$sizeprice*$bwprice*$copies;
                $price+=sizeof(array_intersect($pages,$colored))*$sizeprice*$colprice*$copies;
                return ['price'=>$price,'pages'=>sizeof($pages)];
            }
            else{
                return ['price'=>sizeof($pages)*$sizeprice*$typeprice*$copies,'pages'=>sizeof($pages)];
            }
        }
    }
    return ['price'=>1*$sizeprice*$copies*$typeprice,'pages'=>sizeof($pages)];
}
function getprice($item,$con){
    $r=$con->run('select * from price where name=:name',[':name'=>$item]);
    if($res=$r->fetch()){
        return $res['price'];
    }
    return 0;
}