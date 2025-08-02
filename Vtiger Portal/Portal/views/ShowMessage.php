<?php
function ShowMeassage($Message){
    $Portal_Translate = new Language();
    $ArrayMSG = explode( ' ' , $Message);
    $TypeMSG = $ArrayMSG[0];
    unset($ArrayMSG[0]);
    $Message = implode(' ' , $ArrayMSG);
    $html = '';
    if ($TypeMSG == 'S'){
        echo '<div class="col-md-4 col-xl-12 center-block" style="margin-top:10px ">';
        echo '<div class="alert alert-avatar bg-success alert-dismissible text-center center-block text-white">';
        echo '<button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-hidden="true">×</button>';
        echo $Portal_Translate->Translate($Message);
        echo '</div>';
        echo '</div>';
    }else{
        echo '<div class="col-md-4 col-xl-12 center-block" style="margin-top:10px ">';
        echo '<div class="alert alert-avatar bg-danger-gradient alert-dismissible text-center center-block text-white">';
        echo '<button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-hidden="true">×</button>';
        echo $Portal_Translate->Translate($Message);
        echo '</div>';
        echo '</div>';
    }
    
}


?>