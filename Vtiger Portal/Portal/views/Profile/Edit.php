<?php

if ($_REQUEST['type'] != 'User' || $_REQUEST['type']){
    header("location: index.php?page=Profile&view=Detail");
}

require ("views/ShowMessage.php");
require ("views/ProcessField.php");

if (isset($_GET['Message'])) {
ShowMeassage($_GET['Message']);
}

$AccessFieldContacts      = $Parameters['data']['AccessFieldContacts'];
$AccessValueFieldContacts = $Parameters['data']['FieldValueContacts'];
$AccessBlocksContacts     = $Parameters['data']['BlocksContacts'];
$PermissionsContacts      = $Parameters['data']['PermissionsContacts'];
$AccessFieldAccounts      = $Parameters['data']['AccessFieldAccounts'];
$AccessValueFieldAccounts = $Parameters['data']['FieldValueAccounts'];
$AccessBlocksAccounts     = $Parameters['data']['BlocksAccounts'];
$PermissionsAccounts      = $Parameters['data']['PermissionsAccounts'];
$TypeDate                 = $_SESSION['Type_Date'];

$Portal_Translate = new Language();

?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="col-md-12 col-xl-12">
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
            <div class="card">
                <?php
                if ($_REQUEST['type'] == 'User' ){
                    if ($PermissionsContacts['AllowEdit'] == 0){
                        echo '
                        <div class="page">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center p-4 pb-5">
                                    <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                                    <i class="icon icon-close fs-70 text-danger lh-1 my-4 d-inline-block"></i>
                                    <h4 class="text-danger mb-20">'. $Portal_Translate->Translate("ERROR URL TITLE").'</h4>
                                    <hr>
                                    <p class="mb-4 mx-4">'.$Portal_Translate->Translate("ERROR URL Contents Edit").'</p>
                                    <hr style="text-align: right">
                                    <a class="btn btn-primary" href="index.php?page=Profile&view=Detail">'.$Portal_Translate->Translate("BTN_RET_RO").'</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        ';
                    }else{
                        $Process = ProcessFieldEdit(null , null , $AccessBlocksContacts , $AccessFieldContacts , array() , array() , $AccessValueFieldContacts , array() , array() , $TypeDate);
                    }
                }else if ($_REQUEST['type'] == 'Account'){
                    if ($PermissionsAccounts['AllowEdit'] == 0){
                    echo '
                        <div class="page">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center p-4 pb-5">
                                    <button aria-label="Close" class="btn-close position-absolute" data-bs-dismiss="modal"><span aria-hidden="true">×</span></button>
                                    <i class="icon icon-close fs-70 text-danger lh-1 my-4 d-inline-block"></i>
                                    <h4 class="text-danger mb-20">'. $Portal_Translate->Translate("ERROR URL TITLE").'</h4>
                                    <hr>
                                    <p class="mb-4 mx-4">'.$Portal_Translate->Translate("ERROR URL Contents Edit").'</p>
                                    <hr style="text-align: right">
                                    <a class="btn btn-primary" href="index.php?page=Profile&view=Detail">'.$Portal_Translate->Translate("BTN_RET_RO").'</a>
                                </div>
                            </div>
                        </div>
                        </div>
                        ';
                    }else{
                        $Process = ProcessFieldEdit(null , null , $AccessBlocksAccounts , $AccessFieldAccounts , array() , array() , $AccessValueFieldAccounts , array() , array() , $TypeDate);
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>