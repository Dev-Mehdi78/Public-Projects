<div class="main-content app-content mt-0">
    <div class="side-app">
        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <?php
            if (isset($_GET['Message'])){
                $ArrayMSG = explode( ' ' , $_GET['Message']);
                $TypeMSG = $ArrayMSG[0];
                unset($ArrayMSG[0]);
                $Message = implode(' ' , $ArrayMSG);
                if ($TypeMSG == 'S'){
                    echo '<div class="col-md-4 col-xl-12 center-block" style="margin-top:10px ">';
                    echo '<div class="alert alert-avatar bg-success alert-dismissible text-center center-block text-white">';
                    echo '<button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-hidden="true">×</button>';
                    echo $Portal_Translate->Translate($Message);
                    echo '</div>';
                    echo '</div>';
                }else{
                    echo '<div class="col-md-4 col-xl-12 center-block" style="margin-top:10px ">';
                    echo '<div class="alert alert-avatar bg-danger-gradient alert-dismissible text-center center-block text-white">';
                    echo '<button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-hidden="true">×</button>';
                    echo $Portal_Translate->Translate($Message);
                    echo '</div>';
                    echo '</div>';
                }
            }
            ?>
            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title"><a href="index.php?page=Dashboard"> <?php echo $Portal_Translate->Translate('DBD_DASHBOARD'); ?></a></h1>
                <?php if ($Parameters['SettingsPortal']['success'] === true) { ?>
                    <div class="alert alert-avatar alert-primary alert-dismissible"
                         style="width: 85%; text-align: center; background-color: #6c5ffc; color: #f7f7f7">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $Parameters['SettingsPortal']['result']->announcement ?>
                    </div>
                <?php } ?>
            </div>

            <!-- Animates the numbers, add classes "odometer odometer-theme-default" and id "odometer"
  <link rel="stylesheet" href="http://github.hubspot.com/odometer/themes/odometer-theme-default.css" />
  <script src="http://github.hubspot.com/odometer/odometer.js"></script>
  <link rel="stylesheet" href="odometer-theme-default.css" />
  -->
            <!--<div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">مدل های نمودار دایره ای</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-9">
                                <div id="placeholder" class="chartsh">

                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div id="menu">
                                    <button id="example-1" class="btn d-grid btn-sm btn-primary mt-2 mt-lg-0 ">گزینه های پیش فرض</button>
                                    <button id="example-2" class="btn d-grid btn-sm btn-primary mt-2">بدون افسانه</button>
                                    <button id="example-3" class="btn d-grid btn-sm btn-primary mt-2">قالب‌کننده برچسب</button>
                                    <button id="example-4" class="btn d-grid btn-sm btn-primary mt-2">شعاع برچسب</button>
                                    <button id="example-5" class="btn d-grid btn-sm btn-primary mt-2">سبک های برچسب شماره 1</button>
                                    <button id="example-6" class="btn d-grid btn-sm btn-primary mt-2">سبک های برچسب شماره 2</button>
                                    <button id="example-8" class="btn d-grid btn-sm btn-primary mt-2">برش ترکیبی</button>
                                    <button id="example-9" class="btn d-grid btn-sm btn-primary mt-2">پای مستطیلی</button>
                                    <button id="example-10" class="btn d-grid btn-sm btn-primary mt-2">پای کج</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

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

            <div class="row">
                <?php
                //echo '<pre>';
                $AccessCharts = $Parameters['FetchCharts']['result']->charts;
                $i = 0;
                foreach ($AccessCharts as $Chart) {
                    $Value = $Parameters['FetchCharts']['result'];
                    $Value = (array)$Value;
                    $Value = $Value[$Chart];
                    $ResPriority = array();
                    $ResCount = array();
                    if ($Chart == 'TicketsClosureTimeByPriority') {
                        foreach ($Value as $Row) {
                            $Row = (array)$Row;
                            $RowPriority = '"' . $Row['priority'] . '"';
                            $RowCount = '"' . $Row['closureTime'] . '"';
                            array_push($ResPriority, $RowPriority);
                            array_push($ResCount, $RowCount);
                        }
                        $ResPriority = implode(',', $ResPriority);
                        $ResCount = implode(',', $ResCount);
                    } else {
                        foreach ($Value as $Row) {
                            $Row = (array)$Row;
                            $RowPriority = '"' . $Row['priority'] . '"';
                            $RowCount = '"' . $Row['count'] . '"';
                            array_push($ResPriority, $RowPriority);
                            array_push($ResCount, $RowCount);
                        }
                        $ResPriority = implode(',', $ResPriority);
                        $ResCount = implode(',', $ResCount);
                    }


                    ?>
                    <div class="col-lg-6">
                        <div class="expanel expanel-default">
                            <?php if ($Chart == 'OpenTicketsByPriority') { ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $Portal_Translate->Translate('DBD_OPEN_TICKETS_BASED_ON_PRIORITY'); ?></h3>
                                </div>
                            <?php } else if ($Chart == 'TicketsClosureTimeByPriority') { ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $Portal_Translate->Translate('DBD_CLOSED_TICKETS_BASED_ON_PRIORITY'); ?></h3>
                                </div>
                            <?php } else if ($Chart == 'OpenInvoiceByPriority') { ?>
                                <div class="card-header">
                                    <h3 class="card-title"><?php echo $Portal_Translate->Translate('DBD_INVOICES_BASED_ON_STATUS'); ?></h3>
                                </div>
                            <?php } ?>

                            <!--<div class="expanel-heading">فاکتورها بر اساس وضعیت</div>-->
                            <?php if ($Value != null) { ?>
                                <?php if ($Chart == 'OpenInvoiceByPriority' || $Chart == 'OpenTicketsByPriority'){ ?>
                                    <div class="expanel-body">
                                        <canvas id="myChart<?= $i ?>" style="width:100%;max-width:600px ; padding-bottom: 25px;">

                                        </canvas>
                                        <script>
                                            var xValues = [<?= $ResPriority ?>];
                                            //var xValues = [/*"باز", "بسته", "در انتظار پاسخ", "تست 1", "پاسخ داده شد" ,*/ "بالا", "پایین", "متوسط"];
                                            var yValues = [<?= $ResCount?>/*, 5, 10,15 , 10, 15*/];
                                            var barColors = [
                                                "#3223f1",
                                                "#1caf9f",
                                                "#45aaf2",
                                                "#fc7303",
                                                "#007ea7",
                                                "#FBB034",
                                                "#5a6970",
                                                "#8927ec",
                                                "#7bd235",
                                                "#343a40",
                                                "#fc5296",
                                                "#e73827",
                                                "#6574cd",
                                            ];
                                            new Chart("myChart<?= $i ?>", {
                                                type: "doughnut",
                                                data: {
                                                    labels: xValues,
                                                    datasets: [{
                                                        backgroundColor: barColors,
                                                        data: yValues
                                                    }]
                                                },
                                                options: {
                                                    title: {
                                                        display: true,
                                                        text: ""
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                <?php } ?>
                                <?php if ($Chart == 'TicketsClosureTimeByPriority'){ ?>
                                    <div class="expanel-body">
                                        <div class="chart" style="padding-top: 0px;padding-bottom: 10px;">
                                            <canvas  id="myChart" width="400" height="200"></canvas>
                                        </div>
                                    </div>

                                    <script>
                                        var ctx = document.getElementById('myChart').getContext('2d');
                                        var chart = new Chart(ctx, {
                                            // The type of chart we want to create
                                            type: 'line', // also try bar or other graph types

                                            // The data for our dataset
                                            data: {
                                                labels: [<?= $ResPriority ?>],
                                                // Information about the dataset
                                                datasets: [{
                                                    label: "",
                                                    backgroundColor: 'lightblue',
                                                    borderColor: 'royalblue',
                                                    data: [<?= $ResCount ?>],
                                                }]
                                            },

                                            // Configuration options
                                            options: {
                                                layout: {
                                                    padding: 10,
                                                },
                                                legend: {
                                                    position: 'bottom',
                                                },
                                                title: {
                                                    display: true,
                                                    text: ''
                                                },
                                                scales: {
                                                    yAxes: [{
                                                        scaleLabel: {
                                                            display: true,
                                                            labelString: '<?= $Portal_Translate->Translate('Time'); ?>'
                                                        }
                                                    }],
                                                    xAxes: [{
                                                        scaleLabel: {
                                                            display: true,
                                                            labelString: '<?= $Portal_Translate->Translate('Priority'); ?>'
                                                        }
                                                    }]
                                                }
                                            }
                                        });
                                    </script>
                                <?php } ?>
                            <?php } else { ?>
                                <div class="card-body">
                                    <div class="p-4 bg-light border">
                                        <div aria-live="polite" aria-atomic="true"
                                             class="d-flex justify-content-center align-items-center w-100 h-180">
                                            <div class="toast show" role="alert" aria-live="assertive"
                                                 aria-atomic="true" data-bs-autohide="false">
                                                <div class="toast-header">
                                                    <?php if ($Chart == 'OpenTicketsByPriority') { ?>
                                                        <strong class="me-auto"><?= $Portal_Translate->Translate('Tickets'); ?></strong>
                                                    <?php } else if ($Chart == 'TicketsClosureTimeByPriority') { ?>
                                                        <strong class="me-auto"><?= $Portal_Translate->Translate('Tickets'); ?></strong>
                                                    <?php } else if ($Chart == 'OpenInvoiceByPriority') { ?>
                                                        <strong class="me-auto"><?= $Portal_Translate->Translate('Invoices'); ?></strong>
                                                    <?php } ?>

                                                    <small></small>
                                                    <button aria-label="Close" class="btn-close fs-20"
                                                            data-bs-dismiss="toast"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="toast-body">
                                                    رکوردی یافت نشد
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <?php $i++ ?>
                <?php } ?>

                <div class="col-md-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php  echo $Portal_Translate->Translate('DBD_WHAT_DO_YOU_WANT_TO_DO ?'); ?></h3>
                        </div>
                        <div class="example">
                            <?php
                            $ShortCuts = (array)$_SESSION['shortcuts'];
                            foreach ($ShortCuts as $Cut){
                                $Cut = (array)$Cut;
                                if (isset($Cut['HelpDesk'])){ ?>
                                    <a href="index.php?page=Main&module=HelpDesk&view=Create" type="button" class="btn btn-secondary mt-1 mb-1 me-3">
                                        <span><?php echo $Portal_Translate->Translate($Cut['HelpDesk'][0]); ?></span>
                                        <span class="badge bg-white text-secondary ms-2"></span>
                                    </a>
                                    <a href="index.php?page=Main&module=HelpDesk&view=List&filter=Open" type="button" class="btn btn-success mt-1 mb-1 me-3">
                                        <span><?php echo $Portal_Translate->Translate($Cut['HelpDesk'][1]); ?></span>
                                        <span class="badge bg-white text-secondary ms-2"></span>
                                    </a>
                                <?php    }  ?>
                                <?php if (isset($Cut['Invoice'])){ ?>
                                    <a href="index.php?page=Main&module=Invoice&view=List" type="button" class="btn btn-info mt-1 mb-1 me-3">
                                        <span><?php echo $Portal_Translate->Translate($Cut['Invoice'][0]); ?></span>
                                        <span class="badge bg-white text-secondary ms-2"></span>
                                    </a>
                                <?php    }  ?>

                            <?php  } ?>
                        </div>

                        <div class="card-body">
                            <br>
                            <br>
                            <br>
                            <div class="text-wrap">
                                <p><?php echo $Portal_Translate->Translate("DBD_YOUR_FOLLOW-UP_EXPERT:"); ?></p>
                                <div class="example">
                                    <div class="btn-list btn-list-icon">
                                        <h5 class="text-primary"><?php echo $_SESSION['accountRepresentatives']['assigned_user_id']->fieldDetails->fieldValue ?><span class="badge bg-primary"></span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="row">
                <?php
                //echo '<pre>' ;
                $RecentRecord = $_SESSION['recentRecords'];
                if (isset($RecentRecord['HelpDesk'])){ ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="expanel expanel-primary">
                            <div class="expanel-heading">
                                <h3 class="expanel-title"><?php echo $Portal_Translate->Translate('DBD_RECENT_TICKETS'); ?></h3>
                            </div>
                            <div class="expanel-body">

                                <?php $ResRecordHelpDesk = $RecentRecord['HelpDesk']; ?>
                                <?php if ($ResRecordHelpDesk != null){ ?>
                                    <?php foreach ($ResRecordHelpDesk as $Record){ //print_r($Record)?>
                                        <a href="index.php?page=Main&module=Tickets&view=Detail&record=<?php echo $Record->id  ?>" class="list-group-item list-group-item-action flex-column align-items-start فعال">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"><?php echo $Record->label ?></h5>
                                                <small class="text-muted"><?php echo $Record->status ?></small>
                                            </div>
                                            <p class="mb-1"><?php echo $Record->description ?></p>
                                            <!--<small class="text-muted">لورم ایپسوم متن ساختگی</small>-->
                                        </a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (isset($RecentRecord['Invoice'])){ ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="expanel expanel-secondary">
                            <div class="expanel-heading">
                                <h3 class="expanel-title"><?php  echo $Portal_Translate->Translate('DBD_RECENT_INVOICE'); ?></h3>
                            </div>
                            <div class="expanel-body">


                                <?php $ResRecordInvoice = $RecentRecord['Invoice']; ?>
                                <?php if ($ResRecordInvoice != null){ ?>
                                    <?php foreach ($ResRecordInvoice as $Record){ //print_r($Record)?>
                                        <a href="index.php?page=Main&module=Invoice&view=Detail&record=<?php echo $Record->id  ?>" class="list-group-item list-group-item-action flex-column align-items-start فعال">
                                            <div class="d-flex w-100 justify-content-between">
                                                <!--<h5 class="mb-1"></h5>-->
                                                <!--<small class="text-muted"><?php /*echo $Record->status */?></small>-->
                                            </div>
                                            <p class="mb-1"><?php echo $Record->label ?></p>
                                            <!--<small class="text-muted">لورم ایپسوم متن ساختگی</small>-->
                                        </a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (isset($RecentRecord['Faq'])){ ?>
                    <div class="col-sm-12 col-lg-6">
                        <div class="expanel expanel-primary">
                            <div class="expanel-heading">
                                <h3 class="expanel-title"><?php echo $Portal_Translate->Translate('DBD_RECORD_QUESTION'); ?></h3>
                            </div>
                            <div class="expanel-body">
                                <?php $ResRecordFaq = $RecentRecord['Faq']; ?>
                                <?php if ($ResRecordFaq != null){ ?>
                                    <?php foreach ($ResRecordFaq as $Record){ //print_r($Record)?>
                                        <a href="index.php?page=Main&module=Faq&view=Detail&record=<?php echo $Record->id  ?>" class="list-group-item list-group-item-action flex-column align-items-start فعال">
                                            <div class="d-flex w-100 justify-content-between">
                                                <!--<h5 class="mb-1"></h5>-->
                                                <!--<small class="text-muted"><?php /*echo $Record->status */?></small>-->
                                            </div>
                                            <p class="mb-1"><?php echo $Record->label ?></p>
                                            <!--<small class="text-muted">لورم ایپسوم متن ساختگی</small>-->
                                        </a>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <?php echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                <?php } ?>


                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if (isset($RecentRecord['Documents'])){ ?>
                    <!--<div class="col-sm-12 col-lg-6">
                        <div class="expanel expanel-primary">
                            <div class="expanel-heading">
                                <h3 class="expanel-title">آخرین اسناد</h3>
                            </div>
                            <div class="expanel-body">


                                <?php /*$ResRecordDocuments = $RecentRecord['Documents']; */?>
                                <?php /*if ($ResRecordDocuments != null){ */?>
                                    <?php /*foreach ($ResRecordDocuments as $Record){ //print_r($Record)*/?>
                                        <a href="index.php?page=Main&module=Invoice&view=Detail&record=<?php /*echo $Record->id  */?>" class="list-group-item list-group-item-action flex-column align-items-start فعال">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1"></h5>
                                                <small class="text-muted"><?php /*/*echo $Record->status */?></small>
                                            </div>
                                            <p class="mb-1"><?php /*echo $Record->label */?></p>
                                            <small class="text-muted">لورم ایپسوم متن ساختگی</small>
                                        </a>
                                    <?php /*} */?>
                                <?php /*}else{ */?>
                                    <?php // echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
                                <?php /*} */?>


                            </div>
                        </div>
                    </div>-->
                <?php } ?>

<!--                --><?php //if (isset($RecentRecord['ServiceContracts'])){ ?>
<!--                    <div class="col-sm-12 col-lg-6">-->
<!--                        <div class="expanel expanel-secondary">-->
<!--                            <div class="expanel-heading">-->
<!--                                <h3 class="expanel-title">قرارداد های اخیر</h3>-->
<!--                            </div>-->
<!--                            <div class="expanel-body">-->
<!---->
<!---->
<!--                                --><?php //$ResRecordServiceContracts= $RecentRecord['ServiceContracts']; ?>
<!--                                --><?php //if ($ResRecordServiceContracts != null){ ?>
<!--                                    --><?php //foreach ($ResRecordServiceContracts as $Record){ //print_r($Record)?>
<!--                                        <a href="index.php?page=Main&module=ServiceContracts&view=Detail&record=--><?php //echo $Record->id  ?><!--" class="list-group-item list-group-item-action flex-column align-items-start فعال">-->
<!--                                            <div class="d-flex w-100 justify-content-between">-->
<!--                                                <h5 class="mb-1">--><?php //echo $Record->label ?><!--</h5>-->
<!--                                                <small class="text-muted">--><?php ///*echo $Record->status */?><!--</small>-->
<!--                                            </div>-->
<!--                                            <p class="mb-1">تاریخ شروع: --><?php //echo $Record->start_date ?><!--</p>-->
<!--                                            <small class="text-muted">لورم ایپسوم متن ساختگی</small>-->
<!--                                        </a>-->
<!--                                    --><?php //} ?>
<!--                                --><?php //}else{ ?>
<!--                                    --><?php //echo $Portal_Translate->Translate('DBD_NO_RECORD_FOUND'); ?>
<!--                                --><?php //} ?>
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //} ?>
            </div>

        </div>
    </div>
</div>

<!--app-content close-->

