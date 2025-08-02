<?php

function ProcessFieldDetaile ($ModuleName = null , $ModuleLabel = null , $Blocks , $AccessFields , $ModComments = array() , $History = array() , $Data , $RelatedModules = array() , $InfoLineItem = array() , $TypeDate) {
    /*echo "<pre>";
    print_r($AccessFields);
    echo "\n" ;
    echo " </pre>" ;*/
    $Portal_Translate = new Language();
    echo '<input type="hidden" id="UsernameAuth" value="'.$_SESSION['username'].'">';
    echo '<input type="hidden" id="PsswordAuth" value="'.$_SESSION['password'].'">';
    echo '<input type="hidden" id="URLSitePO" value="'.PORTAL_URL.'">';

    if ($ModuleName === 'HelpDesk' ){ ?>
        <div class="col-md-12 col-xl-12">
            <div class="">
                <div class="card-body">
                    <div class="panel panel-primary">
                        <div class="tab-menu-heading tab-menu-heading-boxed">
                            <div class="tabs-menu-boxed">
                                <ul class="nav panel-tabs">
                                    <li><a href="#tab25" class="active" data-bs-toggle="tab"><?php echo $Portal_Translate->Translate('TAB_DETAIL_INFO'); ?></a></li>
                                    <?php
                                    if (!empty($RelatedModules)){
                                        foreach ($RelatedModules as $Related){ ?>
                                            <?php if ($Related == 'ModComments'){ ?>
                                                <li><a href="#tab26" data-bs-toggle="tab" class=""><?php echo $Portal_Translate->Translate('TAB_TICKETS'); ?></a></li>
                                            <?php } ?>
                                            <?php if ($Related == 'History'){ ?>
                                                <li><a href="#tab27" data-bs-toggle="tab" class=""><?php echo $Portal_Translate->Translate('TAB_DETAIL_MODTRACKER'); ?></a></li>
                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab25">
                                    <?php
                                    $AccessFieldsBlock = array();
                                    $i = 0 ;
                                    foreach ($Blocks as $LBL){
                                        $BlockID                 = $LBL['blockid'];
                                        $BlockName               = $LBL['blockname'];
                                        $BlockLabel              = $LBL['blocklabel'];
                                        $DisplayStatus           = $LBL['display_status'];
                                        $Sequence                = $LBL['sequence'];
                                        $AccessFieldsBlock       = array();
                                        foreach ($AccessFields as $FIE){
                                            $BlockIDField = $FIE['blockid'];
                                            $AccessEdit   = $FIE['editable'];
                                            if ($BlockIDField == $BlockID){
                                                array_push($AccessFieldsBlock , $FIE);
                                            }
                                        }
                                        if (isset($AccessFieldsBlock) && $AccessFieldsBlock != null){
                                            //echo "<pre>";print_r($AccessFieldsBlock);
                                            echo '<div class="card-status card-status-left bg-blue br-bs-7 br-ts-7"></div>';
                                            //echo '<div class="card-header" style="background-color: #f8f9fc"><h4 class="text-info">'.$BlockLabel.'</h4><div class="card-options"></div></div>';
                                            echo '<div class="col-md-12 col-xl-12"><div class=""><div class=""><div class="row">';
                                            echo "<hr style='border: 1px black solid; background-color: black; margin-top: 25px'><h4 style=''>$BlockLabel</h4><hr style='color: black'>";
                                            foreach ($AccessFieldsBlock as $LBL_FIE){
                                                $FIE_Name        = $LBL_FIE['name'];
                                                $FIE_Label       = $LBL_FIE['label'];
                                                $FIE_Mandatory   = $LBL_FIE['mandatory'] ;
                                                $FIE_ParsVTField = $LBL_FIE['parsvtfield'];
                                                $FIE_Type        = $LBL_FIE ['type'];
                                                $FIE_UIType      = $LBL_FIE['uitype'] ;
                                                $FIE_Nullable    = $LBL_FIE['nullable'] ;
                                                $FIE_Editable    = $LBL_FIE ['editable'] ;
                                                $FIE_Readonly    = $LBL_FIE ['readonly'];
                                                $FIE_Default     = $LBL_FIE ['default'];

                                                if ($FIE_Type['name'] == 'picklist'){
                                                    if ($FIE_UIType == 117){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'].'</span>';
                                                        echo ' </div>';
                                                    }
                                                    else{
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                }
                                                elseif ($FIE_Type['name'] == 'multipicklist'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    $ValueMulti = str_replace("|##|" , " .__. " , $Data[$FIE_Name]);
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$ValueMulti.'</span>';
                                                    echo ' </div>';
                                                }
                                                else if ($FIE_Type['name'] == 'phone'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-phone" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'email'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-emai" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'date'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    if ($TypeDate == 'jalali'){
                                                        $date = jdate('Y/m/d', strtotime($Data[$FIE_Name]));
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</span>';
                                                    }else{
                                                        $date = $Data[$FIE_Name];
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</span>';
                                                    }
                                                    echo ' </div>';
                                                }
                                                //Checkbox
                                                elseif ($FIE_Type['name'] == 'boolean'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    if ($Data[$FIE_Name] == 1){
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="color: green; margin-left: 5px" class="fa fa-check" data-bs-toggle="tooltip" title=""></i>'.$Portal_Translate->Translate('BOOL_YES').'</span>';
                                                    }else{
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="color: red;margin-left: 5px" class="fa fa-remove" data-bs-toggle="tooltip" title=""></i>'.$Portal_Translate->Translate('BOOL_NO').'</span>';
                                                    }
                                                    echo ' </div>';
                                                }
                                                //Rating Field
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Rating Field'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-ravelry" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //Customer Satisfaction Field
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Customer Satisfaction Field'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-ravelry" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //floating
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 7 ){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo '</div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-venus-double" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                // % Darsad
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 9 ){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder="">'.$Data[$FIE_Name].'<span style="color: #6c5ffc; font-size: 15px ; margin-left: 10px">%</span></span>';
                                                    echo ' </div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'integer' && $FIE_UIType == 7 ){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-sort-numeric-asc" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //currency
                                                elseif ($FIE_Type['name'] == 'currency' && $FIE_UIType == 71 ){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-dollar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //Web (URL)
                                                elseif ($FIE_Type['name'] == 'url' && $FIE_UIType == 17){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-external-link" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //Time
                                                elseif ($FIE_Type['name'] == 'time'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-times" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //Gregorian Date
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Gregorian Date'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo '</div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                }
                                                //DateTime
                                                elseif ($FIE_Type['name'] == 'customdatetime' ){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    if ($TypeDate == 'jalali'){
                                                        $TimeDateArr = explode(' ' , $Data[$FIE_Name]);
                                                        $DateArr     = $TimeDateArr[0];
                                                        $TimeArr     = $TimeDateArr[1];
                                                        $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$TimeArr . ' ' . $JalalyDate .'</span>';
                                                    }else{
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    }
                                                    echo ' </div>';
                                                }
                                                //DateTime
                                                elseif ($FIE_Type['name'] == 'datetime'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    if ($TypeDate == 'jalali'){
                                                        $TimeDateArr = explode(' ' , $Data[$FIE_Name]);
                                                        $DateArr     = $TimeDateArr[0];
                                                        $TimeArr     = $TimeDateArr[1];
                                                        $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$TimeArr . ' ' . $JalalyDate .'</span>';
                                                    }else{
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    }
                                                    echo ' </div>';
                                                }//upload file
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Upload field'){
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    $FileAddress   = explode('$$' , $Data[$FIE_Name])[0];
                                                    $FileName      = explode('/' , $FileAddress);
                                                    $FileName      = end($FileName);
                                                    $FileType      = explode('.' , $FileName);
                                                    $FileType      = end( $FileType);
                                                    if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo '<img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';
                                                    }
                                                    else if ($FileType === 'docx'){
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';

                                                    }
                                                    else if ($FileType === 'pdf'){
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo '<img class="br-10" src="resources/images/media/files/file.png">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';
                                                    }
                                                    else if ($FileType === 'xlsx'){
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo '<img class="br-10" src="resources/images/media/files/excel.png">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';
                                                    }
                                                    else if ($FileType === 'zip' || $FileType === 'rar'){
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';
                                                    }
                                                    else{
                                                        $ContentFile = $Data[$FIE_Name];
                                                        echo '<div class="file-image-1">';
                                                        echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                        echo '<ul class="icons">';
                                                        echo '<li>';
                                                        echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                        echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                        echo '<i class="fe fe-download"></i>';
                                                        echo '</a>';
                                                        echo '</li>';
                                                        echo '</ul>';
                                                        echo '</div>';
                                                        /* echo '<div class="file-image-1">

                                                                     <ul class="icons">
                                                                         <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                                     </ul>
                                                                     <!--<span class="file-name-1"></span>-->
                                                                 </div>';*/
                                                    }
                                                    echo ' </div>';
                                                }
                                                //Grid Field
                                                elseif ($FIE_Type['name'] == 'grid' && $FIE_ParsVTField['name'] == 'Grid Field'){
                                                    echo '<div style="padding-bottom: 10px" class="row">';
                                                    echo '<div  class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div class="col-sm-9 col-md-9">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-table" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                }
                                                //Plaque Field
                                                elseif ($FIE_Type['name'] == 'plaque' && $FIE_ParsVTField['name'] == 'Plaque Field') {
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '</label>';
                                                    echo '</div>';
                                                    echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                    $ParamsPlaque = explode('-' , $Data[$FIE_Name]);
                                                    $Params0 = $ParamsPlaque[0];
                                                    $Params1 = $ParamsPlaque[1];
                                                    $Params2 = $ParamsPlaque[2];
                                                    $Params3 = $ParamsPlaque[3];
                                                    echo  $Params3 . ' ' . '<span style="color: #0036a1">|</span>' . ' ' . $Params2 . ' ' . $Params1 . ' ' . $Params0 . ' ' . ' <img src="resources/images/pelak.png" alt="">';
                                                    echo '</div>';
                                                }
                                                //upload files
                                                elseif ($FIE_Type['name'] == 'text' && $FIE_ParsVTField['name'] == 'Upload fields'){
                                                    echo '<hr><div style="padding-bottom: 15px" class="row">';
                                                    echo '<div class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div class="col-sm-9 col-md-9">';
                                                    $MultiFiles = explode('||' , $Data[$FIE_Name]);
                                                    unset($MultiFiles[0]);
                                                    $ImgCount = 0;
                                                    foreach ($MultiFiles as $file){
                                                        $ArrayFile     = explode('$$' , $file);
                                                        $FileAddress   = $ArrayFile[0];
                                                        $FileName      = explode('/' , $FileAddress);
                                                        $FileName      = end($FileName);
                                                        $FileType      = explode('.' , $FileName);
                                                        $FileType      = end( $FileType);
                                                        if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo ' <img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i  class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType == 'docx'){
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'pdf'){
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo ' <img class="br-10" src="resources/images/media/files/file.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'xls'){
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo ' <img class="br-10" src="resources/images/media/files/excel.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'zip' || $FileType === 'rar'){
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else{
                                                            $ContentFile = $file;
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                            echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        $ImgCount++;
                                                    }
                                                    echo ' </div>';
                                                    echo ' </div><hr>';
                                                }
                                                elseif ($FIE_Type['name'] == 'text'){
                                                    echo '<div style="padding-bottom: 10px" class="row">';
                                                    echo '<div  class="col-sm-3 col-md-3">';
                                                    echo '<label for="">'.$FIE_Label.'</label>';
                                                    echo ' </div>';
                                                    echo '<div  class="col-sm-9 col-md-9">';
                                                    echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""> <i style="margin-left: 10px" class="fa fa-text-height" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                    echo ' </div>';
                                                    echo ' </div>';
                                                }
                                                else{
                                                    //echo $FIE_Name;
                                                    if ($FIE_Type['name'] == 'reference' || $FIE_Type['name'] == 'owner' ){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-rebel" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'] .'</span>';
                                                        echo ' </div>';
                                                    }else if ($FIE_ParsVTField['name'] == 'Currency name'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-money" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'] .'</span>';
                                                        echo ' </div>';
                                                    }else{
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-file-text" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                }
                                            }
                                            echo '</div></div></div></div>';
                                            unset($AccessFieldsBlock);
                                        }
                                    }
                                    ?>
                                </div><br>
                                <div class="tab-pane" id="tab26">
                                    <div class="col-md-12 col-xl-12">
                                        <div class="">
                                            <div class="">
                                                <div class="row">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="form-floating floating-label1">
                                                                        <textarea name="CommentDescription" class="form-control" placeholder="<?php $Portal_Translate->Translate('LBL_COMMENTS'); ?>" id="floatingTextarea2" style="height: 100px" required></textarea>
                                                                        <label for="floatingTextarea2"><?php echo $Portal_Translate->Translate('LBL_COMMENTS'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="file" id="formFileMultiple" name="UploadedFileComment[]" multiple>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="AddedComments" class="btn btn-lg btn-success" value="<?php echo $Portal_Translate->Translate('BTN_SUBMIT'); ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xl-12">
                                        <div class="">
                                            <div class="">
                                                <div class="row">
                                                    <hr style='border: 1px black solid; background-color: black; margin-top: 25px'>
                                                    <?php if (!empty($ModComments)){ ?>
                                                        <?php if (isset($ModComments['mainrecords'])){
                                                            echo ' <div style="height: auto" class="main-chat-body flex-2 ps ps__rtl ps--active-y" id="">
                                                            <div class="content-inner">';
                                                            $Comments = $ModComments['mainrecords'];

                                                            foreach ($Comments as $row){
                                                                $Source         = $row['source'] ;
                                                                $CreatTime      = $row['createdtime'];
                                                                $CommentContent = $row['commentcontent'];
                                                                $CustomerLabel  = $row['customer']['label'];
                                                                $Attachments    = $row['attachments'];

                                                                if ($Source == 'PORTAL'){ ?>
                                                                    <div class="media chat-left">
                                                                        <div class="avatar avatar-md brround bg-secondary-transparent">
                                                                            <i class="fe fe-user text-secondary"></i>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div style="width: 85%; min-height: 80px" class="main-msg-wrapper">
                                                                                <?php
                                                                                echo $CommentContent;
                                                                                ?>
                                                                            </div>


                                                                            <?php
                                                                            if (!empty($Attachments)){

                                                                                echo '<div style="padding-bottom: 15px;padding-right: 15px; background-color: #f0f0f5; width: 85%" class="row">';
                                                                                echo '<hr>';
                                                                                echo '<b><p style="font-size: 17px">'.$Portal_Translate->Translate('Attachments_TR').'</p></b>';
                                                                                echo '<hr>';
                                                                                $ImgCountTi = 0;
                                                                                foreach ($Attachments as $file){
                                                                                    $ArrayFile     = explode('$$' , $file);
                                                                                    $FileAddress   = $ArrayFile[0];
                                                                                    $FileName      = explode('/' , $FileAddress);
                                                                                    $FileName      = end($FileName);
                                                                                    $FileType      = explode('.' , $FileName);
                                                                                    $FileType      = end( $FileType);
                                                                                    if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i  class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType == 'docx'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType == 'pdf'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/file.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType == 'xls'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/excel.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType == 'zip' || $FileType == 'rar'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else{
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTi" data-value="'.$ImgCountTi.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTi_'.$ImgCountTi.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    $ImgCountTi++;
                                                                                }
                                                                                echo '</div>';

                                                                            }
                                                                            ?>
                                                                            <div>
                                                                                <span><?php echo $CreatTime ?></span> <a href="javascript:void(0)"><i class="icon ion-android-more-horizontal"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div><br><hr>
                                                                <?php }else{ ?>
                                                                    <div class="media flex-row-reverse chat-right">
                                                                        <div class="main-img-user online">
                                                                            <div class="avatar avatar-md brround bg-secondary-transparent">
                                                                                <i class="fe fe-user"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="media-body">
                                                                            <div style="width: 85%; min-height: 80px" class="main-msg-wrapper">
                                                                                <?php echo $CommentContent ?>
                                                                            </div>
                                                                            <?php
                                                                            if (!empty($Attachments)){

                                                                                echo '<div style="padding-bottom: 15px; background-color: #e1dfff; width: 85%" class="row">';
                                                                                echo '';
                                                                                echo '<hr>';
                                                                                echo '<b><p style="font-size: 17px">'.$Portal_Translate->Translate('Attachments_TR').'</p></b>';
                                                                                echo '<hr>';
                                                                                $ImgCountTiRe = 0;
                                                                                foreach ($Attachments as $file){
                                                                                    $ArrayFile     = explode('$$' , $file);
                                                                                    $FileAddress   = $ArrayFile[0];
                                                                                    $FileName      = explode('/' , $FileAddress);
                                                                                    $FileName      = end($FileName);
                                                                                    $FileType      = explode('.' , $FileName);
                                                                                    $FileType      = end( $FileType);
                                                                                    if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i  class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType == 'docx'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType === 'pdf'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/file.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType === 'xls'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/excel.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else if ($FileType === 'zip' || $FileType === 'rar'){
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    else{
                                                                                        $ContentFile = $file;
                                                                                        echo '<div style="border: 1px solid black" class="file-image-1">';
                                                                                        echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                                                        echo '<ul class="icons">';
                                                                                        echo '<li>';
                                                                                        echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMultiTiRe" data-value="'.$ImgCountTiRe.'">';
                                                                                        echo '<input type="hidden" id="DownloadIMGMultiTiRe_'.$ImgCountTiRe.'" name="DownloadIMG" value="'.$FileAddress.'">';
                                                                                        echo '<i class="fe fe-download"></i>';
                                                                                        echo '</a>';
                                                                                        echo '</li>';
                                                                                        echo '</ul>';
                                                                                        echo '</div>';
                                                                                    }
                                                                                    $ImgCountTiRe++;
                                                                                }
                                                                                echo '</div>';

                                                                            }
                                                                            ?>
                                                                            <div>
                                                                                <span><?php echo $CreatTime ?></span> <a href="javascript:void(0)"><i class="icon ion-android-more-horizontal"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div><br><hr style="color: black">
                                                                <?php }
                                                            }
                                                            echo '</div></div>';
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                </div></div></div></div>
                                </div>
                                <div class="tab-pane" id="tab27">
                                    <?php if (!empty($History) && $History != null) {
                                        $History = $History[0];
                                        //echo "<pre>"; print_r($History[0]);  ?>
                                        <ul class="notification">
                                            <?php foreach ($History['values'] as $key=>$values){
                                                //echo "<pre>"; print_r($key). ':' . print_r($values);
                                                ?>
                                                <li>
                                                    <div class="notification-time">
                                                        <?php
                                                        $DateTimeArray = explode(' ' , $History['modifiedtime']);
                                                        $DateModi      = $DateTimeArray[0];
                                                        $TimeModi      = $DateTimeArray[1];
                                                        $dateFilnal    = jdate('Y/m/d', strtotime($DateModi)); ?>
                                                        <span class="date"><?php echo $dateFilnal  ?></span>
                                                        <span style="font-size: 17px" class="time"><?php echo $TimeModi  ?></span>
                                                    </div>
                                                    <div class="notification-icon">
                                                        <a href="javascript:void(0);"></a>
                                                    </div>
                                                    <div class="notification-body">
                                                        <div class="media mt-0">
                                                            <div class="media-body ms-3 d-flex">
                                                                <div class="">
                                                                    <p class="mb-0 fs-13 text-dark"><?php echo $key ?></p>
                                                                    <p class="mb-0 fs-13 text-dark">
                                                                        <span><?php echo $Portal_Translate->Translate('FROM'); ?></span>
                                                                        <?php if ($values['previous'] == ''){ ?>
                                                                            <span>" "</span>
                                                                        <?php }else{ ?>
                                                                            <span><?php echo $values['previous'] ?></span>
                                                                        <?php } ?>
                                                                        <span><?php echo $Portal_Translate->Translate('TO'); ?></span>
                                                                        <?php if ($Portal_Translate == ''){ ?>
                                                                            <span>" "</span>
                                                                        <?php }else{ ?>
                                                                            <span><?php echo $values['current'] ?></span>
                                                                        <?php } ?>
                                                                        <span><?php echo $Portal_Translate->Translate('CHANG'); ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="notify-time">
                                                                    <p class="mb-0 text-muted fs-11"><?php echo $Portal_Translate->Translate('LAST_CHANGE'); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    <?php }else{ ?>
                                        <div class="alert alert-primary" role="alert">
                                            <?php echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    else{ ?>
        <div class="">
            <div class="">
                <div class="panel-body tabs-menu-body">
                    <div class="panel panel-primary">
                        <?php if ($_REQUEST['page'] !== 'Profile'){ ?>
                            <div class="tab-menu-heading tab-menu-heading-boxed">
                                <div class="tabs-menu-boxed">
                                    <!-- برگه ها -->
                                    <ul class="nav panel-tabs">
                                        <li><a href="#tab25" class="active" data-bs-toggle="tab"><?php echo $Portal_Translate->Translate('TAB_DETAIL_INFO'); ?></a></li>
                                        <?php
                                        if (!empty($RelatedModules)){
                                            foreach ($RelatedModules as $Related){ ?>
                                                <?php if ($Related == 'ModComments'){ ?>
                                                    <li><a href="#tab26" data-bs-toggle="tab" class=""><?php echo $Portal_Translate->Translate('TAB_ADD_COMMENTS'); ?></a></li>
                                                <?php } ?>
                                                <?php if ($Related == 'History'){ ?>
                                                    <li><a href="#tab27" data-bs-toggle="tab" class=""><?php echo $Portal_Translate->Translate('TAB_DETAIL_MODTRACKER'); ?></a></li>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="panel-body tabs-menu-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab25">
                                    <?php
                                    $AccessFieldsBlock = array();
                                    $i = 0 ;
                                    foreach ($Blocks as $LBL){
                                        $BlockID                 = $LBL['blockid'];
                                        $BlockName               = $LBL['blockname'];
                                        $BlockLabel              = $LBL['blocklabel'];
                                        $DisplayStatus           = $LBL['display_status'];
                                        $Sequence                = $LBL['sequence'];
                                        $AccessFieldsBlock       = array();
                                        foreach ($AccessFields as $FIE){
                                            $BlockIDField = $FIE['blockid'];
                                            $AccessEdit   = $FIE['editable'];
                                            if ($BlockIDField == $BlockID){
                                                array_push($AccessFieldsBlock , $FIE);
                                            }
                                        }
                                        if (isset($AccessFieldsBlock) && $AccessFieldsBlock != null){
                                            //echo "<pre>";print_r($AccessFieldsBlock);
                                            $BorderRight =  'card-status card-status-left bg-blue br-bs-7 br-ts-7';
                                            echo '<div class="'.$BorderRight.'"></div>';
                                            //echo '<div class="card-header" style="background-color: #f8f9fc"><h4 class="text-info">'.$BlockLabel.'</h4><div class="card-options"></div></div>';

                                            echo '<hr style="width:100% ; border: 1px black solid; background-color: black;"><div class=""><div class=""><div class=""><div class="row">';
                                            echo "<h4 style=''>$BlockLabel</h4>";

                                            foreach ($AccessFieldsBlock as $LBL_FIE){
                                                $FIE_Name        = $LBL_FIE['name'];
                                                $FIE_Label       = $LBL_FIE['label'];
                                                $FIE_Mandatory   = $LBL_FIE['mandatory'] ;
                                                $FIE_ParsVTField = $LBL_FIE['parsvtfield'];
                                                $FIE_Type        = $LBL_FIE ['type'];
                                                $FIE_UIType      = $LBL_FIE['uitype'] ;
                                                $FIE_Nullable    = $LBL_FIE['nullable'] ;
                                                $FIE_Editable    = $LBL_FIE ['editable'] ;
                                                $FIE_Readonly    = $LBL_FIE ['readonly'];
                                                $FIE_Default     = $LBL_FIE ['default'];

                                                $FiledNameByName  = explode('_' , $FIE_Name);

                                                $PlaceholderField = ''  ;
                                                $StatusMandatory  = '';
                                                $Color            = '';
                                                $Emoji            = '';

                                                if (isset($FiledNameByName[2])){
                                                    //تاریخ میلادی
                                                    if ($FiledNameByName[2] === 'gdt'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //ارجاع به
                                                    if ($FiledNameByName[2] === 'id'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-rebel" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'] .'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //آپلود فایل
                                                    else if ($FiledNameByName[2] === 'ulf'){
                                                        echo '<div style="padding-bottom: 15px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div  class="col-sm-3 col-md-3">';
                                                        $FileAddress   = explode('$$' , $Data[$FIE_Name])[0];
                                                        $FileName      = explode('/' , $FileAddress);
                                                        $FileName      = end($FileName);
                                                        $FileType      = explode('.' , $FileName);
                                                        $FileType      = end( $FileType);
                                                        if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'docx'){
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';

                                                        }
                                                        else if ($FileType === 'pdf'){
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/file.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'xlsx'){
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/excel.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else if ($FileType === 'zip' || $FileType === 'rar'){
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                        }
                                                        else{
                                                            $ContentFile = $Data[$FIE_Name];
                                                            echo '<div class="file-image-1">';
                                                            echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                            echo '<ul class="icons">';
                                                            echo '<li>';
                                                            echo '<a id="DownloadIMGClick" target="_blank" class="btn bg-primary">';
                                                            echo '<input type="hidden" id="DownloadIMG" name="DownloadIMG" value="'.$ContentFile.'">';
                                                            echo '<i class="fe fe-download"></i>';
                                                            echo '</a>';
                                                            echo '</li>';
                                                            echo '</ul>';
                                                            echo '</div>';
                                                           /* echo '<div class="file-image-1">

                                                                        <ul class="icons">
                                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                                        </ul>
                                                                        <!--<span class="file-name-1"></span>-->
                                                                    </div>';*/
                                                        }
                                                        echo ' </div>';
                                                    }

                                                    //آپلود چند فایل و عکس
                                                    else if ($FiledNameByName[2] === 'muf'){
                                                        echo '<hr><div style="padding-bottom: 15px" class="row">';
                                                        echo '<div class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div class="col-sm-9 col-md-9">';
                                                        $MultiFiles = explode('||' , $Data[$FIE_Name]);
                                                        unset($MultiFiles[0]);
                                                        $ImgCount = 0;
                                                        foreach ($MultiFiles as $file){
                                                            $ArrayFile     = explode('$$' , $file);
                                                            $FileAddress   = $ArrayFile[0];
                                                            $FileName      = explode('/' , $FileAddress);
                                                            $FileName      = end($FileName);
                                                            $FileType      = explode('.' , $FileName);
                                                            $FileType      = end( $FileType);
                                                            if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo ' <img class="br-10" src="resources/images/media/files/imgformat.png">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i  class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            else if ($FileType == 'docx'){
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo '<img class="br-10" src="resources/images/media/files/doc.png">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            else if ($FileType === 'pdf'){
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo ' <img class="br-10" src="resources/images/media/files/file.png">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            else if ($FileType === 'xls'){
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo ' <img class="br-10" src="resources/images/media/files/excel.png">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            else if ($FileType === 'zip' || $FileType === 'rar'){
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo ' <img class="br-10" src="resources/images/media/files/zip.png">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            else{
                                                                $ContentFile = $file;
                                                                echo '<div class="file-image-1">';
                                                                echo '<img class="br-10" src="resources/images/media/files/logo_txt.jpg">';
                                                                echo '<ul class="icons">';
                                                                echo '<li>';
                                                                echo '<a id="" target="_blank" class="btn bg-primary DownloadIMGClickMulti" data-value="'.$ImgCount.'">';
                                                                echo '<input type="hidden" id="DownloadIMGMulti_'.$ImgCount.'" name="DownloadIMG" value="'.$file.'">';
                                                                echo '<i class="fe fe-download"></i>';
                                                                echo '</a>';
                                                                echo '</li>';
                                                                echo '</ul>';
                                                                echo '</div>';
                                                            }
                                                            $ImgCount++;
                                                        }
                                                        echo ' </div>';
                                                        echo ' </div><hr>';
                                                    }

                                                    //موقیعت جغرافیایی
                                                    else if ($FiledNameByName[2] === 'gps'){
                                                        echo '<div style="padding-bottom: 10px"  class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-location-arrow" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد امتیاز دهی
                                                    else if ($FiledNameByName[2] === 'srf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';





                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-ravelry" aria-hidden="true"></i>'.$Data[$FIE_Name] .'پیاده سازی نشده'.'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد رضایت مشتری
                                                    else if ($FiledNameByName[2] === 'erf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-ravelry" aria-hidden="true"></i>'.$Data[$FIE_Name].'پیاده سازی نشده </span> ';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد انتخاب رنگ
                                                    else if ($FiledNameByName[2] === 'cpf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-columns" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد آدرس ای پی
                                                    else if ($FiledNameByName[2] === 'ipl'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-id-card" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد آب و هوا
                                                    else if ($FiledNameByName[2] === 'pwf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //رکورد ویدئو
                                                    else if ($FiledNameByName[2] === 'rvf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //ضبط ضدا
                                                    else if ($FiledNameByName[2] === 'vrf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد جمع بندی
                                                    else if ($FiledNameByName[2] === 'ruf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد فرمول
                                                    else if ($FiledNameByName[2] === 'aff'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد گرید
                                                    else if ($FiledNameByName[2] === 'vgf'){
                                                        echo '<div style="padding-bottom: 10px" class="row">';
                                                        echo '<div  class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div class="col-sm-9 col-md-9">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-table" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد پلاک
                                                    else if ($FiledNameByName[2] === 'vgf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '</label>';
                                                        echo '</div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        $ParamsPlaque = explode('-' , $Data[$FIE_Name]);
                                                        $Params0 = $ParamsPlaque[0];
                                                        $Params1 = $ParamsPlaque[1];
                                                        $Params2 = $ParamsPlaque[2];
                                                        $Params3 = $ParamsPlaque[3];
                                                        echo  $Params3 . ' ' . '<span style="color: #0036a1">|</span>' . ' ' . $Params2 . ' ' . $Params1 . ' ' . $Params0 . ' ' . ' <img src="resources/images/pelak.png" alt="">';
                                                        echo '</div>';
                                                    }

                                                    //کد ملی
                                                    else if ($FiledNameByName[2] === 'irc'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-phone" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد نام واحد پولی
                                                    else if ($FiledNameByName[2] === 'cnf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-money" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'] .'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد لیست کاربران
                                                    else if ($FiledNameByName[2] === 'cul'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="wi wi-day-sleet" aria-hidden="true"></i>پیاده سازی نشده</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد تاریخ و زمان
                                                    else if ($FiledNameByName[2] === 'dtf'){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        if ($TypeDate == 'jalali'){
                                                            $TimeDateArr = explode(' ' , $Data[$FIE_Name]);
                                                            $DateArr     = $TimeDateArr[0];
                                                            $TimeArr     = $TimeDateArr[1];
                                                            $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$TimeArr . ' ' . $JalalyDate .'</span>';
                                                        }else{
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        }
                                                        echo ' </div>';
                                                    }
                                                }
                                                else{
                                                    if ($FIE_UIType == '55' || $FIE_UIType == 255 || $FIE_UIType == 1|| $FIE_UIType == 4 || $FIE_UIType == 2){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-file-text" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //تلفن
                                                    elseif ($FIE_UIType == 11){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-phone" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //ایمیل
                                                    elseif ($FIE_UIType == 13){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-emai" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //واحد پولی
                                                    elseif ($FIE_UIType == 71){
                                                        if ($FIE_Type['name'] == 'currency'){
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<label for="">'.$FIE_Label.'</label>';
                                                            echo ' </div>';
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-dollar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                            echo ' </div>';
                                                        }

                                                    }

                                                    //فهرست انتخابی
                                                    elseif ($FIE_UIType == 15 || $FIE_UIType == 16){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فهرست با لیبل
                                                    else if ($FIE_UIType == 117){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //ادرس وب
                                                    elseif ($FIE_UIType == 17){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-external-link" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //ازمام
                                                    elseif ($FIE_UIType == 14){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-times" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //فیلد مرتبط
                                                    elseif ($FIE_UIType == 51 || $FIE_UIType == 57){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-rebel" aria-hidden="true"></i>'.$Data[$FIE_Name]['label'] .'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //تاریخ و زمان
                                                    elseif ($FIE_UIType == 70){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        if ($TypeDate == 'jalali'){
                                                            $TimeDateArr = explode(' ' , $Data[$FIE_Name]);
                                                            $DateArr     = $TimeDateArr[0];
                                                            $TimeArr     = $TimeDateArr[1];
                                                            $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$TimeArr . ' ' . $JalalyDate .'</span>';
                                                        }else{
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        }
                                                        echo ' </div>';
                                                    }

                                                    //تاریخ
                                                    elseif ($FIE_UIType == 5){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        if ($TypeDate == 'jalali'){
                                                            $date = jdate('Y/m/d', strtotime($Data[$FIE_Name]));
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</span>';
                                                        }else{
                                                            $date = $Data[$FIE_Name];
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>'.$date.'</span>';
                                                        }
                                                        echo ' </div>';
                                                    }

                                                    //boolean
                                                    elseif ($FIE_UIType == 56){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        if ($Data[$FIE_Name] == 1){
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="color: green; margin-left: 5px" class="fa fa-check" data-bs-toggle="tooltip" title=""></i>'.$Portal_Translate->Translate('BOOL_YES').'</span>';
                                                        }else{
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="color: red;margin-left: 5px" class="fa fa-remove" data-bs-toggle="tooltip" title=""></i>'.$Portal_Translate->Translate('BOOL_NO').'</span>';
                                                        }
                                                        echo ' </div>';
                                                    }

                                                    //text
                                                    elseif ($FIE_UIType == 21 || $FIE_UIType == 19 || $FIE_UIType == 24){
                                                        echo '<div style="padding-bottom: 10px" class="row">';
                                                        echo '<div  class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div  class="col-sm-9 col-md-9">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""> <i style="margin-left: 10px" class="fa fa-text-height" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                        echo ' </div>';
                                                        echo ' </div>';
                                                    }

                                                    //مقادیر قابل انتخاب گروهی
                                                    else if ($FIE_UIType == 33){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        $ValueMulti = str_replace("|##|" , " .__. " , $Data[$FIE_Name]);
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>'.$ValueMulti.'</span>';
                                                        echo ' </div>';
                                                    }

                                                    //عدد اعشار و عدد صحیح
                                                    elseif ($FIE_UIType == 7){

                                                        if ($FIE_Type['name'] == 'integer'){
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<label for="">'.$FIE_Label.'</label>';
                                                            echo ' </div>';
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-sort-numeric-asc" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                            echo ' </div>';
                                                        }
                                                        if ($FIE_Type['name'] == 'double'){
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<label for="">'.$FIE_Label.'</label>';
                                                            echo ' </div>';
                                                            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                            echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder=""><i style="margin-left: 10px" class="fa fa-venus-double" aria-hidden="true"></i>'.$Data[$FIE_Name].'</span>';
                                                            echo ' </div>';
                                                        }

                                                    }

                                                    //درصد
                                                    elseif ($FIE_UIType == 9){
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<label for="">'.$FIE_Label.'</label>';
                                                        echo ' </div>';
                                                        echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
                                                        echo '<span type="email" name="'.$FIE_Name.'" class="form-control" placeholder="">'.$Data[$FIE_Name].'<span style="color: #6c5ffc; font-size: 15px ; margin-left: 10px">%</span></span>';
                                                        echo ' </div>';
                                                    }
                                                }
                                            }
                                            echo '</div></div></div></div>';
                                            unset($AccessFieldsBlock);
                                        }
                                    }
                                    if ($InfoLineItem != null && !empty($InfoLineItem)){ ?>
                                    <hr style='border: 1px black solid; background-color: black;'>
                                    <div class="">
                                        <h4 style=''><?php echo $InfoLineItem['BlockHeader']['REGION_LABEL'] ?></h4><hr style='color: black'>
                                        <div class="">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="expanel expanel-default">
                                                        <div class="expanel-body">
                                                            <h3 class="expanel-title"><?php echo $ModuleLabel ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="expanel expanel-default">
                                                        <div class="expanel-body">
                                                            <h3 class="expanel-title"><?php echo $InfoLineItem['BlockHeader']['CURRENCY_INFO'] ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="expanel expanel-default">
                                                        <div class="expanel-body">
                                                            <h3 class="expanel-title"><?php echo $InfoLineItem['BlockHeader']['LBL_TAX_MODE'] ?></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table border text-nowrap text-md-nowrap table-bordered mb-0">
                                                    <thead style="background-color: #f6f6fb">
                                                    <tr>
                                                        <?php $LineItemHeader =  $InfoLineItem['lineItemHeader'];
                                                        foreach ($LineItemHeader as $Header) {
                                                            if ($Header != 'IMAGE' && $Header != 'MARGIN'){
                                                                $HeaderStatus = $Header['status'];
                                                                $HeaderLabel = $Header['label'];
                                                                if ($HeaderStatus === true) {
                                                                    echo '<th class="text-center">' . $HeaderLabel . '</th>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <?php $LineItemRecord =  $InfoLineItem['lineItemRecords'];
                                                        foreach ($LineItemRecord as $Record){
                                                            echo '<tr>';
                                                            /*$Image = $Record['IMAGE'][0];
                                                            if ($Image != ''){
                                                                echo '<td>'.$Image.'</td>';
                                                            }*/
                                                            $Product = $Record['PRODUCT'][0];
                                                            if ($Product != ''){
                                                                echo '<td>'.$Product.'</td>';
                                                            }
                                                            $Comment = $Record['COMMENT'][0];
                                                            if ($Comment != ''){
                                                                echo '<td>'.$Comment.'</td>';
                                                            }
                                                            $Quantity = $Record['QUANTITY'][0];
                                                            if ($Quantity != ''){
                                                                echo '<td>'.$Quantity.'</td>';
                                                            }
                                                            $ListPrice = $Record['LIST_PRICE'][0];
                                                            if ($ListPrice != ''){
                                                                echo '<td>';
                                                                foreach ($Record['LIST_PRICE'] as $row){
                                                                    echo '<span>';
                                                                    echo $row ;
                                                                    echo '</span>' . '<br>';
                                                                }
                                                                echo '</td>';
                                                            }
                                                            $Total = $Record['TOTAL'][0];
                                                            if ($Total != ''){
                                                                echo '<td>';
                                                                foreach ($Record['TOTAL'] as $row){
                                                                    echo '<span>';
                                                                    echo $row ;
                                                                    echo '</span>' . '<br>';
                                                                }
                                                                echo '</td>';
                                                            }
                                                            /*$Margin = $Record['MARGIN'][0];
                                                            if ($Margin != ''){
                                                                echo '<td>'.$Margin.'</td>';
                                                            }*/
                                                            $NetPrice = $Record['NET_PRICE'][0];
                                                            if ($NetPrice != ''){
                                                                echo '<td>'.$NetPrice.'</td>';
                                                            }
                                                            echo '</tr>';
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div><br>
                                            <div class="table-responsive">
                                                <table class="table border text-nowrap text-md-nowrap table-bordered mb-0">
                                                    <thead>
                                                    <?php $BlockFooter = $InfoLineItem['BlockFooter']; ?>
                                                    <?php foreach ($BlockFooter as $sum){
                                                        //echo '<pre>';print_r($sum);
                                                        ?>
                                                        <tr>
                                                            <th width="80%" style="text-align: left"><?php echo $sum['label'] ?></th>
                                                            <th  style="text-align: left"><?php echo $sum['value'] ?></th>
                                                        </tr>
                                                    <?php } ?>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="tab-pane" id="tab26">
                                    <div class="row">
                                        <div class="col-md-12 col-xl-12">
                                            <div class="">
                                                <div class="card-header">
                                                    <h3 class="card-title"><?php echo $Portal_Translate->Translate('LBL_ADDED_COMMENT'); ?></h3>
                                                </div>
                                                <div class="card-body">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="form-floating floating-label1">
                                                                        <textarea name="CommentDescription" class="form-control" placeholder="<?php $Portal_Translate->Translate('LBL_COMMENTS'); ?>" id="floatingTextarea2" style="height: 100px"></textarea>
                                                                        <label for="floatingTextarea2"><?php echo $Portal_Translate->Translate('LBL_COMMENTS'); ?></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <input class="form-control" type="file" id="formFileMultiple" name="UploadedFileComment[]" multiple>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="submit" name="AddedComments" class="btn btn-lg btn-success" value="<?php echo $Portal_Translate->Translate('BTN_SUBMIT'); ?>">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div></p>
                                </div>
                                <?php if (isset($ModComments['mainrecords']) && !empty($ModComments)){
                                    echo ' <div class="main-chat-body flex-2 ps ps__rtl ps--active-y" id="ChatBody">
                                                <div class="content-inner">';
                                    $Comments = $ModComments['mainrecords'];
                                    foreach ($Comments as $row){
                                        $Source         = $row['source'] ;
                                        $CreatTime      = $row['createdtime'];
                                        $CommentContent = $row['commentcontent'];
                                        $CustomerLabel  = $row['customer']['label'];
                                        if ($Source == 'PORTAL'){ ?>
                                            <div class="media flex-row-reverse chat-right">
                                                <div class="main-img-user online"><img alt="avatar" src="resources/images/users/21.jpg"></div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper">
                                                        <?php echo $CommentContent ?>
                                                    </div>
                                                    <div class="main-msg-wrapper">
                                                    <span class="text-dark"><span><i class="fa fa-image fs-14 text-muted pe-2"></i></span><span class="fs-14 mt-1"> Image_attachment.jpg </span>
                                                    <i class="fe fe-download mt-3 text-muted ps-2"></i>
                                                    </span>
                                                    </div>
                                                    <div>
                                                        <span><?php echo $CreatTime ?></span> <a href="javascript:void(0)"><i class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="media chat-left">
                                                <div class="main-img-user online"><img alt="avatar" src="resources/images/users/1.jpg"></div>
                                                <div class="media-body">
                                                    <div class="main-msg-wrapper">
                                                        <?php echo $CommentContent ?>
                                                    </div>
                                                    <div>
                                                        <span><?php echo $CreatTime ?></span> <a href="javascript:void(0)"><i class="icon ion-android-more-horizontal"></i></a>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php }
                                    }
                                    echo '<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 113px; left: 477px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 11px;"></div></div></div></div>';
                                } ?>
                                <div class="tab-pane" id="tab27">
                                    <?php if (!empty($History) && $History != null) {
                                        $History = $History[0];
                                        //echo "<pre>"; print_r($History[0]);  ?>
                                        <ul class="notification">
                                            <?php foreach ($History['values'] as $key=>$values){
                                                //echo "<pre>"; print_r($key). ':' . print_r($values);
                                                ?>
                                                <li>
                                                    <div class="notification-time">
                                                        <?php
                                                        $DateTimeArray = explode(' ' , $History['modifiedtime']);
                                                        $DateModi      = $DateTimeArray[0];
                                                        $TimeModi      = $DateTimeArray[1];
                                                        $dateFilnal    = jdate('Y/m/d', strtotime($DateModi)); ?>
                                                        <span class="date"><?php echo $dateFilnal  ?></span>
                                                        <span style="font-size: 17px" class="time"><?php echo $TimeModi  ?></span>
                                                    </div>
                                                    <div class="notification-icon">
                                                        <a href="javascript:void(0);"></a>
                                                    </div>
                                                    <div class="notification-body">
                                                        <div class="media mt-0">
                                                            <div class="media-body ms-3 d-flex">
                                                                <div class="">
                                                                    <p class="mb-0 fs-13 text-dark"><?php echo $key ?></p>
                                                                    <p class="mb-0 fs-13 text-dark">
                                                                        <span><?php echo $Portal_Translate->Translate('FROM'); ?></span>
                                                                        <?php if ($values['previous'] == ''){ ?>
                                                                            <span>" "</span>
                                                                        <?php }else{ ?>
                                                                            <span><?php echo $values['previous'] ?></span>
                                                                        <?php } ?>
                                                                        <span><?php echo $Portal_Translate->Translate('TO'); ?></span>
                                                                        <?php if ($Portal_Translate == ''){ ?>
                                                                            <span>" "</span>
                                                                        <?php }else{ ?>
                                                                            <span><?php echo $values['current'] ?></span>
                                                                        <?php } ?>
                                                                        <span><?php echo $Portal_Translate->Translate('CHANG'); ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="notify-time">
                                                                    <p class="mb-0 text-muted fs-11"><?php echo $Portal_Translate->Translate('LAST_CHANGE'); ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php }  ?>
                                        </ul>
                                    <?php } else{ ?>
                                        <div class="alert alert-primary" role="alert">
                                            <?php echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}

function ProcessFieldEdit ($ModuleName = null , $ModuleLabel = null , $Blocks , $AccessFields , $ModComments = array() , $History = array() , $Data , $RelatedModules = array() , $InfoLineItem = array() , $TypeDate) {
//    echo "<pre>";
//    print_r($AccessFields);
//    echo "\n" ;
//    echo " </pre>" ;
    $Portal_Translate = new Language(); ?>
   <form method="post" enctype="multipart/form-data">
        <?php
        $AccessFieldsBlock = array();
        $i = 0 ;
        foreach ($Blocks as $LBL){
            $BlockID                 = $LBL['blockid'];
            $BlockName               = $LBL['blockname'];
            $BlockLabel              = $LBL['blocklabel'];
            $DisplayStatus           = $LBL['display_status'];
            $Sequence                = $LBL['sequence'];
            $AccessFieldsBlock       = array();
            foreach ($AccessFields as $FIE){
                $BlockIDField = $FIE['blockid'];
                $AccessEdit   = $FIE['editable'];
                if ($BlockIDField == $BlockID && $AccessEdit == 1){
                    array_push($AccessFieldsBlock , $FIE);
                }
            }
            if (isset($AccessFieldsBlock) && $AccessFieldsBlock != null){
                //echo "<pre>";print_r($AccessFieldsBlock);
                echo '<div class="card-status card-status-left bg-blue br-bs-7 br-ts-7"></div>';
                echo '<div class="card-header" style="background-color: #f8f9fc"><h4 class="text-info">'.$BlockLabel.'</h4><div class="card-options"></div></div>';
                echo '<div class="col-md-12 col-xl-12"><div class=""><div class="card-body"><div class="row">';
                $NumClass            = 0;
                foreach ($AccessFieldsBlock as $LBL_FIE){
                    $FIE_Name        = $LBL_FIE['name'];
                    $FIE_Label       = $LBL_FIE['label'];
                    $FIE_Mandatory   = $LBL_FIE['mandatory'] ;
                    $FIE_ParsVTField = $LBL_FIE['parsvtfield'];
                    $FIE_Type        = $LBL_FIE ['type'];
                    $FIE_UIType      = $LBL_FIE['uitype'] ;
                    $FIE_Nullable    = $LBL_FIE['nullable'] ;
                    $FIE_Editable    = $LBL_FIE ['editable'] ;
                    $FIE_Readonly    = $LBL_FIE ['readonly'];
                    $FIE_Default     = $LBL_FIE ['default'];
                    if ($FIE_Type['name'] != 'reference'){
                        if ($FIE_Editable === true){
                            if ($FIE_Mandatory === true){?>
                                <?php
                                if ($FIE_Type['name'] == 'picklist'){
                                    $ValuePickList = $FIE_Type['picklistValues'];
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<select style="height: 58px" id="floatingInput" name="'.$FIE_Name.'--picklist" class="form-control" required>';
                                    /*echo '<option value="" selected>'.$Portal_Translate->Translate("CHOOSE_AN_OPTIONS").'</option>';*/
                                    foreach ($ValuePickList as $Value){
                                        if ($Data[$FIE_Name] == $Value['value']){
                                            echo '<option value="'.$Value['value'].'" selected>'.$Value['label'].'</option>';
                                        }else{
                                            echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                        }

                                    }
                                    echo '</select>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div></div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'multipicklist'){
                                    echo '<div style="height: 58px" class="col-sm-6 col-md-6"><div class="form-group">';
                                    //echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo '<input style="height: 58px" type="text" name="'.$FIE_Name.'--multipicklist" class="form-control multiPickList'.$NumClass.'" placeholder="">';
                                    echo '</div></div>';
                                    $ValueMultiPickList = $FIE_Type['picklistValues'];
                                    $ResMultiValue      = array();
                                    foreach ($ValueMultiPickList as $Value){
                                        $LBLMulti  = $Value['label'];
                                        $LBLValue  = $Value['value'];
                                        $MainValue = '{"id":"'.$LBLValue.'" , "text": "'.$LBLMulti.'" }';
                                        array_push($ResMultiValue , $MainValue);
                                    }
                                    $StringValue = implode(',' , $ResMultiValue);
                                    //unset($ResMultiValue);
                                    //echo '<pre>'; print_r($StringValue);
                                    echo '<script>
                                            var content = [];
                                            content = ['.$StringValue.'];
                                            console.log(content);
                                             $(".multiPickList'.$NumClass.'").select2({
                                                 data:content,
                                                 multiple:true,
                                                 placeholder:"'.$FIE_Label.'",
                                             });
                                        </script>';

                                }
                                elseif ($FIE_Type['name'] == 'phone'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="tel" name="'.$FIE_Name.'--phone" class="form-control" placeholder="" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div></div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'email'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="email" name="'.$FIE_Name.'--email" class="form-control" placeholder="" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(info@gmail.com)</span><span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'date'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    if ($TypeDate == 'jalali'){
                                        $DateValue = jdate('Y/m/d', strtotime($Data[$FIE_Name]));
                                        echo '<input type="text" name="'.$FIE_Name.'--date" class="form-control" placeholder="" required value='.$DateValue.' data-jdp>';
                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    }else{
                                        echo '<input type="date" name="'.$FIE_Name.'--date" class="form-control" placeholder="" value='.$Data[$FIE_Name].' required>';
                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    }
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'image'){
                                    echo '<div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--image" id="formFile" type="file" value='.$Data[$FIE_Name].' required>';
                                    echo '</div>';
                                }
                                elseif ($FIE_Type['name'] == 'boolean'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                    echo '<span class="custom-switch-description">'.$FIE_Label.'<span class="text-red">*</span></span>';
                                    echo '<label class="custom-switch form-switch mb-0"  style="margin-right: 20px;margin-top: 10px">';
                                    if ($Data[$FIE_Name] == 1){
                                        echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input" checked>';
                                    }else{
                                        echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input">';
                                    }
                                    echo '<span class="custom-switch-indicator custom-switch-indicator-md"></span>';
                                    echo '</label>';
                                    echo '</div></div>';
                                }
                                //Rating Field
                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Rating Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Customer Satisfaction Field
                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Customer Satisfaction Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //ashar number
                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 7 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" id="price" name="'.$FIE_Name.'--double7" min="0" step="0.01" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                // % Darsad
                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 9 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double9" min="0" step="0.01" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(%)</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'integer' && $FIE_UIType == 7 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--integer" name="tentacles" min="0" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'currency' && $FIE_UIType == 71 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--currency" min="0" value='.$Data[$FIE_Name].' required> ';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">('.$FIE_Type['symbol'].')</span><span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'url' && $FIE_UIType == 17){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="url" class="form-control" name="'.$FIE_Name.'--url" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(www.mysite.com)</span><span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'time'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="time" class="form-control" name="'.$FIE_Name.'--time" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64"></span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Gregorian Date'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="date" name="'.$FIE_Name.'--gregoriandate" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'customdatetime' && $FIE_ParsVTField['name'] == 'DateTime'){
                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                    $DateTime = explode(' ' , $Data[$FIE_Name] );
                                    if ($TypeDate == 'jalali'){
                                        $DateValue = jdate('Y/m/d', strtotime($DateTime[0]));
                                        echo '<input type="text" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" value='.$DateValue.' data-jdp>';
                                    }else{
                                        echo '<input type="date" name="'.$FIE_Name.'--datetime[]" class="form-control" value='.$DateTime[0].' placeholder="">';
                                    }
                                    echo '<label for="floatingInput">date<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="time" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" value='.$DateTime[1].'>';
                                    echo '<label for="floatingInput">time<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Upload field'){
                                    echo '<hr>';
                                    echo '<div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--uploadfield" id="formFile" type="file">';
                                    $FileAddress   = explode('$$' , $Data[$FIE_Name])[0];
                                    $FileName      = explode('/' , $FileAddress);
                                    $FileName      = end($FileName);
                                    $FileType      = explode('.' , $FileName);
                                    $FileType      = end( $FileType);
                                    if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                        //echo '<a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'"><img style="max-width:100px;max-height:100px;" src="'.CRM_URL.'/'.$FileAddress.'"></a>' . ' ' . ' ';
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/imgformat.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>';
                                        echo '<!--<span class="file-name-1"></span>--></div>';

                                    }
                                    else if ($FileType === 'docx'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/doc.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'pdf'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/file.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'xlsx'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/excel.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'zip' || $FileType === 'rar'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/zip.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else{
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/logo_txt.jpg">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li> 
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    echo '</div><hr>';
                                }
                                //Coordinate
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Coordinate'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Color Picker
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Color Picker'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="color" name="'.$FIE_Name.'--ColorPicker" id="floatingInput" class="form-control" placeholder="" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //IP Address Field
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'IP Address Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="text" name="'.$FIE_Name.'--IPAddressField" id="floatingInput" class="form-control" placeholder="" value='.$Data[$FIE_Name].' required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Plaque Field
                                elseif ($FIE_Type['name'] == 'plaque' && $FIE_ParsVTField['name'] == 'Plaque Field') {
                                    $PlaquArr = explode('-' , $Data[$FIE_Name] );
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '<span class="text-red">*</span></label>';
                                    echo '<div class="row">';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__" value='.$PlaquArr[3].'></div>';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="3" maxlength="3" placeholder="___" value='.$PlaquArr[2].'></div>';
                                    echo '<div class="col">';
                                    $Val = $FIE_Type['plaqueMiddleChars'];
                                    echo '<select style="" id="floatingInput" name="'.$FIE_Name.'--PlaqueField[]" class="form-control" >';
                                    foreach ($Val as $Value){
                                        if ($PlaquArr[1] == $Value['label']){
                                            echo '<option value="'.$Value['value'].'" selected>'.$Value['label'].'</option>';
                                        }else{
                                            echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                        }

                                    }
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__" value="'.$PlaquArr[0].'"></div>';
                                    echo '<div class="col-1"><div class="pic2"><img src="resources/images/pelak.png" alt=""></div></div>';
                                    echo '</div>';
                                    echo '</div></div>';
                                }
                                //Weather Field
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Weather Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Grid Field
                                elseif ($FIE_Type['name'] == 'grid' && $FIE_ParsVTField['name'] == 'Grid Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //upload files
                                elseif ($FIE_Type['name'] == 'text' && $FIE_ParsVTField['name'] == 'Upload fields'){
                                    echo '<hr><div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--Uploadfields[]" id="formFile" type="file" multiple required>';
                                    $MultiFiles = explode('||' , $Data[$FIE_Name]);
                                    unset($MultiFiles[0]);
                                    foreach ($MultiFiles as $file){
                                        $ArrayFile     = explode('$$' , $file);
                                        $FileAddress   = $ArrayFile[0];
                                        $FileName      = explode('/' , $FileAddress);
                                        $FileName      = end($FileName);
                                        $FileType      = explode('.' , $FileName);
                                        $FileType      = end( $FileType);
                                        if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                            //echo '<a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'"><img style="max-width:100px;max-height:100px;" src="'.CRM_URL.'/'.$FileAddress.'"></a>' . ' ' . ' ';
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/imgformat.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>';
                                            echo '<!--<span class="file-name-1"></span>--></div>';

                                        }
                                        else if ($FileType === 'docx'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/doc.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'pdf'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/file.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'xlsx'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/excel.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'zip' || $FileType === 'rar'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/zip.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else{
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/logo_txt.jpg">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                    }
                                    echo '</div><hr>';
                                }
                                elseif ($FIE_Type['name'] == 'text'){
                                    echo '<div class="col-sm-12 col-md-12"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<textarea type="email" name="'.$FIE_Name.'--text" class="form-control" placeholder=""  required>'.$Data[$FIE_Name].'</textarea>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div></div></div>';
                                }
                                else{
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="text" name="'.$FIE_Name.'--string" class="form-control" placeholder="" value="'.$Data[$FIE_Name].'" required>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                    echo ' </div></div></div>';
                                }
                                ?>
                            <?php }else{
                                if ($FIE_Type['name'] == 'picklist'){
                                    $ValuePickList = $FIE_Type['picklistValues'];
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<select style="height: 58px" id="floatingInput" name="'.$FIE_Name.'--picklist" class="form-control">';
                                    /*echo '<option value="" selected>'.$Portal_Translate->Translate("CHOOSE_AN_OPTIONS").'</option>';*/
                                    foreach ($ValuePickList as $Value){
                                        if ($Data[$FIE_Name] === $Value['value']){
                                            echo '<option value="'.$Value['value'].'" selected>'.$Value['label'].'</option>';
                                        }else{
                                            echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                        }

                                    }
                                    echo '</select>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red"></span></label>';
                                    echo ' </div></div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'multipicklist'){
                                    echo '<div style="height: 58px" class="col-sm-6 col-md-6"><div class="form-group">';
                                    //echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo '<input style="height: 58px" type="text" name="'.$FIE_Name.'--multipicklist" class="form-control multiPickList'.$NumClass.'" placeholder="">';
                                    echo '</div></div>';
                                    $ValueMultiPickList = $FIE_Type['picklistValues'];
                                    $ResMultiValue      = array();
                                    foreach ($ValueMultiPickList as $Value){
                                        $LBLMulti  = $Value['label'];
                                        $LBLValue  = $Value['value'];
                                        $MainValue = '{"id":"'.$LBLValue.'" , "text": "'.$LBLMulti.'" }';
                                        array_push($ResMultiValue , $MainValue);
                                    }
                                    $StringValue = implode(',' , $ResMultiValue);
                                    //unset($ResMultiValue);
                                    //echo '<pre>'; print_r($StringValue);
                                    echo '<script>
                                            var content = [];
                                            content = ['.$StringValue.'];
                                            console.log(content);
                                             $(".multiPickList'.$NumClass.'").select2({
                                                 data:content,
                                                 multiple:true,
                                                 placeholder:"'.$FIE_Label.'",
                                             });
                                        </script>';

                                }
                                elseif ($FIE_Type['name'] == 'phone'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="tel" name="'.$FIE_Name.'--phone" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'email'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="email" name="'.$FIE_Name.'--email" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(info@gmail.com)</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'date'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    if ($TypeDate == 'jalali'){
                                        $DateValue = jdate('Y/m/d', strtotime($Data[$FIE_Name]));
                                        echo '<input type="text" name="'.$FIE_Name.'--date" class="form-control" value='.$DateValue.' data-jdp>';
                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red"></span></label>';
                                    }else{
                                        echo '<input type="date" name="'.$FIE_Name.'--date" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red"></span></label>';
                                    }
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'image'){
                                    /*echo '<div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--image" id="formFile" type="file">';
                                    echo '</div>';*/
                                }
                                //Checkbox
                                elseif ($FIE_Type['name'] == 'boolean'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                    echo '<span class="custom-switch-description">'.$FIE_Label.'</span>';
                                    echo '<label class="custom-switch form-switch mb-0"  style="margin-right: 20px;margin-top: 10px">';
                                    if ($Data[$FIE_Name] == 1){
                                        echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input" checked>';
                                    }else{
                                        echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input">';
                                    }
                                    echo '<span class="custom-switch-indicator custom-switch-indicator-md"></span>';
                                    echo '</label>';
                                    echo '</div></div>';
                                }
                                //Rating Field
                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Rating Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Customer Satisfaction Field
                                elseif ($FIE_Type['name'] == 'double' && $FIE_ParsVTField['name'] == 'Customer Satisfaction Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //floating
                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 7 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double7" min="0" step="0.01"  value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                // % Darsad
                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 9 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double9" min="0" step="0.01" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(%)</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                elseif ($FIE_Type['name'] == 'integer' && $FIE_UIType == 7 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--integer" min="0" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //currency
                                elseif ($FIE_Type['name'] == 'currency' && $FIE_UIType == 71 ){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--currency" min="0" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">('.$FIE_Type['symbol'].')</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Web (URL)
                                elseif ($FIE_Type['name'] == 'url' && $FIE_UIType == 17){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="url" class="form-control" name="'.$FIE_Name.'--url" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(www.mysite.com)</span></label>';
                                    echo ' </div> </div></div>';
                                }
                                //Time
                                elseif ($FIE_Type['name'] == 'time'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="time" class="form-control" name="'.$FIE_Name.'--time" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Gregorian Date
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Gregorian Date'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="date" name="'.$FIE_Name.'--gregoriandate" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //DateTime
                                elseif ($FIE_Type['name'] == 'customdatetime' && $FIE_ParsVTField['name'] == 'DateTime'){
                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                    $DateTime = explode(' ' , $Data[$FIE_Name] );
                                    if ($TypeDate == 'jalali'){
                                        $DateValue = jdate('Y/m/d', strtotime($DateTime[0]));
                                        echo '<input type="text" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" data-jdp value='.$DateValue.'>';
                                    }else{
                                        echo '<input type="date" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" value='.$DateTime[0].'>';
                                    }
                                    echo '<label for="floatingInput">'.$Portal_Translate->Translate('LBL_DATE').'</label>';
                                    echo ' </div> </div></div>';
                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="time" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" value='.$DateTime[1].'>';
                                    echo '<label for="floatingInput">'. $Portal_Translate->Translate('LBL_TIME') .'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //upload file
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Upload field'){
                                    echo "<hr>";
                                    echo '<div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--uploadfield" id="formFile" type="file">';
                                    $FileAddress   = explode('$$' , $Data[$FIE_Name])[0];
                                    $FileName      = explode('/' , $FileAddress);
                                    $FileName      = end($FileName);
                                    $FileType      = explode('.' , $FileName);
                                    $FileType      = end( $FileType);
                                    if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                        //echo '<a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'"><img style="max-width:100px;max-height:100px;" src="'.CRM_URL.'/'.$FileAddress.'"></a>' . ' ' . ' ';
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/imgformat.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>';
                                        echo '<!--<span class="file-name-1"></span>--></div>';

                                    }
                                    else if ($FileType === 'docx'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/doc.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'pdf'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/file.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'xlsx'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/excel.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else if ($FileType === 'zip' || $FileType === 'rar'){
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/zip.png">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    else{
                                        echo '<div class="file-image-1">
                                                            <img class="br-10" src="resources/images/media/files/logo_txt.jpg">
                                                            <ul class="icons">
                                                                <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li> 
                                                            </ul>
                                                            <!--<span class="file-name-1"></span>-->
                                                        </div>';
                                    }
                                    echo '</div><hr>';
                                }
                                //Coordinate location
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Coordinate'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Color Picker
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Color Picker'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="color" name="'.$FIE_Name.'--ColorPicker" id="floatingInput" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //IP Address Field
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'IP Address Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="text" name="'.$FIE_Name.'--IPAddressField" id="floatingInput" class="form-control" placeholder="" value='.$Data[$FIE_Name].'>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Weather Field
                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Weather Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Grid Field
                                elseif ($FIE_Type['name'] == 'grid' && $FIE_ParsVTField['name'] == 'Grid Field'){
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo 'پیاده سازی نشده';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                //Plaque Field
                                elseif ($FIE_Type['name'] == 'plaque' && $FIE_ParsVTField['name'] == 'Plaque Field') {
                                    $PlaquArr = explode('-' , $Data[$FIE_Name] );
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '</label>';
                                    echo '<div class="row">';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__" value='.$PlaquArr[3].'></div>';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="3" maxlength="3" placeholder="___" value='.$PlaquArr[2].'></div>';
                                    echo '<div class="col">';
                                    $Val = $FIE_Type['plaqueMiddleChars'];
                                    echo '<select style="" id="floatingInput" name="'.$FIE_Name.'--PlaqueField[]" class="form-control" >';
                                    foreach ($Val as $Value){
                                        if ($PlaquArr[1] == $Value['label']){
                                            echo '<option value="'.$Value['value'].'" selected>'.$Value['label'].'</option>';
                                        }else{
                                            echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                        }
                                    }
                                    echo '</select>';
                                    echo '</div>';
                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__" value='.$PlaquArr[0].'></div>';
                                    echo '<div class="col-1"><div class="pic2"><img src="resources/images/pelak.png" alt=""></div></div>';
                                    echo '</div>';
                                    echo '</div></div>';
                                }
                                //upload files
                                elseif ($FIE_Type['name'] == 'text' && $FIE_ParsVTField['name'] == 'Upload fields'){
                                    echo '<hr>';
                                    echo '<div class="form-group">';
                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                    echo '<input class="form-control"  name="'.$FIE_Name.'--Uploadfields[]" id="formFile" type="file" multiple>';
                                    $MultiFiles = explode('||' , $Data[$FIE_Name]);
                                    unset($MultiFiles[0]);
                                    foreach ($MultiFiles as $file){
                                        $ArrayFile     = explode('$$' , $file);
                                        $FileAddress   = $ArrayFile[0];
                                        $FileName      = explode('/' , $FileAddress);
                                        $FileName      = end($FileName);
                                        $FileType      = explode('.' , $FileName);
                                        $FileType      = end( $FileType);
                                        if ($FileType == 'png' || $FileType == 'jpg' || $FileType == 'jpeg'){
                                            //echo '<a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'"><img style="max-width:100px;max-height:100px;" src="'.CRM_URL.'/'.$FileAddress.'"></a>' . ' ' . ' ';
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/imgformat.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>';
                                            echo '<!--<span class="file-name-1"></span>--></div>';

                                        }
                                        else if ($FileType === 'docx'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/doc.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'pdf'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/file.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'xlsx'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/excel.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else if ($FileType === 'zip' || $FileType === 'rar'){
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/zip.png">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                        else{
                                            echo '<div class="file-image-1">
                                                        <img class="br-10" src="resources/images/media/files/logo_txt.jpg">
                                                        <ul class="icons">
                                                            <li><a target="_blank" href="'.CRM_URL.'/'.$FileAddress.'" class="btn bg-primary"><i class="fe fe-download"></i></a></li>
                                                        </ul>
                                                        <!--<span class="file-name-1"></span>-->
                                                    </div>';
                                        }
                                    }
                                    echo '</div><hr>';
                                }
                                elseif ($FIE_Type['name'] == 'text'){
                                    echo '<div class="col-sm-12 col-md-12"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<textarea type="email" name="'.$FIE_Name.'--text" class="form-control" placeholder="">'.$Data[$FIE_Name].'</textarea>';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }
                                else{
                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                    echo '<input type="text" name="'.$FIE_Name.'--string" id="floatingInput" class="form-control" placeholder="" value="'.$Data[$FIE_Name].'">';
                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                    echo ' </div> </div></div>';
                                }

                                ?>
                            <?php }
                        }
                    }
                    $NumClass++;
                }
                echo '</div></div></div></div>';
                unset($AccessFieldsBlock);
            }
        }
        ?>
        <input style="width: 200px" type="submit" class="btn btn-success" name="EditRecord" value="<?php echo $Portal_Translate->Translate('BTN_EDIT'); ?>">
       <a href="index.php?page=Main&module=<?= $_REQUEST['module'] ?>&view=List" style="width: 200px; color:white" type="submit" class="btn btn-danger"><?php echo $Portal_Translate->Translate('BTN_CANCELED'); ?></a>
   </form>
<?php } ?>
