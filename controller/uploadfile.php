<?php

include '../config.php';

if($_FILES['file'])
{
            $file_type = $_FILES['file']['type'];
        
            if (!in_array($file_type, $allowed_types)) {
                die('Unsupported file type! Allowed: image, pdf, doc, docx, xls, xlsx, ppt, pptx');
            }
        
            $filename = strtotime("now");
            if (!file_exists(FILES_DIR  .$client['dirname'])) {
                mkdir(FILES_DIR  .$client['dirname'], 0777, true);
            }

            $extension = strtolower(preg_replace('/\W/', '', pathinfo($_FILES["file"]["name"])['extension']));
            $target_file = FILES_DIR  .$client['dirname'].'/'. $filename . "." . $extension;
        
            move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' ) {
                $orifile    = $target_file;
        
            } else {
                $orifile    = $target_file.'[0]';
            }
        
            $thumbfile  = THUMBNAILS_DIR . $filename . '.jpeg';
            shell_exec("convert $orifile $thumbfile");

            
}
include 'getfiles.php';