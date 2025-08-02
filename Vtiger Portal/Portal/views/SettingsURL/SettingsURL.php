<?php ?>
<html lang="fa-IR" dir="rtl">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="ParsVtiger Portal">
    <meta name="author" content="limoostudio">
    <meta name="keywords" content="ParsVtiger Portal">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href=""/>

    <!-- TITLE -->
    <title>Settings CRM URL</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>


    <!-- STYLE CSS -->
    <link href="resources/css/style.css" rel="stylesheet"/>
    <link href="resources/css/CustomCSS.css" rel="stylesheet"/>
    <link href="resources/css/dark-style.css" rel="stylesheet"/>
    <link href="resources/css/transparent-style.css" rel="stylesheet">
    <link href="resources/css/skin-modes.css" rel="stylesheet"/>

    <!--- FONT-ICONS CSS -->
    <link href="resources/css/icons.css" rel="stylesheet"/>

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="resources/colors/color1.css"/>
    <link href="resources/switcher/css/switcher.css" rel="stylesheet"/>
    <link href="resources/switcher/demo.css" rel="stylesheet"/>
    <link rel="stylesheet" id="fonts" href="resources/fonts/styles-fa-num/iran-yekan.css">
    <link href="resources/css/rtl.css" rel="stylesheet"/>

    <script src="resources/customstyle/js/custom.js"></script>

    <link href="library/jalalidatepicker/jalalidatepicker.min.css" rel="stylesheet"/>
    <script src="library/jalalidatepicker/jalalidatepicker.min.js"></script>

</head>

<body class="app sidebar-mini rtl login-img">
<?php
$Portal_Translate = new Language();
if ($_SESSION['Type_Language'] == null && empty($_SESSION['Type_Language'])){
    $_SESSION['Type_Language'] = 'fa_ir';
}
?>

