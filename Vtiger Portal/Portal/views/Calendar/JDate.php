<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title"><?= $Portal_Translate->Translate('MN_CALENDAR_jalali') ?></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)"><?= $Portal_Translate->Translate('MN_Tools_MENNO') ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $Portal_Translate->Translate('MN_CALENDAR_jalali') ?></li>
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

            <div class="card">
                <div class="card-body">
                    <div class="cal1">
                        <div class="clndr">
                            <div class="clndr-controls">
                                <div class="clndr-control-button"><span class="clndr-previous-button"><?= $Portal_Translate->Translate('MONT_PRE') ?></span></div>
                                <div class="month">دی 1402</div>
                                <div class="clndr-control-button rightalign"><span class="clndr-next-button"><?= $Portal_Translate->Translate('MONTH_NEXT') ?></span>
                                </div>
                            </div>
                            <table class="clndr-table" border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                <tr class="header-days">
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Saturday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Sunday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Monday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Tuesday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Wednesday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Thursday') ?></td>
                                    <td class="header-day"><?= $Portal_Translate->Translate('DAY_Friday') ?></td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-02 calendar-dow-0">
                                        <div class="day-contents">2</div>
                                    </td>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-03 calendar-dow-1">
                                        <div class="day-contents">3</div>
                                    </td>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-04 calendar-dow-2">
                                        <div class="day-contents">4</div>
                                    </td>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-05 calendar-dow-3">
                                        <div class="day-contents">5</div>
                                    </td>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-06 calendar-dow-4">
                                        <div class="day-contents">6</div>
                                    </td>
                                    <td class="day past adjacent-month next-month calendar-day-0781-07-07 calendar-dow-5">
                                        <div class="day-contents">7</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-01 calendar-dow-6">
                                        <div class="day-contents">1</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="day past calendar-day-1402-10-02 calendar-dow-0">
                                        <div class="day-contents">2</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-03 calendar-dow-1">
                                        <div class="day-contents">3</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-04 calendar-dow-2">
                                        <div class="day-contents">4</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-05 calendar-dow-3">
                                        <div class="day-contents">5</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-06 calendar-dow-4">
                                        <div class="day-contents">6</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-07 calendar-dow-5">
                                        <div class="day-contents">7</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-08 calendar-dow-6">
                                        <div class="day-contents">8</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="day past calendar-day-1402-10-09 calendar-dow-0">
                                        <div class="day-contents">9</div>
                                    </td>
                                    <td class="day past event calendar-day-1402-10-10 calendar-dow-1">
                                        <div class="day-contents">10</div>
                                    </td>
                                    <td class="day past event calendar-day-1402-10-11 calendar-dow-2">
                                        <div class="day-contents">11</div>
                                    </td>
                                    <td class="day past event calendar-day-1402-10-12 calendar-dow-3">
                                        <div class="day-contents">12</div>
                                    </td>
                                    <td class="day past event calendar-day-1402-10-13 calendar-dow-4">
                                        <div class="day-contents">13</div>
                                    </td>
                                    <td class="day past event calendar-day-1402-10-14 calendar-dow-5">
                                        <div class="day-contents">14</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-15 calendar-dow-6">
                                        <div class="day-contents">15</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="day past calendar-day-1402-10-16 calendar-dow-0">
                                        <div class="day-contents">16</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-17 calendar-dow-1">
                                        <div class="day-contents">17</div>
                                    </td>
                                    <td class="day past calendar-day-1402-10-18 calendar-dow-2">
                                        <div class="day-contents">18</div>
                                    </td>
                                    <td class="day today calendar-day-1402-10-19 calendar-dow-3">
                                        <div class="day-contents">19</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-20 calendar-dow-4">
                                        <div class="day-contents">20</div>
                                    </td>
                                    <td class="day event calendar-day-1402-10-21 calendar-dow-5">
                                        <div class="day-contents">21</div>
                                    </td>
                                    <td class="day event calendar-day-1402-10-22 calendar-dow-6">
                                        <div class="day-contents">22</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="day event calendar-day-1402-10-23 calendar-dow-0">
                                        <div class="day-contents">23</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-24 calendar-dow-1">
                                        <div class="day-contents">24</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-25 calendar-dow-2">
                                        <div class="day-contents">25</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-26 calendar-dow-3">
                                        <div class="day-contents">26</div>
                                    </td>
                                    <td class="day event calendar-day-1402-10-27 calendar-dow-4">
                                        <div class="day-contents">27</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-28 calendar-dow-5">
                                        <div class="day-contents">28</div>
                                    </td>
                                    <td class="day calendar-day-1402-10-29 calendar-dow-6">
                                        <div class="day-contents">29</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="day calendar-day-1402-10-30 calendar-dow-0">
                                        <div class="day-contents">30</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-01 calendar-dow-1">
                                        <div class="day-contents">1</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-02 calendar-dow-2">
                                        <div class="day-contents">2</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-03 calendar-dow-3">
                                        <div class="day-contents">3</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-04 calendar-dow-4">
                                        <div class="day-contents">4</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-05 calendar-dow-5">
                                        <div class="day-contents">5</div>
                                    </td>
                                    <td class="day adjacent-month next-month calendar-day-1402-11-06 calendar-dow-6">
                                        <div class="day-contents">6</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

