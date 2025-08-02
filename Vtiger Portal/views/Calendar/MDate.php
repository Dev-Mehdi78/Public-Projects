
<div class="main-content app-content mt-0">
    <?php  ?>
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title"><?= $Portal_Translate->Translate('MN_CALENDAR_Milad') ?></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $Portal_Translate->Translate('MN_Tools_MENNO') ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $Portal_Translate->Translate('MN_CALENDAR_Milad') ?></li>
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

            <link rel="stylesheet" href="library/GregorianDate/style.css">
            <script src="library/GregorianDate/script.js" defer></script>
            <div class="container-login100">
                <div class="contianer">
                    <div class="calendar">
                        <div class="calendar-header">
                            <span class="month-picker" id="month-picker"> May </span>
                            <div class="year-picker" id="year-picker">
                                <span class="year-change" id="pre-year">
                                    <pre style="background-color: #8089fe;color: white"><</pre>
                                </span>
                                <span id="year">2020 </span>
                                <span class="year-change" id="next-year">
                                    <pre style="background-color: #8089fe;color: white">></pre>
                                </span>
                            </div>
                        </div>

                        <div class="calendar-body">
                            <div class="calendar-week-days">
                                <div>Sun</div>
                                <div>Mon</div>
                                <div>Tue</div>
                                <div>Wed</div>
                                <div>Thu</div>
                                <div>Fri</div>
                                <div>Sat</div>
                            </div>
                            <div class="calendar-days">
                            </div>
                        </div>
                        <div class="calendar-footer">
                        </div>
                        <div class="date-time-formate">
                            <div class="row">
                                <div  class="col-sm-6 col-md-6">
                                    <div class="date-time-value">
                                        <div class="time-formate">01:41:20</div>
                                    </div>
                                </div>
                                <div style="text-align: left" class="col-sm-6 col-md-6">
                                    <div class="day-text-formate">TODAY</div>
                                    <div class="date-formate">03 - march - 2022</div>
                                </div>
                            </div>


                        </div>
                        <div class="month-list"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php