<div class="page">
    <div class="">
        <div id="PageRegistrationURL">
            <div style="" class="container-login100">
                <div class="wrap-login100 p-8">
                    <div class="">
                        <div class="">
                            <div class="">
                                <div class="panel panel-primary" id="MainPannel" style="display: block">
                                    <div class="tab-menu-heading tab-menu-heading-boxed">
                                        <div class="tabs-menu-boxed">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs fs-14">
                                                <li><a href="#activetabs" class="active" data-bs-toggle="tab"><?= $Portal_Translate->Translate("Selected Language") ?></a></li>
                                                <li><a href="#SettingsURL" class="" data-bs-toggle="tab"><?= $Portal_Translate->Translate("URL Settings") ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="activetabs">
                                                <hr><h5 class="card-title"><span>* </span><?= $Portal_Translate->Translate("Selected Your CRM Language") ?></h5> <hr>
                                                <form method="post">
                                                    <div class="input-group">
                                                        <div class="wrap-input100 validate-input input-group" id="">
                                                            <a class="input-group-text bg-white text-muted">
                                                                <i style="color: #74829c" class="fa fa-language" aria-hidden="true"></i>
                                                            </a>
                                                            <select style="color: #74829c" name="Language_Portal" class="input100 border-start-0 form-control ms-0" type="select" placeholder="Language">
                                                                <?php foreach (LANGUAGE_LIST as $language){ ?>
                                                                    <?php if ( $language['value'] == $_SESSION['Type_Language']){ ?>
                                                                        <option value="<?php echo $language['value'] ?>" selected><?php echo $language['label'] ?></option>
                                                                    <?php }else{ ?>
                                                                        <option value="<?php echo $language['value'] ?>"><?php echo $language['label'] ?></option>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                    <hr>
                                                    <input  type="submit" name="SubmitSelectedLanguage" value="<?php echo $Portal_Translate->Translate("CRM Language settings") ?>" class="login100-form-btn btn-primary RegisterLanguage">
                                                </form>
                                            </div>
                                            <div  class="tab-pane" id="SettingsURL">
                                                <hr><h5 class="card-title"><span style="color: red">* </span><?= $Portal_Translate->Translate("Enter Your CRM Address") ?></h5> <hr>
                                                <form method="post">
                                                    <div class="input-group">
                                                        <span style="width: " class="input-group-text" id="basic-addon1">URL</span>
                                                        <input id="LinkURL" style="width:" name="CRMLink" value="<?= $_POST['CRMLink'] ?>" type="text" class="form-control" placeholder="http://example.com" aria-label="" aria-describedby="basic-addon1">
                                                    </div>

                                                    <hr><hr>

                                                    <input type="hidden" id="URLSitePortalInSettingsURL" value="<?= PORTAL_URL ?>">
                                                    <input type="hidden" id="ContentsShowURL" value="<?= $Portal_Translate->Translate('ShowURlPopup');?>">

                                                    <a id="RegisterURLSettings" href="#popup1">
                                                        <div class="login100-form-btn btn-primary SettingsURL">
                                                            <?= $Portal_Translate->Translate("CRM URL Registration") ?>
                                                        </div>
                                                    </a>



                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="popup1" class="overlay closPopup" style="display:none">
                                    <div class="popupCustom">
                                        <h3><i class="icon icon-check fs-70 text-success lh-1 my-4 d-inline-block IconSuccessCustom"></i></h3>
                                        <h3><?= $Portal_Translate->Translate("Success URL Title") ?></h3>
                                        <hr>
                                        <span id="ShowURLPopup"></span>
                                        <hr>
                                        <div class="">
                                            <?= $Portal_Translate->Translate("Success URL Contents") ?>
                                        </div><br><hr>
                                        <div class="BTNCustomURL">
                                            <a id="GoToLoginSettings" class="btn btn-success" href="index.php?page=Login">
                                                <?= $Portal_Translate->Translate("BTN_Continue_URL") ?>
                                                <span id="LoaderBTNPopup" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            </a>
                                            <a id="GoSettingsAnsReset" class="btn btn-danger" href="#CloseReset"><?= $Portal_Translate->Translate("BTN_Cancel_URL") ?></a>
                                        </div>

                                    </div>
                                </div>

                                <div id="CloseReset" class="overlay closPopup DangerRegisterURL" style="display:none">
                                    <div class="popupCustom">
                                        <h3 style="text-align: right;"><?= $Portal_Translate->Translate("Success URL Title") ?></h3>
                                        <hr>
                                        <div class="">
                                            <?= $Portal_Translate->Translate("ResetUrlContent") ?>
                                        </div><br><hr>
                                        <div class="BTNCustomURL">
                                            <a id="LoaderClose" class="btn btn-danger" href="index.php"><?= $Portal_Translate->Translate("BTN_Close") ?></a>
                                            <span id="LoaderBTNPopupClose" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-content" id="DangerTest" style="display: none">
                            <div class="modal-body text-center p-4 pb-5">
                                <i class="icon icon-close fs-70 text-danger lh-1 my-4 d-inline-block"></i>
                                <h4 class="text-danger mb-20"><?= $Portal_Translate->Translate("ERROR URL TITLE") ?></h4>
                                <p class="mb-4 mx-4"> <?= $Portal_Translate->Translate("ERROR URL Contents") ?></p>
                                <a class="btn btn-danger" href="index.php"><?= $Portal_Translate->Translate("Close And Return") ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jalaliDatepicker.startWatch();
</script>
<!-- JQUERY JS -->
<script src="resources/js/jquery.min.js"></script>

<!-- Custom JS -->
<script src="resources/js/CustomJS.js"></script>
<script src="resources/js/CustomJSBeforLogin.js"></script>
<!-- BOOTSTRAP JS -->
<script src="resources/plugins/bootstrap/js/popper.min.js"></script>
<script src="resources/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- SHOW PASSWORD JS -->
<script src="resources/js/show-password.min.js"></script>
<!-- Perfect SCROLLBAR JS-->
<!--<script src="resources/plugins/p-scroll/perfect-scrollbar.js"></script>-->
<!-- Color Theme js -->
<script src="resources/js/themeColors.js"></script>
<!-- CUSTOM JS -->
<script src="resources/js/custom.js"></script>
<script src="resources/js/custom1.js"></script>
<!-- Switcher js -->
<!--<script src="resources/switcher/js/switcher.js"></script>-->
</body>


</html>