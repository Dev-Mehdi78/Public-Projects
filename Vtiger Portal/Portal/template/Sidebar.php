<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <?php if (isset($_SESSION['MainCompany']['logoname']) && $_SESSION['MainCompany']['logoname'] !=null){ ?>
            <div class="side-header">
                <a class="header-brand1" href="index.php?page=Dashboard">
                    <img src="<?php echo CRM_URL . '/test/logo/' . $_SESSION['MainCompany']['logoname'] ?>" class="header-brand-img light-logo1" alt="logo">
                </a>
            </div>
        <?php } ?>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3><?php echo  $Portal_Translate->Translate('MN_MAIN_MENNO'); ?></h3>
                </li>
                <!--Dashboard-->
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.php?page=Dashboard">
                        <i class="side-menu__icon fe fe-home"></i>
                        <span class ="side-menu__label"><?php echo  $Portal_Translate->Translate('MN_DASHBOARD'); ?></span>
                    </a>
                </li>
                <!-- Main Module Access-->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon mdi mdi-arrange-bring-forward"></i>
                        <span class="side-menu__label"><?php echo  $Portal_Translate->Translate('MODULES'); ?></span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <?php
                        $AccessTypeModule = $_SESSION['modules']['types'];
                        $AccessModules    = $_SESSION['modules']['information'];
                        $AccessModules    = (array)$AccessModules;
                        $i = 0;
                        foreach ($AccessTypeModule as $Module){
                        $ModuleInformation = $AccessModules[$Module];
                        ?>
                        <?php if ($ModuleInformation->name != 'Accounts' && $ModuleInformation->name != 'Contacts'){ ?>
                                <li>
                                    <a href="index.php?page=Main&module=<?php echo $ModuleInformation->name ?>&view=List" class="slide-item">
                                        <h6><?php echo $ModuleInformation->uiLabel ?></h6>
                                    </a>
                                </li>
                        <?php } ?>
                        <?php $i++; }  ?>

                    </ul>
                </li>
                <?php if (in_array('Products' , $_SESSION['modules']['types']) && in_array('Quotes' , $_SESSION['modules']['types'])){ ?>
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.php?page=Order">
                            <i class="side-menu__icon fa fa-shopping-basket"></i>
                            <span class ="side-menu__label"><?php echo  $Portal_Translate->Translate('MN_Order_Register'); ?></span>
                        </a>
                    </li>
                <?php } ?>
                <li class="sub-category">
                    <h3><?php echo  $Portal_Translate->Translate('MN_Tools_MENNO'); ?></h3>
                </li>
                <!-- Calendar -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0)">
                        <i class="side-menu__icon fa fa-calendar-check-o"></i>
                        <span class="side-menu__label"><?= $Portal_Translate->Translate('MN_CALENDAR'); ?></span>
                        <i class="angle fe fe-chevron-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <!--<li>
                            <a href="index.php?page=Tools&name=ConvertedDate" class="slide-item">
                                <h6><?/*= $Portal_Translate->Translate('MN_CONVERT_DATE'); */?></h6>
                            </a>
                        </li>-->
                        <li>
                            <a href="index.php?page=Tools&name=JCalendar" class="slide-item">
                                <h6><?= $Portal_Translate->Translate('MN_CALENDAR_jalali'); ?></h6>
                            </a>
                        </li>
                        <li>
                            <a href="index.php?page=Tools&name=MCalendar" class="slide-item">
                                <h6><?= $Portal_Translate->Translate('MN_CALENDAR_Milad'); ?></h6>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sub-category">
                    <h3><?php echo  $Portal_Translate->Translate('MN_Other_MENNO'); ?></h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.php?page=Tools&name=AboutAccount">
                        <i class="side-menu__icon fa fa-bank"></i>
                        <span class ="side-menu__label"><?php echo  $Portal_Translate->Translate('MN_ABOUT_ACCOUNT'); ?></span>
                    </a>
                </li>
            </ul>
            <!--sample meno 2 -->
           <!-- <ul class="side-menu">
                <li class="sub-category">
                    <h3><?php /*echo  $Portal_Translate->Translate('MN_MAIN_MENNO'); */?></h3>
                </li>
                <li class="slide">
                    <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.php?page=Dashboard"><i class="side-menu__icon fe fe-home"></i><span class ="side-menu__label"><?php /*echo  $Portal_Translate->Translate('MN_DASHBOARD'); */?></span></a>
                </li>
                <?php
/*                $AccessTypeModule = $_SESSION['modules']['types'];
                $AccessModules    = $_SESSION['modules']['information'];
                $AccessModules    = (array)$AccessModules;
                //echo '<pre>'; print_r($AccessModules);
                $Ion = array(
                    'fa fa-american-sign-language-interpreting',
                    'side-menu__icon fe fe-slack',
                    'side-menu__icon fe fe-package',
                    'side-menu__icon fe fe-shopping-bag',
                    'side-menu__icon fe fe-wind',
                    'side-menu__icon fe fe-zap',
                    'fa fa-cog',
                    'fa fa-cube',
                    'fa fa-eercast',
                    'fa fa-inr',
                    'fa fa-fort-awesome',
                    'fa fa-genderless',
                    'fa fa-google-plus-circle',
                    'fa fa-shekel',
                    'fa fa-skype',
                    'fa fa-spotify',
                    'fa fa-paypal',
                    'fa fa-stop-circle-o',
                    'fa fa-stumbleupon',
                    'fa fa-pied-piper-pp',
                    'fa fa-paypal',
                    'fa fa-paw',
                    'fa fa-road',
                );
                $i = 0;
                foreach ($AccessTypeModule as $Module){
                    $ModuleInformation = $AccessModules[$Module];
                */?>
                    <?php /*if ($ModuleInformation->name != 'Accounts'){ */?>
                    <li class="slide">
                        <a class="side-menu__item has-link" data-bs-toggle="slide" href="index.php?page=Main&module=<?php /*echo $ModuleInformation->name */?>&view=List">
                            <i class="side-menu__icon <?php /*echo $Ion[$i] */?>"></i>
                            <span class ="side-menu__label"><?php /*echo $ModuleInformation->uiLabel */?></span>
                        </a>
                    </li>
                    <?php /*} */?>
                <?php /*$i++; }  */?>
            </ul>-->
        </div>
    </div>
    <!--/APP-SIDEBAR-->
</div>
