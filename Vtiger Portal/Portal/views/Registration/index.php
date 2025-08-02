<?php //echo "<pre>";die(print_r($Parameters)); ?>
<!doctype html>
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
    <link rel="shortcut icon" type="image/x-icon" href="" />

    <!-- TITLE -->
    <title>Registration</title>

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

    <link href="library/jalalidatepicker/jalalidatepicker.min.css" rel="stylesheet" />
    <script src="library/jalalidatepicker/jalalidatepicker.min.js"></script>

</head>

<body class="app sidebar-mini ltr login-img">
<?php $Portal_Translate = new Language(); ?>
<?php $Portal_Translate = new Language();

if ($_SESSION['Type_Language'] == null && empty($_SESSION['Type_Language'])){
    $_SESSION['Type_Language'] = 'fa_ir';
}
?>
<div class="">
    <div class="page">



        <?php  if (isset($Parameters['DetailSuccess']['id']) && $Parameters['DetailSuccess']['id'] != ''){  ?>
            <?php if (!empty($Message)){ ?>
                <?php if (isset($Message['Error']) && $Message['Error'] != null){ ?>
                    <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="error" role="alert">
                        <p style="line-height: 60px;"><?php echo $Portal_Translate->Translate($Message['Error']) ?></p>
                    </div>
                <?php }else{ ?>
                    <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="success" role="alert">
                        <p style="line-height: 60px;"><?php echo $Portal_Translate->Translate($Message['Success']) ?></p>
                    </div>
                <?php } ?>
            <?php } ?>
            <?php if ($Parameters['CompanyDetail']['success'] === true){ ?>
                <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <img src="<?php echo CRM_URL . '/test/logo/' . $Parameters['CompanyDetail']['result']->logoname ?>" class="header-brand-img" alt="">
                    </div>
                </div><hr>
            <?php } ?>
            <?php
                $IDRegister    = $Parameters['DetailSuccess']['id'];
                $UNameRegister = $Parameters['DetailSuccess']['username'];
                $PassRegister   = $Parameters['DetailSuccess']['password'];
            ?>
            <div style=" margin: auto; width: 50%; padding: 10px;" class="card">
                <div class="card-body">
                    <div class="col-xl-12 col-md-12">
                        <div class="">
                            <div class="">
                                <p class="">
                                    <?php echo $Portal_Translate->Translate("SuccessLogin_Customer") ?>
                                </p>
                                <p class="">
                                    <?php echo $Portal_Translate->Translate("LOGIN_USERNAME") . ' : ' . $UNameRegister ?>
                                </p>
                                <p class="">
                                    <?php echo $Portal_Translate->Translate("LOGIN_PASSWORD") . ' : ' . $PassRegister ?>
                                </p>
                                <hr>

                                <a href="index.php?page=login" class="btn btn-primary"><?php echo $Portal_Translate->Translate("REGISTER_LOGIN") ?></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php }else{ ?>
            <div class="">
                <?php if (!empty($Message)){ ?>
                    <?php if (isset($Message['Error']) && $Message['Error'] != null){ ?>
                        <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="error" role="alert">
                            <p style="line-height: 60px;"><?php echo $Portal_Translate->Translate($Message['Error']) ?></p>
                        </div>
                    <?php }else{ ?>
                        <div id="ui_notifIt" style="height: 60px; width: 500px; opacity: 1; top: 10px; left: 518px;" class="success" role="alert">
                            <p style="line-height: 60px;"><?php echo $Portal_Translate->Translate($Message['Success']) ?></p>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if ($Parameters['CompanyDetail']['success'] === true){ ?>
                    <div class="col col-login mx-auto mt-7">
                        <div class="text-center">
                            <img src="<?php echo CRM_URL . '/test/logo/' . $Parameters['CompanyDetail']['result']->logoname ?>" class="header-brand-img" alt="">
                        </div>
                    </div><hr>
                <?php } ?>

                <div style="border: 5px solid; margin: auto; width: 50%; padding: 10px;" class="card">
                    <div class="card-body">

                        <form class="" method="post" action="" enctype="multipart/form-data">
                            <div class="row">
                                <span class="login100-form-title">
                                        <?php echo $Portal_Translate->Translate("REGISTER_REGISTER_PAGE") ?>
                                </span>

                                <?php
                                //echo "<pre>";die(print_r($Parameters['CompanyDetail']));
                                $TypeDate     = $_SESSION['Type_Date'];
                                if ($Parameters['CompanyDetail']['success'] === true ){
                                    if ($Parameters['CompanyDetail']['result']->registration === true) {
                                        $RegistrationField = (array)$Parameters['CompanyDetail']['result']->RegisterFile;
                                        foreach ($RegistrationField as $Field) {
                                            $ArrayField     = (array)$Field;
                                            $FieldName      = $ArrayField['name'];
                                            $FieldType      = $ArrayField['type'];
                                            $FieldUIType    = $ArrayField['uitype'];
                                            $FieldLabel     = $ArrayField['label'];
                                            $FieldMandatory = $ArrayField['mandatory'];

                                            $FiledNameByName = explode('_' , $FieldName);
                                            //echo '<pre>';print_r($FiledNameByName);

                                            if ($FieldMandatory === true){
                                                $PlaceholderField = $FieldLabel . ' ' . '(Mandatory)'  ;
                                                $StatusMandatory  = 'required';
                                                $Color            = 'red';
                                                $Emoji            = '*';

                                               if (isset($FiledNameByName[2])){

                                                   //تاریخ میلادی
                                                   if ($FiledNameByName[2] === 'gdt'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input type="date" name="'.$FieldName.'--MILDate" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>';
                                                       echo '</div>';

                                                   }

                                                   //آپلود فایل
                                                   else if ($FiledNameByName[2] === 'ulf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--UploadFile" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //آپلود چند فایل و عکس
                                                   else if ($FiledNameByName[2] === 'muf'){
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--Uploadfields[]" placeholder="'.$FieldLabel.'" '.$StatusMandatory.' multiple>';
                                                       echo '</div>' ;
                                                   }

                                                   //موقیعت جغرافیایی
                                                   else if ($FiledNameByName[2] === 'gps'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo 'پیاده سازی نشده';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //فیلد امتیاز دهی
                                                   else if ($FiledNameByName[2] === 'srf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo 'پیاده سازی نشده';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //فیلد رضایت مشتری
                                                   else if ($FiledNameByName[2] === 'erf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo 'پیاده سازی نشده';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //فیلد انتخاب رنگ
                                                   else if ($FiledNameByName[2] === 'cpf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input class="form-control" id="formFile" type="color" name="'.$FieldName.'--color" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //فیلد آدرس ای پی
                                                   else if ($FiledNameByName[2] === 'ipl'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input class="form-control" type="text" minlength="7" maxlength="15" name="'.$FieldName.'--ip" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" placeholder="xxx.xxx.xxx.xx" '.$StatusMandatory.'>';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //فیلد آب و هوا
                                                   else if ($FiledNameByName[2] === 'pwf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo 'پیاده سازی نشده';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }

                                                   //رکورد ویدئو
                                                   else if ($FiledNameByName[2] === 'rvf'){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo 'پیاده سازی نشده';
                                                       echo '</div>' ;
                                                       echo '</div>' ;
                                                   }


                                               }else{
                                                    if ($FieldUIType == '55' || $FieldUIType == 255 || $FieldUIType == 1){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input type="text" name="'.$FieldName.'--string" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>';
                                                       echo '</div>';

                                                   }

                                                   //تلفن
                                                   elseif ($FieldUIType == 11){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input type="phone" name="'.$FieldName.'--phone" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>';
                                                       echo '</div>';
                                                   }

                                                   //ایمیل
                                                   elseif ($FieldUIType == 13){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       echo '<input type="email" name="'.$FieldName.'--email" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       echo '</div>';
                                                       echo '</div>';
                                                   }

                                                   //تاریخ
                                                   elseif ($FieldUIType == 5){
                                                       echo '<div class="col-sm-6 col-md-6">';
                                                       echo '<div class="form-group">';
                                                       echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                       if ($TypeDate == 'jalali'){
                                                           echo '<input type="text" name="'.$FieldName.'--date" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.' data-jdp>';
                                                       }else{
                                                           echo '<input type="date" name="'.$FieldName.'--date" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                       }
                                                       echo '</div>';
                                                       echo '</div>';
                                                   }



                                                    //boolean
                                                    elseif ($FieldUIType == 56){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        //echo '<input type="checkbox" name="'.$FieldName.'--boolean" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo'<label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="'.$FieldName.'--boolean" value="on">
                                                        <span class="custom-control-label">'.$FieldLabel.'</span>
                                                    </label>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //text
                                                    elseif ($FieldUIType == 21 || $FieldUIType == 19){
                                                        echo '<div class="col-sm-6 col-md-12">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<textarea name="'.$FieldName.'--text" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'></textarea>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //عدد اعشار
                                                    elseif ($FieldUIType == 7){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="number" name="'.$FieldName.'--float" class="form-control" min="0" step="0.01" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                               }

                                                //salutation And string



                                            }else{
                                                $StatusMandatory = '';
                                                $Color           = '';
                                                $Emoji           = '';

                                                if (isset($FiledNameByName[2])){

                                                    //تاریخ میلادی
                                                    if ($FiledNameByName[2] === 'gdt'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="date" name="'.$FieldName.'--MILDate" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';

                                                    }

                                                    //آپلود فایل
                                                    else if ($FiledNameByName[2] === 'ulf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--UploadFile" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //آپلود چند فایل و عکس
                                                    else if ($FiledNameByName[2] === 'muf'){
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input class="form-control" id="formFile" type="file" name="'.$FieldName.'--Uploadfields[]" placeholder="'.$FieldLabel.'" '.$StatusMandatory.' multiple>';
                                                        echo '</div>' ;
                                                    }

                                                    //موقیعت جغرافیایی
                                                    else if ($FiledNameByName[2] === 'gps'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo 'پیاده سازی نشده';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //فیلد امتیاز دهی
                                                    else if ($FiledNameByName[2] === 'srf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo 'پیاده سازی نشده';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //فیلد رضایت مشتری
                                                    else if ($FiledNameByName[2] === 'erf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo 'پیاده سازی نشده';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //فیلد انتخاب رنگ
                                                    else if ($FiledNameByName[2] === 'cpf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input class="form-control" id="formFile" type="color" name="'.$FieldName.'--color" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //فیلد آدرس ای پی
                                                    else if ($FiledNameByName[2] === 'ipl'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input class="form-control" type="text" minlength="7" maxlength="15" name="'.$FieldName.'--ip" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" placeholder="xxx.xxx.xxx.xx" '.$StatusMandatory.'>';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //فیلد آب و هوا
                                                    else if ($FiledNameByName[2] === 'pwf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo 'پیاده سازی نشده';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }

                                                    //رکورد ویدئو
                                                    else if ($FiledNameByName[2] === 'rvf'){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo 'پیاده سازی نشده';
                                                        echo '</div>' ;
                                                        echo '</div>' ;
                                                    }


                                                }else{
                                                    //salutation And string
                                                    if ($FieldUIType == '55' || $FieldUIType == 255 || $FieldUIType == 1){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="text" name="'.$FieldName.'--string" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';

                                                    }

                                                    //Phone
                                                    elseif ($FieldUIType == 11){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="phone" name="'.$FieldName.'--phone" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //email
                                                    elseif ($FieldUIType == 13){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="email" name="'.$FieldName.'--email" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //date
                                                    elseif ($FieldUIType == 5){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        if ($TypeDate == 'jalali'){
                                                            echo '<input type="text" name="'.$FieldName.'--date" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.' data-jdp>';
                                                        }else{
                                                            echo '<input type="date" name="'.$FieldName.'--email" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        }
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //boolean
                                                    elseif ($FieldUIType == 56){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        //echo '<input type="checkbox" name="'.$FieldName.'--boolean" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo'<label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="'.$FieldName.'--boolean" value="on">
                                                        <span class="custom-control-label">'.$FieldLabel.'</span>
                                                    </label>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //text
                                                    elseif ($FieldUIType == 21 || $FieldUIType == 19){
                                                        echo '<div class="col-sm-6 col-md-12">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<textarea name="'.$FieldName.'--text" class="form-control" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'></textarea>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }

                                                    //عدد اعشار
                                                    elseif ($FieldUIType == 7){
                                                        echo '<div class="col-sm-6 col-md-6">';
                                                        echo '<div class="form-group">';
                                                        echo '<label class="form-label">'.$FieldLabel.'<span class="text-red">'.$Emoji.'</span></label>';
                                                        echo '<input type="number" name="'.$FieldName.'--float" class="form-control" min="0" step="0.01" placeholder="'.$FieldLabel.'" '.$StatusMandatory.'>';
                                                        echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }



                                            }
                                        }
                                    }
                                }
                                ?>
                            </div><hr>
                            <div class="container-login100-form-btn">
                                <input style="width: 20%" type="submit" name="SubmiRegistration" value="<?php echo $Portal_Translate->Translate("BTN_REGISTER_REGISTER_PAGE") ?>" class="login100-form-btn btn-primary">
                            </div>
                            <div class="text-center pt-3">
                                <p class="text-dark mb-0"><?php echo $Portal_Translate->Translate("REGISTER_ALREADY_ACCOUNT") ?><a href="index.php?page=login" class="text-primary ms-1"><?php echo $Portal_Translate->Translate("REGISTER_LOGIN") ?></a></p>
                            </div><hr>
                        </form>
                        <?php /*echo "<pre>";print_r($RegistrationField); */?>
                    </div>
                </div>
            </div>
        <?php } ?>





    </div>
</div>

<script>
    jalaliDatepicker.startWatch();
</script>
<!-- JQUERY JS -->
<script src="resources/js/jquery.min.js"></script>
<!-- BOOTSTRAP JS -->
<script src="resources/plugins/bootstrap/js/popper.min.js"></script>
<script src="resources/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- SHOW PASSWORD JS -->
<script src="resources/js/show-password.min.js"></script>
<!-- Perfect SCROLLBAR JS-->
<script src="resources/plugins/p-scroll/perfect-scrollbar.js"></script>
<!-- Color Theme js -->
<script src="resources/js/themeColors.js"></script>
<!-- CUSTOM JS -->
<script src="resources/js/custom.js"></script>
<script src="resources/js/custom1.js"></script>
<!-- Switcher js -->
<script src="resources/switcher/js/switcher.js"></script>
</body>


</html>