<?php
require ("views/ShowMessage.php");
require ("views/ProcessField.php");


if (isset($_GET['Message'])) {
    ShowMeassage($_GET['Message']);
}

$AccessFieldContacts      = $Parameters['data']['AccessFieldContacts'];
$AccessValueFieldContacts = $Parameters['data']['FieldValueContacts'];
$AccessBlocksContacts     = $Parameters['data']['BlocksContacts'];
$IDContacts               = $Parameters['data']['ContactsID'];
$PermissionsContacts      = $Parameters['data']['PermissionsContacts'];
$AccessFieldAccounts      = $Parameters['data']['AccessFieldAccounts'];
$AccessValueFieldAccounts = $Parameters['data']['FieldValueAccounts'];
$AccessBlocksAccounts     = $Parameters['data']['BlocksAccounts'];
$IDAccounts               = $Parameters['data']['AccountsID'];
$PermissionsAccounts      = $Parameters['data']['PermissionsAccounts'];
$TypeDate = $TypeDate     = $_SESSION['Type_Date'];


?>
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="card">
            <div class="card-body">
                <div class="card-pay">
                    <ul class="tabs-menu nav">
                        <li>
                            <a href="#tab20" data-bs-toggle="tab" class="active">
                                <i style="margin-left: 20px" class="fa fa-user" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-user" aria-label="fa fa-user"></i>
                                <?php echo $Portal_Translate->Translate('PRO_TAB_CUSTOMER_INFO'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#tab22" data-bs-toggle="tab" class=""><i style="margin-left: 20px"class="fa fa-modx" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-modx" aria-label="fa fa-modx"></i>
                                <?php echo  $Portal_Translate->Translate('PRO_TAB_ACCOUNT_INFO'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="#tab33" data-bs-toggle="tab" class=""><i style="margin-left: 20px"class="fa fa-modx" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-modx" aria-label="fa fa-modx"></i>
                                <?php echo $Portal_Translate->Translate('PRO_TAB_CHANGE_PASS'); ?>
                            </a>
                        </li>
                    </ul>
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
            <div class="tab-content">
                <div class="tab-pane show active" id="tab20">
                    <div style="margin-right: 3%; margin-top: -2%; margin-bottom: -2%">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover">
                                                <div class="profile-cover__action bg-img"></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-1">
                                                        <img src="resources/images/users/Custom.jpg" alt="img">
                                                    </div>
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2"><?= $_SESSION['CustomerDetails']['firstname'] . ' ' . $_SESSION['CustomerDetails']['lastname'] ?></h3>
                                                            <h5 class="text-muted"><?= $Portal_Translate->Translate("USER_TYPE") ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-profile">
                                                    <?php if ($PermissionsContacts['AllowEdit'] != 0){ ?>
                                                    <a href="index.php?page=Profile&view=Edit&record=<?= $IDContacts ?>&type=User" class="btn btn-primary mt-1 mb-1">
                                                        <i class="fa fa-edit"></i>
                                                        <span><?= $Portal_Translate->Translate("BTN_EDIT") ?></span>
                                                    </a>
                                                    <?php } ?>
                                                    <a href="index.php?page=Dashboard" class="btn btn-secondary mt-1 mb-1">
                                                        <i class="fa fa-arrow-circle-right"></i>
                                                        <span style="color:white"><?= $Portal_Translate->Translate("Go To Dashboard") ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="px-0 px-sm-4">
                                                <div class="social social-profile-buttons mt-5 float-end">
                                                    <div class="mt-3">
<!--                                                        <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>-->
<!--                                                        <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>-->
<!--                                                        <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>-->
<!--                                                        <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>-->
<!--                                                        <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>-->
<!--                                                        <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $ProcessField = ProcessFieldDetaile(null , null  , $AccessBlocksContacts , $AccessFieldContacts , array()  , array() , $AccessValueFieldContacts , array() , array() , $TypeDate);
                    ?>
                </div>
                <div class="tab-pane show" id="tab22">
                    <div style="margin-right: 3% ; margin-top: -2%; margin-bottom: -2%">
                        <div class="card-body">
                            <div class="wideget-user mb-2">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row">
                                            <div class="panel profile-cover">
                                                <div class="profile-cover__action bg-img"></div>
                                                <div class="profile-cover__img">
                                                    <div class="profile-img-1">
                                                        <img src="resources/images/users/Accounts.png" alt="img">
                                                    </div>
                                                    <div class="profile-img-content text-dark text-start">
                                                        <div class="text-dark">
                                                            <h3 class="h3 mb-2"><?= $_SESSION['CompanyDetails']['accountname']?></h3>
                                                            <h5 class="text-muted"><?= $Portal_Translate->Translate("ACCOUNT_TYPE") ?></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="btn-profile">
                                                    <?php if ($PermissionsAccounts['AllowEdit'] != 0){ ?>
                                                    <a href="index.php?page=Profile&view=Edit&record=<?= $IDAccounts ?>&type=Account" class="btn btn-primary mt-1 mb-1">
                                                        <i class="fa fa-edit"></i>
                                                        <span><?= $Portal_Translate->Translate("BTN_EDIT") ?></span>
                                                    </a>
                                                    <?php } ?>
                                                    <a href="index.php?page=Dashboard" class="btn btn-secondary mt-1 mb-1">
                                                        <i class="fa fa-arrow-circle-right"></i>
                                                        <span style="color:white"><?= $Portal_Translate->Translate("Go To Dashboard") ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="px-0 px-sm-4">
                                                <div class="social social-profile-buttons mt-5 float-end">
                                                    <div class="mt-3">
                                                        <!--                                                        <a class="social-icon text-primary" href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a>-->
                                                        <!--                                                        <a class="social-icon text-primary" href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a>-->
                                                        <!--                                                        <a class="social-icon text-primary" href="https://www.youtube.com/" target="_blank"><i class="fa fa-youtube"></i></a>-->
                                                        <!--                                                        <a class="social-icon text-primary" href="javascript:void(0)"><i class="fa fa-rss"></i></a>-->
                                                        <!--                                                        <a class="social-icon text-primary" href="https://www.linkedin.com/" target="_blank"><i class="fa fa-linkedin"></i></a>-->
                                                        <!--                                                        <a class="social-icon text-primary" href="https://myaccount.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $ProcessField = ProcessFieldDetaile(null , null  , $AccessBlocksAccounts , $AccessFieldAccounts , array()  , array() , $AccessValueFieldAccounts , array() , array() , $TypeDate);
                    ?>
                </div>
                <div class="tab-pane show" id="tab33">
                    <div class="col-md-12 col-xl-9">
                        <div class="card-header">
                            <h5 class="card-title"><span style="color: red ; margin-left: 10px">*</span><span><?php echo $Portal_Translate->Translate('PRO_FILLING_ALL_FIELDS_IS_MANDATORY'); ?></span></h5>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post">
                                <div class=" row mb-4">
                                    <label for="inputPassword3" class="col-md-3 form-label"><?php echo $Portal_Translate->Translate('PRO_CHANGE_PASS_CURRENT_PASS'); ?><span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="password" name="CurrentPassword" class="form-control" id="inputPassword3" placeholder="<?php echo $Portal_Translate->Translate('PRO_CHANG_PASS_OLD'); ?>" autocomplete="new-password" required>
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="inputPassword3" class="col-md-3 form-label"><?php echo $Portal_Translate->Translate('PRO_CHANGE_PASS_NEW_PASS'); ?><span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="password" name="NewPassword" class="form-control" id="inputPassword3" placeholder="<?php echo $Portal_Translate->Translate('PRO_CHANG_PASS_NEW'); ?>" autocomplete="new-password" required>
                                    </div>
                                </div>
                                <div class=" row mb-4">
                                    <label for="inputPassword3" class="col-md-3 form-label"><?php echo $Portal_Translate->Translate('PRO_CHANGE_PASS_REPEAT_PASS'); ?><span style="color: red">*</span></label>
                                    <div class="col-md-9">
                                        <input type="password" name="RepetitionNewPassword" class="form-control" id="inputPassword3" placeholder="<?php echo $Portal_Translate->Translate('PRO_CHANGE_REPEAT_PASS'); ?>" autocomplete="new-password" required>
                                    </div>
                                </div><hr>
                                <div class="mb-0 mt-4 row justify-content-end">
                                    <div class="col-md-9">
                                        <input type="submit" name="Data_Change_Password" value="<?php echo $Portal_Translate->Translate('BTN_CHANGE_PASS'); ?>" class="btn btn-primary">
                                        <!--<input type="submit" name="Data_CancelChange_Password" value="<?php /* echo $Portal_Translate->Translate('BTN_CANCELED'); */?>" class="btn btn-primary">-->
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







    <!--            <div class="card-body">-->
    <!--                <ol class="breadcrumb1 bg-secondary">-->
    <!--                    <li class="breadcrumb-item"><i class="fe fe-user-check me-2 text-white" aria-hidden="true"></i></li>-->
    <!--                    <span class="text-white">--><?php //echo $Portal_Translate->Translate('PRO_CUSTOMER_INFORMATION'); ?><!--</span>-->
    <!--                </ol>-->
    <!--            </div>-->
<?php
//$TypeDate     = $_SESSION['Type_Date'];
//foreach ($AccessFieldAccounts as $field){
//
//    $FieldName        = $field['name'];
//    $FieldLabel       = $field['label'];
//    $FieldMandatory   = $field['mandatory'];
//    $FieldType        = $field['type'];
//    $FieldUIType      = $field['uitype'];
//    $FieldEditable    = $field['editable'];
//
//    $FiledNameByName  = explode('_' , $FieldName);
//
//    $PlaceholderField = ''  ;
//    $StatusMandatory  = '';
//    $Color            = '';
//    $Emoji            = '';
//    //echo $FieldUIType . ': ' . $FieldLabel;
//    if (isset($FiledNameByName[2])){
//        //تاریخ میلادی
//        if ($FiledNameByName[2] === 'gdt'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ارجاع به
//        if ($FiledNameByName[2] === 'id'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName]['label'];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //آپلود فایل
//        else if ($FiledNameByName[2] === 'ulf'){
//            echo '<div class="col-sm-6 col-md-12">';
//            echo '<div class="form-group">';
//            echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
//            //echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--UploadFile" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
//            echo 'پیاده سازی نشده';
//            echo '</div>' ;
//            echo '</div>' ;
//        }
//
//        //آپلود چند فایل و عکس
//        else if ($FiledNameByName[2] === 'muf'){
//            echo '<div class="form-group">';
//            echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
//            //echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--Uploadfields[]" placeholder="'.$FieldLabel.'" '.$StatusMandatory.' multiple>';
//            echo 'پیاده سازی نشده';
//            echo '</div>' ;
//        }
//
//        //موقیعت جغرافیایی
//        else if ($FiledNameByName[2] === 'gps'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد امتیاز دهی
//        else if ($FiledNameByName[2] === 'srf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد رضایت مشتری
//        else if ($FiledNameByName[2] === 'erf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد انتخاب رنگ
//        else if ($FiledNameByName[2] === 'cpf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد آدرس ای پی
//        else if ($FiledNameByName[2] === 'ipl'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد آب و هوا
//        else if ($FiledNameByName[2] === 'pwf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //رکورد ویدئو
//        else if ($FiledNameByName[2] === 'rvf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ضبط ضدا
//        else if ($FiledNameByName[2] === 'vrf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد جمع بندی
//        else if ($FiledNameByName[2] === 'ruf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="zmdi zmdi-hospital" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد فرمول
//        else if ($FiledNameByName[2] === 'aff'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد گرید
//        else if ($FiledNameByName[2] === 'vgf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="zmdi zmdi-hospital" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد پلاک
//        else if ($FiledNameByName[2] === 'vgf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="" aria-hidden="true"></i>';
//            echo 'پیاده سازی نشده';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //کد ملی
//        else if ($FiledNameByName[2] === 'irc'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-navicon" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد نام واحد پولی
//        else if ($FiledNameByName[2] === 'cnf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-dollar" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName]['label'];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد لیست کاربران
//        else if ($FiledNameByName[2] === 'cul'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="zmdi zmdi-hospital" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد تاریخ و زمان
//        else if ($FiledNameByName[2] === 'dtf'){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-calendar-times-o" aria-hidden="true"></i>';
//            $DateTime = explode(' ' , $AccessValueFieldAccounts[$FieldName]);
//            if ($TypeDate == 'jalali'){
//                $JalalyDate  = jdate('Y/m/d', strtotime($DateTime[0]));
//                echo  $DateTime[1] . ' ' . $JalalyDate;
//            }else{
//                echo  $DateTime[1] .' '. $DateTime[0];
//            }
//            echo '</span>';
//            echo '</div>';
//        }
//    }else{
//        if ($FieldUIType == '55' || $FieldUIType == 255 || $FieldUIType == 1|| $FieldUIType == 4){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-navicon" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //تلفن
//        elseif ($FieldUIType == 11){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-phone" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ایمیل
//        elseif ($FieldUIType == 13){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-gbp" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //واحد پولی
//        elseif ($FieldUIType == 71){
//            if ($FieldType['name'] == 'currency'){
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//                echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//                echo '<i style="margin-left: 10px" class="fa fa-dollar" aria-hidden="true"></i>';
//                echo $AccessValueFieldAccounts[$FieldName] . ' ' . $FieldType['symbol'];
//                echo '</span>';
//                echo '</div>';
//            }
//
//        }
//
//        //فهرست انتخابی
//        elseif ($FieldUIType == 15 || $FieldUIType == 16){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-stack-exchange" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ادرس وب
//        elseif ($FieldUIType == 17){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-link"></i>';
//            echo '<a target="_blank" href="'.$AccessValueFieldAccounts[$FieldName].'">'.$AccessValueFieldAccounts[$FieldName].'</a>';
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ازمام
//        elseif ($FieldUIType == 14){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-clock-o"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //فیلد مرتبط
//        elseif ($FieldUIType == 51 || $FieldUIType == 57){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-stack-exchange" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName]['label'];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //ارجاع به
//        /*elseif ($FieldUIType == 53){
//            echo "fffffffffffffffffffffffffffffffffffffffffff";
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-stack-exchange" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName]['label'];
//            echo '</span>';
//            echo '</div>';
//        }*/
//
//        //تاریخ و زمان
//        elseif ($FieldUIType == 70){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-calendar-times-o" aria-hidden="true"></i>';
//            $DateTime = explode(' ' , $AccessValueFieldAccounts[$FieldName]);
//            if ($TypeDate == 'jalali'){
//                $JalalyDate  = jdate('Y/m/d', strtotime($DateTime[0]));
//                echo  $DateTime[1] . ' ' . $JalalyDate;
//            }else{
//                echo  $DateTime[1] .' '. $DateTime[0];
//            }
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //تاریخ
//        elseif ($FieldUIType == 5){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-calendar" aria-hidden="true"></i>';
//            if ($TypeDate == 'jalali'){
//                $JalalyDate  = jdate('Y/m/d', strtotime($AccessValueFieldAccounts[$FieldName]));
//                echo $JalalyDate;
//            }else{
//                echo $AccessValueFieldAccounts[$FieldName];
//            }
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //boolean
//        elseif ($FieldUIType == 56){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            if ($AccessValueFieldAccounts[$FieldName] == 1){
//                echo '<i style="color: green" class="fa fa-check" data-bs-toggle="tooltip" title=""></i> بلی';
//            }else{
//                echo '<i style="color: red" class="fa fa-remove" data-bs-toggle="tooltip" title=""></i> خیر';
//            }
//            echo '</span>';
//            echo '</div>';
//
//        }
//
//        //text
//        elseif ($FieldUIType == 21 || $FieldUIType == 19){
//            echo "<div class='row'>";
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-9">';
//            echo '<span name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-file-text" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//            echo '</div>';
//        }
//
//        //مقادیر قابل انتخاب گروهی
//        else if ($FieldUIType == 33){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="zmdi zmdi-hospital" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//        //عکس مخاطب
//        /*elseif ($FieldUIType == 69){
//            echo "<div class='row'>";
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-9">';
//            echo '<span name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-list" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//            echo '</div>';
//        }*/
//
//        //عدد اعشار و عدد صحیح
//        elseif ($FieldUIType == 7){
//
//            if ($FieldType['name'] == 'integer'){
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//                echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//                echo '<i style="margin-left: 10px" class="fa fa-sort-numeric-asc" aria-hidden="true"></i>';
//                echo $AccessValueFieldAccounts[$FieldName] ;
//                echo '</span>';
//                echo '</div>';
//            }
//            if ($FieldType['name'] == 'double'){
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//                echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//                echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//                echo '<i style="margin-left: 10px" class="fa fa-sort-numeric-asc" aria-hidden="true"></i>';
//                echo $AccessValueFieldAccounts[$FieldName] ;
//                echo '</span>';
//                echo '</div>';
//            }
//
//        }
//
//        //درصد
//        elseif ($FieldUIType == 9){
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3"><label for="">'.$field['label'].'</label></div>';
//            echo '<div style="padding-bottom: 10px" class="col-sm-3 col-md-3">';
//            echo '<span type="email" name="'.$FieldName.'" class="form-control" placeholder="">';
//            echo '<i style="margin-left: 10px" class="fa fa-percent" aria-hidden="true"></i>';
//            echo $AccessValueFieldAccounts[$FieldName];
//            echo '</span>';
//            echo '</div>';
//        }
//
//    }
//}
//?>