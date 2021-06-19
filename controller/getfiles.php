<?php
$files = array_diff(scandir(FILES_DIR.$client['dirname'],SCANDIR_SORT_DESCENDING), array('..', '.'));
    
    $i=1;
    foreach($files as $file){
	$exploded = explode(".", $file);
	$thumb_file = $exploded[0].'.jpeg';
	//$thumb_file = $exploded[0].'.'.$exploded[1];
        ?>
        <div class="scrollitem">
                <div class="row">
                        <div class="col-sm-12 text-center">
                                <img src="thumbnails/<?=$thumb_file?>" style="max-width:300px;" >                   
                        </div>
                </div>

                <div class="row">
                    <div class="col-sm-12 text-center">
                    <table class="table table-borderless">
                        <tr>
                            <td class="text-right">
                                <form class="print-form" id="print_form_<?=$i?>" action="index.php" method="post">
                                    <input type="hidden" name="filename" value="<?=$file?>">
                                    <input type="hidden" name="q" value="print">
                                    <button data-id="<?=$i?>" type="button" onclick="setdoc(this)"  data-toggle="modal" href="#printme" class="btn btn-primary">Print</button> 
                                </form>                             
                            </td>
                            <td class="text-left">
                                <form action="/controller/managefile.php" method="post">
                                    <input type="hidden" name="filename" value="<?=$file?>">
                                    <button type="submit" name="action" value="delete" class="btn btn-danger">Del</button>             
                                </form>
                            </td>
                        </tr>                
                    </table>
            

                    </div>
                </div>
                <br>
        </div>
        <?php
	$i++;
    }