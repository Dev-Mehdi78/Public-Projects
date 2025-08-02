<?php require ("views/ShowMessage.php"); ?>
<!doctype html>
<html lang="fa-IR" dir="ltr">
    <head>
        <!-- META DATA -->
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="ParsVtiger Portal">
        <meta name="author" content="limoostudio">
        <meta name="keywords" content="ParsVtiger Portal">

        <!-- FAVICON -->
        <link rel="shortcut icon" type="image/x-icon" href="" />

        <!-- TITLE -->
        <title>Login</title>

        <!-- BOOTSTRAP CSS -->
        <link id="style" href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

        <!-- STYLE CSS -->
        <link href="resources/css/style.css" rel="stylesheet" />
        <link href="resources/css/dark-style.css" rel="stylesheet" />
        <link href="resources/css/transparent-style.css" rel="stylesheet">
        <link href="resources/css/skin-modes.css" rel="stylesheet" />

        <!--- FONT-ICONS CSS -->
        <link href="resources/css/icons.css" rel="stylesheet" />

        <!-- COLOR SKIN CSS -->
        <link id="theme" rel="stylesheet" type="text/css" media="all" href="resources/colors/color1.css" />
        <link href="resources/switcher/css/switcher.css" rel="stylesheet" />
        <link href="resources/switcher/demo.css" rel="stylesheet" />
        <link rel="stylesheet" id="fonts" href="resources/fonts/styles-fa-num/iran-yekan.css">
        <link href="resources/css/rtl.css" rel="stylesheet" />
        <script src="resources/customstyle/js/custom.js"></script>
    </head>

    <style>
        .backgroundColor {
            background: #565e64;
        }
    </style>

    <body class="backgroundColor">

        <?php $Portal_Translate = new Language();

            if ($_SESSION['Type_Language'] == null && empty($_SESSION['Type_Language'])){
                $_SESSION['Type_Language'] = 'fa_ir';
            }
        ?>
        <?php //echo CRM_URL . '/test/logo/' . $Parameters['CompanyDetail']['result']->logoname; die();  ?>
        <!-- BACKGROUND-IMAGE -->
        <div class="">
            <!-- PAGE -->
            <div class="page">
                <div class="">
                    <?php
                    if (isset($_GET['Message'])){
                        ShowMeassage($_GET['Message']);
                    }
                    ?>
                    <?php /*if (!empty($Message)){ */?><!--
                        <?php /*if (isset($Message['Error']) && $Message['Error'] != null){ */?>
                            <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="error" role="alert">
                                <p style="line-height: 60px;"><?php /*echo $Portal_Translate->Translate($Message['Error']) */?></p>
                            </div>
                        <?php /*}else{ */?>
                            <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="success" role="alert">
                                <p style="line-height: 60px;"><?php /*echo $Portal_Translate->Translate($Message['Success']) */?></p>
                            </div>
                        <?php /*} */?>
                    --><?php /*} */?>
                    <!-- CONTAINER OPEN -->
                    <?php if ($Parameters['CompanyDetail']['success'] === true){ ?>
                        <div class="col col-login mx-auto mt-7">
                            <div class="text-center">
                                <img src="<?php echo CRM_URL . '/test/logo/' . $Parameters['CompanyDetail']['result']->logoname ?>" class="header-brand-img" alt="">
                            </div>
                        </div>
                    <?php } ?>

                    <div class="container-login100">
                        <div class="wrap-login100 p-6">
                            <form class="login100-form validate-form" method="post" action="">
                                    <span class="login100-form-title pb-5">
                                        <?php echo $Portal_Translate->Translate("LOGIN_LOGIN") ?>
                                    </span>
                                <div class="panel panel-primary">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <h5><?php echo $Portal_Translate->Translate("LOGIN_CONTENT_HEADER") ?></h5>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body p-0 pt-5">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab5">
                                                <div class="wrap-input100 validate-input input-group">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-email text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input name="UserName" class="input100 border-start-0 form-control ms-0" type="text" placeholder="<?php echo $Portal_Translate->Translate("LOGIN_USERNAME") ?>">
                                                </div>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input name="Password" class="input100 border-start-0 form-control ms-0" type="password" placeholder="<?php echo $Portal_Translate->Translate("LOGIN_PASSWORD") ?>">
                                                </div>
                                                <div class="wrap-input100 validate-input input-group" id="">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i style="color: #74829c" class="fa fa-calendar" aria-hidden="true"></i>
                                                    </a>
                                                    <select style="color: #74829c" name="Type_Date_Portal" class="input100 border-start-0 form-control ms-0" type="select" placeholder="date">
                                                        <?php foreach (DATE_TYPE_LIST as $date){ ?>
                                                            <?php if ($date['value'] == $_SESSION['Type_Date']){ ?>
                                                                <option value="<?php echo $date['value'] ?>" selected><?php echo $Portal_Translate->Translate( $date['label']) ?></option>
                                                            <?php }else{ ?>
                                                                <option value="<?php echo $date['value'] ?>"><?php echo $Portal_Translate->Translate( $date['label']) ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="wrap-input100 validate-input input-group" id="">
                                                    <a class="input-group-text bg-white text-muted">
                                                        <i style="color: #74829c" class="fa fa-language" aria-hidden="true"></i>
                                                    </a>
                                                    <?php //echo "<pre>";print_r(LANGUAGE_LIST); ?>
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
                                                <div class="text-end pt-4">
                                                    <p class="mb-0"><a href="index.php?page=ForgetPassword  " class="text-primary ms-1"><?php echo $Portal_Translate->Translate("LOGIN_FORGET_PASSWORD") ?></a></p>
                                                </div>
                                                <div class="container-login100-form-btn">
                                                    <input class="login100-form-btn btn-primary" type="submit" value="<?php echo $Portal_Translate->Translate("BTN_LOGIN") ?>" name="SubmiLogin">
                                                </div>

                                                <?php
                                                if ($Parameters['CompanyDetail']['success'] === true) {
                                                    if ($Parameters['CompanyDetail']['result']->registration === true){
                                                        echo '<div class="text-center pt-3">
                                                                 <p class="text-dark mb-0">'. $Portal_Translate->Translate("LOGIN_NOT_A_MEMBER") .'<a href="index.php?page=registration" class="text-primary ms-1">'. $Portal_Translate->Translate("LOGIN_REGISTRATION") .'</a></p>
                                                        </div>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- CONTAINER CLOSED -->
                </div>
            </div>
            <!-- End PAGE -->

        </div>
        <script src="resources/js/jquery.min.js"></script>
        <script src="resources/plugins/bootstrap/js/popper.min.js"></script>
        <script src="resources/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="resources/js/show-password.min.js"></script>
        <script src="resources/js/generate-otp.js"></script>
        <script src="resources/plugins/p-scroll/perfect-scrollbar.js"></script>
        <script src="resources/js/themeColors.js"></script>
        <script src="resources/js/custom.js"></script>
        <script src="resources/js/custom1.js"></script>
        <script src="resources/switcher/js/switcher.js"></script>
    </body>
</html>