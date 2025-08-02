<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title"><?= $Portal_Translate->Translate('MN_ABOUT_ACCOUNT') ?></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a
                                    href="javascript:void(0)"><?= $Portal_Translate->Translate('MN_Other_MENNO') ?></a>
                        </li>
                        <li class="breadcrumb-item active"
                            aria-current="page"><?= $Portal_Translate->Translate('MN_ABOUT_ACCOUNT') ?></li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row py-5">
                            <div class="text-center">
                                <h4 class="display-5 fw-semibold"><?= $_SESSION['MainCompany']['organizationname'] ?></h4>
                                <p class=""><?= $Portal_Translate->Translate('ACCOUNT_INFO_CONTENT') ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="elementor-widget-wrap elementor-element-populated">
                    <div class="elementor-element elementor-element-f224515 elementor-position-right elementor-vertical-align-middle elementor-widget elementor-widget-image-box"
                         data-id="f224515" data-element_type="widget" data-widget_type="image-box.default">
                        <div class="elementor-image-box-wrapper">
                            <img decoding="async" width="100" height="100" src="https://vtfarsi.ir/wp-content/uploads/2023/02/tel-1.png" class="attachment-full size-full wp-image-14704 entered lazyloaded"/>
                            <b><?= $Portal_Translate->Translate('ACCOUNT_PHONE_M') ?>: </b>
                            <span><?= $_SESSION['MainCompany']['phone'] ?></span>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-2093610 elementor-position-right elementor-vertical-align-middle elementor-widget elementor-widget-image-box"
                         data-id="2093610" data-element_type="widget" data-widget_type="image-box.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-image-box-wrapper">

                                <img decoding="async" width="100" height="100" src="https://vtfarsi.ir/wp-content/uploads/2023/02/mail.png" class="attachment-full size-full wp-image-14703 entered lazyloaded">
                                <b><?= $Portal_Translate->Translate('ACCOUNT_WEB_M') ?>: </b>
                                <span><?= $_SESSION['MainCompany']['website'] ?></span>

                            </div>
                        </div>
                    </div>
                    <div class="elementor-element elementor-element-1a86756 elementor-position-right elementor-vertical-align-middle elementor-widget elementor-widget-image-box"
                         data-id="1a86756" data-element_type="widget" data-widget_type="image-box.default">
                        <div class="elementor-widget-container">
                            <div class="elementor-image-box-wrapper">

                                <img decoding="async" width="100" height="100" src="https://vtfarsi.ir/wp-content/uploads/2023/02/location-1.png" class="attachment-full size-full wp-image-14706 entered lazyloaded">
                                <b><?= $Portal_Translate->Translate('ACCOUNT_ADDRESS_M') ?>: </b>
                                <span><?= $_SESSION['MainCompany']['address'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">
            <div class="col-lg-12">
                <img src="resources/images/media/team.jpg" alt="" class="br-5">
            </div>
        </div>-->

    </div>
</div>