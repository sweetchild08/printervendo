<?php
include '../config.php';
if(isset($_POST['checkcolors'])){
    $file=FILES_DIR.$client['dirname'].'/'.$_POST['checkcolors'];
    if(substr($file,strpos($file,'.')+1)=='pdf'){
        // $out=shell_exec('pwd');
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
            // print_r($out);
            echo json_encode($res);
        }
        else
        {
            http_response_code(403);
            echo json_encode(['msg'=>'document not found','status'=>'error']);
        }
    }
    else{
        http_response_code(403);
        echo json_encode(['msg'=>'invalid filetype','status'=>'error']);
    }

}