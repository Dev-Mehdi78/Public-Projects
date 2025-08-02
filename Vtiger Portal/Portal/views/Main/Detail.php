<?php
require ("views/CustomViewFields.php");
require ("views/ShowMessage.php");
require ("views/ProcessField.php");
?>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <?php
        if (isset($_GET['Message'])){
            ShowMeassage($_GET['Message']);
        }
        ?>

        <?php

        $ModuleName  =  $Parameters['DetailRecord']['describe']['name'];
        $ModuleLabel =  $Parameters['DetailRecord']['describe']['label'];
        ?>
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title"><a href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=List"><?php echo $Portal_Translate->Translate('HEADER_TITLE_DETAIL'); ?></h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php?page=Main&module=<?php echo $ModuleName ?>&view=List"><?php echo $ModuleLabel ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo $Portal_Translate->Translate('HEADER_TITLE_DETAIL'); ?></li>
                    </ol>
                </div>
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
        <?php
           /* echo "<pre>";
            print_r($Parameters['DetailRecord']);

            echo "</pre>";*/
            $Blocks               =  $Parameters['DetailRecord']['describe']['blocks'];
            $AccessFields         =  $Parameters['DetailRecord']['describe']['fields'];
            $ModComments          =  $Parameters['DetailRecord']['ModComments'];
            $History              =  $Parameters['DetailRecord']['History'];
            $Data                 =  $Parameters['DetailRecord']['mainrecord'];
            $RelatedModules       =  $Parameters['DetailRecord']['relatedmodules'];
            if ($Parameters['DetailRecord']['mainrecord']['lineItems']){
                $InfoLineItem     = $Parameters['DetailRecord']['mainrecord']['lineItems'];
            }else{
                $InfoLineItem     = null;
            }
            $TypeDate             = $_SESSION['Type_Date'];
            echo '<div class="card">';
                    $ProcessField = ProcessFieldDetaile($ModuleName , $ModuleLabel  , $Blocks , $AccessFields , $ModComments  , $History , $Data , $RelatedModules , $InfoLineItem , $TypeDate);
            echo '</div>';
        ?>

    </div>
</div>