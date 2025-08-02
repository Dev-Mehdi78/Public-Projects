<?php
require ("views/CustomViewFields.php");
require ("views/ShowMessage.php");
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->

        <?php
        if (isset($_GET['Message'])){
            ShowMeassage($_GET['Message']);
        }
        ?>

        <?php
        //Error In Webservice
        if (isset($Parameters['ErrorModuleWebSide'])){ ?>
            <div class="main-container container-fluid">
                <div class="page-header">
                    <h1 class="page-title"><a href="index.php?page=Dashboard"><?php echo $Portal_Translate->Translate('HEADER_ERROR_PAGE'); ?></a></h1>
                </div>
                <div class="text-wrap">
                    <div class="">
                        <div class="alert alert-danger">
                            <!--<button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>-->
                            <span class=""><svg xmlns="http://www.w3.org/2000/svg" height="40" width="40" viewBox="0 0 24 24"><path fill="#f07f8f" d="M20.05713,22H3.94287A3.02288,3.02288,0,0,1,1.3252,17.46631L9.38232,3.51123a3.02272,3.02272,0,0,1,5.23536,0L22.6748,17.46631A3.02288,3.02288,0,0,1,20.05713,22Z"></path><circle cx="12" cy="17" r="1" fill="#e62a45"></circle><path fill="#e62a45" d="M12,14a1,1,0,0,1-1-1V9a1,1,0,0,1,2,0v4A1,1,0,0,1,12,14Z"></path></svg></span>
                            <strong><?php echo $Portal_Translate->Translate('HEADER_ERROR_TYPE_MESSAGE'); ?></strong>
                            <hr class="message-inner-separator">
                            <p><?php echo $Portal_Translate->Translate('HEADER_ERROR_CONTENT_PAGE'); ?></p>
                            <?php
                            if (isset($Parameters['ErrorCode']) && isset($Parameters['ErrorMessage'])){
                                echo '<div style="text-align: left" class="">';
                                echo '<b>ErrorCode: </b><span id="">'.$Parameters['ErrorCode'].'</span><br>';
                                echo '<b>ErrorMessage: </b><span id="">'.$Parameters['ErrorMessage'].'</span>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </div>
        <?php }else{
        //Continue
        $PramsListView     = $Parameters['ParamsListView']['DescribeFetchRecord']['result'];
        $HeaderInfo        = $PramsListView ['headers'];
        $RecordInfoInfo    = $PramsListView ['records'];
        $ModuleInfo        = $PramsListView ['describe'];
        $ModuleLabel       = $ModuleInfo['label'];
        $ModuleName        = $ModuleInfo['name'];
        $AccessField       = $ModuleInfo['fields'];
        $AllowCreate       = $ModuleInfo['permissions']['AllowCreate'];
        $AllowEdit         = $ModuleInfo['permissions']['AllowEdit'];
        $TypeDate          = $_SESSION['Type_Date'];
        ?>
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">
                    <a href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=List"><?php echo $ModuleLabel ?></a></h1>                <div>
                    <ol class="breadcrumb">
                        <?php if ($AllowCreate == 1){ ?>
                        <a style="margin-left: 10px" href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=Create" class="btn btn-success"><?= $Portal_Translate->Translate('BTN_ADDED') ?></a>
                        <?php } ?>
                        <a href="index.php" class="btn btn-primary"><?= $Portal_Translate->Translate('Go To Dashboard') ?></a>
                    </ol>
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

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $ModuleLabel ?></h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <input type="hidden" id="TABLE_HEADER_Visit"        value="<?= $Portal_Translate->Translate('TABLE_HEADER_Visit') ?>">
                                    <input type="hidden" id="TABLE_HEADER_Record"       value="<?= $Portal_Translate->Translate('TABLE_HEADER_Record') ?>">
                                    <input type="hidden" id="TABLE_HEADER_Duplicate"    value="<?= $Portal_Translate->Translate('TABLE_HEADER_Duplicate') ?>">
                                    <input type="hidden" id="TABLE_HEADER_Exel"         value="<?= $Portal_Translate->Translate('TABLE_HEADER_Exel') ?>">
                                    <input type="hidden" id="TABLE_HEADER_PDF"          value="<?= $Portal_Translate->Translate('TABLE_HEADER_PDF') ?>">
                                    <input type="hidden" id="TABLE_HEADER_VisitColumn"  value="<?= $Portal_Translate->Translate('TABLE_HEADER_VisitColumn') ?>">
                                    <input type="hidden" id="TABLE_HEADER_Search"       value="<?= $Portal_Translate->Translate('TABLE_HEADER_Search') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_TO"           value="<?= $Portal_Translate->Translate('TABLE_FOOTER_TO') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_FROM"         value="<?= $Portal_Translate->Translate('TABLE_FOOTER_FROM') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_PRE"          value="<?= $Portal_Translate->Translate('TABLE_FOOTER_PRE') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_Next"         value="<?= $Portal_Translate->Translate('TABLE_FOOTER_Next') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_NOTFOUND"     value="<?= $Portal_Translate->Translate('TABLE_FOOTER_NOTFOUND') ?>">
                                    <input type="hidden" id="TABLE_FOOTER_FilteredFrom" value="<?= $Portal_Translate->Translate('TABLE_FOOTER_FilteredFrom') ?>">
                                    <table id="file-datatable" class="table table-bordered text-nowrap key-buttons border-bottom">
                                        <thead>
                                            <tr>
                                                <?php
                                                $HeaderFieldsName = array();
                                                if (!empty($HeaderInfo)){
                                                    echo '<th class="">'.$Portal_Translate->Translate('LIST_VIEW_OPERATION').'</th>';
                                                    foreach ($HeaderInfo as $Key=>$Header){
                                                        $KeyCustomField = explode('_' , $Key);
                                                        if (isset($KeyCustomField[2]) && ($KeyCustomField[2] == 'ulf' || $KeyCustomField[2] == 'muf')){

                                                        }
                                                        else if ($Key != 'id' && $Key != 'description' && $Key!= 'imageattachmentids'){
                                                            echo '<th class="border-bottom-0">'.$Header.'</th>';
                                                            array_push($HeaderFieldsName , $Key);
                                                        }
                                                    }
                                                }

                                                ?>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (isset($_REQUEST['filter']) && $ModuleName == 'HelpDesk'){
                                                $FilterModule = $_REQUEST['filter'];
                                                $RecordList   = array();
                                                foreach ($RecordInfoInfo as $Filter){
                                                    if ($Filter['ticketstatus'] == 'open' || $Filter['ticketstatus'] == 'Open' || $Filter['ticketstatus']  == 'باز'){
                                                        array_push($RecordList , $Filter);
                                                    }
                                                }
                                                $RecordInfoInfo = $RecordList;
                                            }
                                            foreach ($RecordInfoInfo as $Record){
                                                echo '<tr>';
                                                echo '<td>';
                                                echo '<span title="'.  $Portal_Translate->Translate('LIST_VIEW_OPERATION_VISIT') .'">';
                                                echo '<a href="index.php?page=Main&module='.$ModuleName.'&view=Detail&record='.$Record['id'].'" id="bDel" type="button" class="btn  btn-sm btn-success"><span class="fa fa-info"> </span></a>';
                                                echo '</span>';
                                                if ($AllowEdit == 1) {
                                                    echo '<span title="'. $Portal_Translate->Translate('LIST_VIEW_OPERATION_EDIT') .'"><a href="index.php?page=Main&module=' . $ModuleName . '&view=Edit&record=' . $Record['id'] . '" id="bEdit" type="button" class="btn btn-sm btn-primary"><span class="fe fe-edit"> </span></a></span>';
                                                }
                                                echo   '</td>';

                                            foreach ($HeaderFieldsName as $FieldName) {
                                                $UITypeFields = GetTypeFields($FieldName, $AccessField);
                                                if ($FieldName != 'id' && $FieldName != 'description') {

                                                    //Related Field
                                                    if ($UITypeFields['type']['name']  == 'reference') {
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName]['label'] . '</td>';
                                                    }

                                                    // owner (assigned user id)
                                                    else if ($UITypeFields['type']['name'] == 'owner') {
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName]['label'] . '</td>';
                                                    }

                                                    // create date time (createdtime)
                                                    else if ($UITypeFields['type']['name'] == 'datetime' || $UITypeFields['type']['name'] == 'customdatetime') {
                                                        if ($TypeDate == 'jalali'){
                                                            $TimeDateArr = explode(' ' , $Record[$FieldName]);
                                                            $DateArr     = $TimeDateArr[0];
                                                            $TimeArr     = $TimeDateArr[1];
                                                            $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $TimeArr . ' ' . $JalalyDate . '</td>';
                                                        }else{
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName] . '</td>';
                                                        }

                                                    }

                                                    // date (date)
                                                    else if ($UITypeFields['type']['name'] == 'date') {
                                                        if ($TypeDate == 'jalali'){
                                                            $TimeDateArr = explode(' ' , $Record[$FieldName]);
                                                            $DateArr     = $TimeDateArr[0];
                                                            $TimeArr     = $TimeDateArr[1];
                                                            $JalalyDate  = jdate('Y/m/d', strtotime($DateArr));
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $TimeArr . ' ' . $JalalyDate . '</td>';
                                                        }else{
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName] . '</td>';
                                                        }

                                                    }

                                                    // double %
                                                    else if ($UITypeFields['type']['name'] == 'double' && !isset($UITypeFields['parsvtfield']['name']) && $UITypeFields['uitype'] == 9) {
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' . '% ' . $Record[$FieldName] . '</td>';
                                                    }

                                                    // Rating Field %
                                                    else if ($UITypeFields['type']['name'] == 'double' && isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Rating Field') {
                                                        $Rating = str_replace('%' , '' ,  $Record[$FieldName]);
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' .  $Rating . '/' . '5' . '</td>';
                                                    }

                                                    // Customer Satisfaction Field %
                                                    else if ($UITypeFields['type']['name'] == 'double' && isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Customer Satisfaction Field') {
                                                        switch ($Record[$FieldName]) {
                                                            case "1":
                                                                $ResultCustomer = 'ناامید';
                                                                break;
                                                            case "2":
                                                                $ResultCustomer = 'بسیار ناراضی';
                                                                break;
                                                            case "3":
                                                                $ResultCustomer = 'تقریبا ناراضی';
                                                                break;
                                                            case "4":
                                                                $ResultCustomer = 'کمی ناراضی';
                                                                break;
                                                            case "5":
                                                                $ResultCustomer = 'خنثی';
                                                                break;
                                                            case "6":
                                                                $ResultCustomer = 'کمی راضی';
                                                                break;
                                                            case "7":
                                                                $ResultCustomer = 'تقریبا راضی';
                                                                break;
                                                            case "8":
                                                                $ResultCustomer = 'بسیار راضی';
                                                                break;
                                                            case "9":
                                                                $ResultCustomer = 'کاملا راضی';
                                                                break;

                                                        }
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' .  $ResultCustomer . '</td>';
                                                    }

                                                    // currency
                                                    else if ($UITypeFields['type']['name'] == 'currency') {
                                                        $symbol = GetTypeSymbolCurrency($AccessField);
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName] . ' ' . $symbol . '</td>';
                                                    }

                                                    // currency name
                                                    else if ($UITypeFields['type']['name'] == 'picklist' && isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Currency name') {
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName]['label'] . '</td>';
                                                    }

                                                    // UploadFile
                                                    else if ($UITypeFields['type']['name'] == 'string' && isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Upload field') {
                                                       /* $CustomFile = explode('$$' , $Record[$FieldName])[0];
                                                        $ImageName  = explode('/' , $CustomFile);
                                                        $ImageName  = end($ImageName);
                                                        echo '<td value="' . $Record[$FieldName]['value'] . '"><a href="'.CRM_URL.'/'.$CustomFile.'">'.$ImageName.'</a></td>';*/
                                                    }

                                                    // UploadFilesssss
                                                    else if ($UITypeFields['type']['name'] == 'text' && isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Upload fields') {
                                                        /*echo '<td>';
                                                        $FieldsArray  = explode('||' , $Record[$FieldName]);
                                                        foreach ($FieldsArray as $Field){
                                                            $CustomFile001 = explode('$$' , $Field)[0];
                                                            $ImageName001  = explode('/' , $CustomFile001);
                                                            $ImageName001  = end($ImageName001);
                                                            echo '<a href="'.CRM_URL.'/'.$CustomFile001.'">'.$ImageName001.'</a>' . ' ' . '/' . ' ';
                                                        }
                                                        echo '</td>';*/
                                                    }

                                                    // Users List
                                                    else if ($UITypeFields['type']['name'] == 'multipicklist') {
                                                        if (isset($UITypeFields['parsvtfield']) && $UITypeFields['parsvtfield']['name'] == 'Users List'){
                                                            $UserIDPickList     = explode(',' , $Record[$FieldName]) ;
                                                            $PickListValueUsers =  $UITypeFields['type']['picklistValues'];
                                                            $UserName           = array();
                                                            foreach ($UserIDPickList as $User){
                                                                foreach ($PickListValueUsers as $ValuePickUser){
                                                                    $ValuePickUser = $ValuePickUser;
                                                                    if ($ValuePickUser['value'] == $User){
                                                                        array_push( $UserName , $ValuePickUser['label']);
                                                                    }
                                                                }
                                                            }
                                                            $UserFinal = implode(',' , $UserName);
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $UserFinal . '</td>';
                                                        }else{
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">' . $Record[$FieldName] . '</td>';
                                                        }
                                                    }

                                                    // boolean check box
                                                    else if ($UITypeFields['type']['name'] == 'boolean') {
                                                        if ($Record[$FieldName] == true) {
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">'. $Portal_Translate->Translate('BOOL_YES') .'</td>';
                                                        }else{
                                                            echo '<td value="' . $Record[$FieldName]['value'] . '">خیر</td>';
                                                        }
                                                    }

                                                    else {
                                                        echo '<td>' . $Record[$FieldName] . '</td>';
                                                    }
                                                }
                                            }
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>