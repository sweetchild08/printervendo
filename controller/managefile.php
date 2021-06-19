<?php
include '../config.php';
if(isset($_POST['action'])){
    switch($_POST['action'])
    {
        case 'delete':
            try{
                $digits = preg_replace("/[^0-9]/", "",$_POST["filename"] ).".";
                $files = glob(FILES_DIR.$digits.'*');
                // echo $filepath = $files[0];
                $filepath= FILES_DIR.$client['dirname'].'/'.$_POST["filename"];
                

                unlink($filepath);

                $thumbfile= THUMBNAILS_DIR.$digits.'jpeg';
                unlink($thumbfile);

                $_SESSION['msg']=['type'=>'success','msg'=>'File Deleted'];

            }
            catch(Exception $e){
                $_SESSION['msg']=['type'=>'success','msg'=>'File Not Deleted'];

            }
            header('location:/');
            break;
        case 'print':
            $cups_status = shell_exec("lpstat -p -d");

            if (strpos($cups_status, 'Printing page') !== false) {
                die('Printer is busy..');
            }

            $cur_dir = getcwd();
            $digits = preg_replace("/[^0-9]/", "",$_POST["filename"] ).".";
            $files = glob(FILES_DIR.$digits.'*');
            $filepath = $files[0];
            $filename = end(explode('/',$filepath));
            $ext = end(explode('.', $filename));
            echo $filepath;

            if($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'gif' || $ext == 'pdf' ){
                $out= shell_exec("lp -d ". PRINTER ." -o media=A4 $filepath");
            }else{
                $out= shell_exec("libreoffice --headless --pt " .PRINTER. " $filepath");
            }
    }
}
