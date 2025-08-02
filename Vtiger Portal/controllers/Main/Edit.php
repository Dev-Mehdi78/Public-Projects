<?php
class Edit extends Controller{
    function __construct()
    {
        parent::__construct();
        $ModuleName = $_REQUEST['module'];
        $IDRecord   = $_REQUEST['record'];
        $EditRecord = $this->model->WS_Custom_ParsFetchRecord($ModuleName , $IDRecord);

        if ($EditRecord['success'] === true){
            $EditRecord = $EditRecord['result'];
            if (isset($_REQUEST['EditRecord'])) {
                $ParameterSaveRecord = parent::ProccessSaveRecord();
                $Edit = $this->model->WS_SaveRecord($ParameterSaveRecord['Module'] , $ParameterSaveRecord['Params'], $ParameterSaveRecord['recordId']);
                if ($Edit['success'] === true){
                    $ModuleName = $_REQUEST['module'];
                    $RecordID   = $Edit['result']['record']['id'];
                    header('Location: index.php?page=Main&module='.$ModuleName.'&view=Detail&record='.$RecordID.'&Message=S OperationSuccess');
                }else{
                    header('Location: index.php?page=Main&module='.$ModuleName.'&view=List&Message=E OperationError');
                }
            }else{
                $this->view->RenderPage('Main/Edit',array('EditRecord' => $EditRecord),array());
            }
        }else{
            header('Location: index.php?page=Main&module='.$ModuleName.'&view=List&r&Message=S OperationSuccess');
        }
    }


}
$T = new Edit();