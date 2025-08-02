<?php
require ("views/CustomViewFields.php");
require ("views/ShowMessage.php");
require ("views/ProcessField.php");
?>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <?php
        if (isset($_GET['Message'])){
            ShowMeassage($_GET['Message']);
        }
        ?>


        <?php
        $ModuleName  =  $Parameters['ParamsCreateView']['DescribeFetchRecord']['result']['describe']['name'];
        $ModuleLabel =  $Parameters['ParamsCreateView']['DescribeFetchRecord']['result']['describe']['label'];
        ?>
        <div class="main-container container-fluid">
            <div class="page-header">
                <?php $ModuleNameHeader = str_replace('ها' , '' , $ModuleLabel) ?>
                <h1 class="page-title"><a href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=List"><?php echo $Portal_Translate->Translate('BTN_CREATE'); ?> <?php echo $ModuleNameHeader ?></a></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=List"><?php echo $ModuleLabel ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $Portal_Translate->Translate('BTN_CREATE'); ?></li>
                    </ol>
                </div>
            </div>
        </div>

        <div id="Notif_Status_Support" class="modal-content CustomViewStatusSupport" style="margin-top:10px;margin-bottom:10px; display:none">
            <div class="modal-header">
                <h5 class="modal-title"><b><?= $Portal_Translate->Translate('STATUS_SUPPORT_TITLE'); ?></b></h5>
                <button class="btn-close CustomClose" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <span id="Get_EndDateSupported"></span>
            </div>
            <div class="card-footer">
                <span id="Get_ContentRemainingDate"></span>
            </div>
            <!-- <div class="modal-footer">
                 <button class="btn btn-secondary CustomClose" data-bs-dismiss="modal">بستن</button>
             </div>-->
        </div>

        <?php
        $Blocks       = $Parameters['ParamsCreateView']['DescribeFetchRecord']['result']['describe']['blocks'];
        $AccessFields = $Parameters['ParamsCreateView']['DescribeFetchRecord']['result']['describe']['fields'];
        $TypeDate     = $_SESSION['Type_Date'];
        ?>
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <form method="post" enctype="multipart/form-data">
                    <?php
                        $AccessFieldsBlock = array();
                        $i = 0 ;
                        foreach ($Blocks as $LBL){
                            $LBL                     = (array) $LBL ;
                            $BlockID                 = $LBL['blockid'];
                            $BlockName               = $LBL['blockname'];
                            $BlockLabel              = $LBL['blocklabel'];
                            $DisplayStatus           = $LBL['display_status'];
                            $Sequence                = $LBL['sequence'];
                            $AccessFieldsBlock       = array();
                            foreach ($AccessFields as $FIE){
                                $FIE = (array) $FIE ;
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
                                echo '<div class="col-md-12 col-xl-12"><div class="card"><div class="card-body"><div class="row">';
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
                                                    echo '<option value="" selected>'.$Portal_Translate->Translate("CHOOSE_AN_OPTIONS").'</option>';
                                                    foreach ($ValuePickList as $Value){
                                                        echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
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
                                                    echo '<input type="tel" name="'.$FIE_Name.'--phone" class="form-control" placeholder="" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div></div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'email'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="email" name="'.$FIE_Name.'--email" class="form-control" placeholder="" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(info@gmail.com)</span><span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'date'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    if ($TypeDate == 'jalali'){
                                                        echo '<input type="text" name="'.$FIE_Name.'--date" class="form-control" placeholder="" required data-jdp>';
                                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    }else{
                                                        echo '<input type="date" name="'.$FIE_Name.'--date" class="form-control" placeholder="" required>';
                                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    }
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'image'){
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--image" id="formFile" type="file" required>';
                                                    echo '</div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'boolean'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                                    echo '<span class="custom-switch-description">'.$FIE_Label.'<span class="text-red">*</span></span>';
                                                    echo '<label class="custom-switch form-switch mb-0"  style="margin-right: 20px;margin-top: 10px">';
                                                    echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input">';
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
                                                    echo '<input type="number" class="form-control" id="price" name="'.$FIE_Name.'--double7" min="0" step="0.01" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                // % Darsad
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 9 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double9" min="0" step="0.01" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(%)</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'integer' && $FIE_UIType == 7 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--integer" name="tentacles" min="0" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'currency' && $FIE_UIType == 71 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--currency" min="0" required> ';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">('.$FIE_Type['symbol'].')</span><span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'url' && $FIE_UIType == 17){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="url" class="form-control" name="'.$FIE_Name.'--url" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(www.mysite.com)</span><span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'time'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="time" class="form-control" name="'.$FIE_Name.'--time">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64"></span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Gregorian Date'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="date" name="'.$FIE_Name.'--gregoriandate" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'customdatetime' && $FIE_ParsVTField['name'] == 'DateTime'){
                                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                                    if ($TypeDate == 'jalali'){
                                                        echo '<input type="text" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" data-jdp>';
                                                    }else{
                                                        echo '<input type="date" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="">';
                                                    }
                                                    echo '<label for="floatingInput">date<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="time" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">time<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Upload field'){
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--uploadfield" id="formFile" type="file">';
                                                    echo '</div>';
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
                                                    echo '<input type="color" name="'.$FIE_Name.'--ColorPicker" id="floatingInput" class="form-control" placeholder="" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //IP Address Field
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'IP Address Field'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="text" name="'.$FIE_Name.'--IPAddressField" id="floatingInput" class="form-control" placeholder=""required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //Plaque Field
                                                elseif ($FIE_Type['name'] == 'plaque' && $FIE_ParsVTField['name'] == 'Plaque Field') {
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '<span class="text-red">*</span></label>';
                                                    echo '<div class="row">';
                                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__"></div>';
                                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="3" maxlength="3" placeholder="___"></div>';
                                                    echo '<div class="col">';
                                                    $Val = $FIE_Type['plaqueMiddleChars'];
                                                    echo '<select style="" id="floatingInput" name="'.$FIE_Name.'--PlaqueField[]" class="form-control" >';
                                                    foreach ($Val as $Value){
                                                        echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                                    }
                                                    echo '</select>';
                                                    echo '</div>';
                                                    echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__"></div>';
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
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--Uploadfields[]" id="formFile" type="file" multiple required>';
                                                    echo '</div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'text'){
                                                    echo '<div class="col-sm-12 col-md-12"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<textarea type="email" name="'.$FIE_Name.'--text" class="form-control" placeholder="" required></textarea>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div></div></div>';
                                                }
                                                else{
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="text" name="'.$FIE_Name.'--string" class="form-control" placeholder="" required>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red">*</span></label>';
                                                    echo ' </div></div></div>';
                                                }
                                                ?>
                                            <?php }else{ ?>
                                                <?php
                                                if ($FIE_Type['name'] == 'picklist'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    $ValuePickList = $FIE_Type['picklistValues'];
                                                    echo '<select style="height: 58px" id="floatingInput" name="'.$FIE_Name.'--picklist" class="form-control">';
                                                    echo '<option value="" selected>'.$Portal_Translate->Translate('CHOOSE_AN_OPTIONS').'</option>';
                                                    foreach ($ValuePickList as $Value){
                                                        echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                                    }
                                                    echo '</select>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
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
                                                    echo '<input type="tel" name="'.$FIE_Name.'--phone" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'email'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="email" name="'.$FIE_Name.'--email" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(info@gmail.com)</span></label>';
                                                    echo ' </div></div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'date'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    if ($TypeDate == 'jalali'){
                                                        echo '<input type="text" name="'.$FIE_Name.'--date" class="form-control" placeholder="" data-jdp>';
                                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red"></span></label>';
                                                    }else{
                                                        echo '<input type="date" name="'.$FIE_Name.'--date" class="form-control" placeholder="">';
                                                        echo '<label for="floatingInput">'.$FIE_Label.'<span class="text-red"></span></label>';
                                                    }
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'image'){
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--image" id="formFile" type="file">';
                                                    echo '</div>';
                                                }
                                                //Checkbox
                                                elseif ($FIE_Type['name'] == 'boolean'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                                    echo '<span class="custom-switch-description">'.$FIE_Label.'</span>';
                                                    echo '<label class="custom-switch form-switch mb-0"  style="margin-right: 20px;margin-top: 10px">';
                                                    echo '<input type="checkbox" name="'.$FIE_Name.'--boolean" class="custom-switch-input">';
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
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double7" min="0" step="0.01" >';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                // % Darsad
                                                elseif ($FIE_Type['name'] == 'double' && $FIE_UIType == 9 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--double9" min="0" step="0.01" >';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(%)</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'integer' && $FIE_UIType == 7 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--integer" min="0">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //currency
                                                elseif ($FIE_Type['name'] == 'currency' && $FIE_UIType == 71 ){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="number" class="form-control" name="'.$FIE_Name.'--currency" min="0">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">('.$FIE_Type['symbol'].')</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //Web (URL)
                                                elseif ($FIE_Type['name'] == 'url' && $FIE_UIType == 17){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="url" class="form-control" name="'.$FIE_Name.'--url">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'<span style="margin-right: 10px;font-size:13px; color: #565e64">(www.mysite.com)</span></label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //Time
                                                elseif ($FIE_Type['name'] == 'time'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="time" class="form-control" name="'.$FIE_Name.'--time">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //Gregorian Date
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Gregorian Date'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="date" name="'.$FIE_Name.'--gregoriandate" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //DateTime
                                                elseif ($FIE_Type['name'] == 'customdatetime' && $FIE_ParsVTField['name'] == 'DateTime'){
                                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                                    if ($TypeDate == 'jalali'){
                                                        echo '<input type="text" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="" data-jdp>';
                                                    }else{
                                                        echo '<input type="date" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="">';
                                                    }
                                                    echo '<label for="floatingInput">date</label>';
                                                    echo ' </div> </div></div>';
                                                    echo '<div class="col-sm-3 col-md-3"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="time" name="'.$FIE_Name.'--datetime[]" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">time</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //upload file
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'Upload field'){
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--uploadfield" id="formFile" type="file">';
                                                    echo '</div>';
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
                                                    echo '<input type="color" name="'.$FIE_Name.'--ColorPicker" id="floatingInput" class="form-control" placeholder="">';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                //IP Address Field
                                                elseif ($FIE_Type['name'] == 'string' && $FIE_ParsVTField['name'] == 'IP Address Field'){
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="text" name="'.$FIE_Name.'--IPAddressField" id="floatingInput" class="form-control" placeholder="">';
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
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">' . $FIE_Label . '</label>';
                                                    echo '<div class="row">';
                                                        echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__"></div>';
                                                        echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="3" maxlength="3" placeholder="___"></div>';
                                                        echo '<div class="col">';
                                                            $Val = $FIE_Type['plaqueMiddleChars'];
                                                            echo '<select style="" id="floatingInput" name="'.$FIE_Name.'--PlaqueField[]" class="form-control" >';
                                                            foreach ($Val as $Value){
                                                                echo '<option value="'.$Value['value'].'">'.$Value['label'].'</option>';
                                                            }
                                                            echo '</select>';
                                                        echo '</div>';
                                                        echo '<div class="col"><input type="text" name="'.$FIE_Name.'--PlaqueField[]" id="floatingInput" class="form-control" minlength="2" maxlength="2" placeholder="__"></div>';
                                                        echo '<div class="col-1"><div class="pic2"><img src="resources/images/pelak.png" alt=""></div></div>';
                                                    echo '</div>';
                                                    echo '</div></div>';
                                                }
                                                //upload files
                                                elseif ($FIE_Type['name'] == 'text' && $FIE_ParsVTField['name'] == 'Upload fields'){
                                                    echo '<div class="form-group">';
                                                    echo '<label for="formFile" class="form-label mt-0">'.$FIE_Label.'</label>';
                                                    echo '<input class="form-control"  name="'.$FIE_Name.'--Uploadfields[]" id="formFile" type="file" multiple>';
                                                    echo '</div>';
                                                }
                                                elseif ($FIE_Type['name'] == 'text'){
                                                    echo '<div class="col-sm-12 col-md-12"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<textarea type="email" name="'.$FIE_Name.'--text" class="form-control" placeholder=""></textarea>';
                                                    echo '<label for="floatingInput">'.$FIE_Label.'</label>';
                                                    echo ' </div> </div></div>';
                                                }
                                                else{
                                                    echo '<div class="col-sm-6 col-md-6"><div class="form-group"><div class="form-floating" style="">';
                                                    echo '<input type="text" name="'.$FIE_Name.'--string" id="floatingInput" class="form-control" placeholder="">';
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
                    <input style="width: 200px" type="submit" class="btn btn-success" name="CreateRecord" value="<?php echo $Portal_Translate->Translate('BTN_CREATE'); ?>">
                    <a href="index.php?page=Main&module=<?= $_REQUEST['module'] ?>&view=List" style="width: 200px; color:white" type="submit" class="btn btn-danger"><?php echo $Portal_Translate->Translate('BTN_CANCELED'); ?></a>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>