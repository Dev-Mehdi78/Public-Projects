<html lang="fa-IR" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Forget Password</title>
    <link id="style" href="resources/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="resources/css/style.css" rel="stylesheet" />
    <link href="resources/css/dark-style.css" rel="stylesheet" />
    <link href="resources/css/transparent-style.css" rel="stylesheet">
    <link href="resources/css/skin-modes.css" rel="stylesheet" />
    <link href="resources/css/icons.css" rel="stylesheet" />
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="resources/colors/color1.css" />
    <link href="resources/switcher/css/switcher.css" rel="stylesheet" />
    <link href="resources/switcher/demo.css" rel="stylesheet" />
    <link rel="stylesheet" id="fonts" href="resources/fonts/styles-fa-num/iran-yekan.css">
    <link href="resources/css/rtl.css" rel="stylesheet" />
</head>

<body class="app sidebar-mini ltr login-img">
<?php
$Portal_Translate = new Language();
if ($_SESSION == null && empty($_SESSION)){
    $_SESSION['Type_Language'] = 'fa_ir';
}
?>

<div class="">
    <div id="global-loader">
        <img src="resources/images/loader.svg" class="loader-img" alt="Loader">
    </div>

    <div class="page">
        <div class="">
            <?php if ($Parameters['CompanyDetail']['success'] === true){ ?>
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="<?php echo CRM_URL . '/test/logo/' . $Parameters['CompanyDetail']['result']->logoname ?>" class="header-brand-img" alt="">
                    </div>
                </div>
            <?php } ?>
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <form class="login100-form validate-form" method="post">
                            <span class="login100-form-title pb-5">
                               <?= $Portal_Translate->Translate("Title ForgetPassword") ?>
                            </span><hr>
                        <p class="text-muted"><?= $Portal_Translate->Translate("Content ForgetPassword") ?></p><hr>
                        <div class="wrap-input100 validate-input input-group">
                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                            </a>
                            <input class="input100 border-start-0 ms-0 form-control" type="email" placeholder="<?= $Portal_Translate->Translate("LOGIN_USERNAME") ?>">
                        </div><hr>
                        <div class="submit">
                            <input type="submit" name="SendForgetPassword" class="btn btn-primary cente" value="<?= $Portal_Translate->Translate("BTN_SUBMIT") ?>">
                        </div><hr>
                        <div class="text-center mt-4">
                            <p class="text-dark mb-0"><a class="text-primary ms-1" href="index.php?page=Login"><?= $Portal_Translate->Translate("Go TO LoinPage") ?></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="resources/js/jquery.min.js"></script>
<script src="resources/plugins/bootstrap/js/popper.min.js"></script>
<script src="resources/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="resources/js/show-password.min.js"></script>
<script src="resources/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="resources/js/themeColors.js"></script>
<script src="resources/js/custom.js"></script>
<script src="resources/js/custom1.js"></script>
<script src="resources/switcher/js/switcher.js"></script>

</body>


</html>