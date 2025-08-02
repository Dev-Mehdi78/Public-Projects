<?php
/*
 * Grad
 * mokhtasat
 * Pick List Multi Value
 * Rezayat Mande Moshtare
 * Raiting
 * whater Ab o hava
 * */
class Create extends Controller{
    public function __construct()
    {
        parent::__construct();
        $ParamsCreateView = $this->CreateView();
        $ModuleName = $_REQUEST['module'];
        if ($ParamsCreateView != false) {
            $AccessCreate = $ParamsCreateView['DescribeFetchRecord']['result']['describe']['permissions']['AllowCreate'];
            if ($AccessCreate != false){
                if (isset($_REQUEST['CreateRecord'])) {
                    $ParameterSaveRecord = $this->ProccessSaveRecord();
                    $Create = $this->model->WS_SaveRecord($ParameterSaveRecord['Module'] , $ParameterSaveRecord['Params'] );
                    if ($Create['success'] === true){
                        $RecordID   = $Create['result']['record']['id'];
                        header('Location: index.php?page=Main&module='.$ModuleName.'&view=Detail&record='.$RecordID.'&Message=S OperationSuccess');
                    }else{
                        header('Location: index.php?page=Main&module='.$ModuleName.'&view=List&Message=E OperationError');
                    }
                }else{
                    $this->view->RenderPage('Main/Create', array('ParamsCreateView' => $ParamsCreateView), array());
                }
            }
            else{
                header('Location: index.php?page=Main&module='.$ModuleName.'&view=List&Message=E OperationError');
            }
        }
        else{
            header('Location: index.php?page=Main&module='.$ModuleName.'&view=List&Message=E OperationError');
        }
    }

    public function CreateView (){
        $Modules = $_REQUEST['module'];
        $ParsVTDescribeFetchRecords = $this->model->WS_ParsFetchRecords($Modules , $Modules);

        if ($ParsVTDescribeFetchRecords['success'] === true){
            $ListViewParamsResults = array(
                'DescribeFetchRecord' => $ParsVTDescribeFetchRecords
            );
            $Res = $ListViewParamsResults;
        }else{
            $Res = false;
        }
        //echo '<pre>';die(print_r($ListViewParamsResults));
        return $Res;
    }

    public function ProccessSaveRecord(){
        $ProccessParams = $_REQUEST;
        $ModulName = $ProccessParams['module'];
        foreach ($ProccessParams as $key=>$value) {
            if ($key != 'page' && $key != 'module' && $key != 'view'&& $key != 'CreateRecord'){
                list($FieldName , $FieldType) = explode('--', $key);
                if ($FieldType == 'string' || $FieldType == 'phone' || $FieldType == 'email' || $FieldType == 'url' || $FieldType == 'text' ){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }
                }
                else if ($FieldType == 'double7' || $FieldType == 'double9' || $FieldType == 'currency'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }
                }
                else if ( $FieldType == 'integer' || $FieldType == 'time' || $FieldType == 'gregoriandate' || $FieldType == 'IPAddressField'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }
                }
                else if ($FieldType == 'picklist'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }
                }
                else if ($FieldType == 'multipicklist' ){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }
                }
                else if (  $FieldType == 'date' ){
                    if ($value != ''){
                        if ($_SESSION['Type_Date'] == 'jalali'){
                            $Parameters[$FieldName] = $this->model->ToMiladi($value);
                        }else{
                            $Parameters[$FieldName] = $value;
                        }
                    }
                }
                else if ($FieldType == 'datetime'){
                    if ($value[0] != '' || $value[1] != '' ){
                        if ($_SESSION['Type_Date'] == 'jalali'){
                            $Date = $this->model->ToMiladi($value[0]);
                            $Time = $value[1];
                            $DateAndTime = $Date . ' ' . $Time;
                            $Parameters[$FieldName] = $DateAndTime;
                        }else{
                            $DateAndTime = $value[0] . ' ' . $Time;
                            $Parameters[$FieldName] = $DateAndTime;
                        }

                    }
                }
                else if ($FieldType == 'PlaqueField'){
                    if ($value[0] != '' || $value[1] != '' || $value[3] != '' ){
                        $Plaque =  $value[3] . '-' . $value[2] . '-' . $value[1] . '-' . $value[0];
                        $Parameters[$FieldName] = $Plaque;
                    }
                }
                else if ($FieldType == 'boolean'){
                    $Parameters[$FieldName] = ($value == 'on') ? 1 : 0 ;
                }
                else{
                    $Parameters[$FieldName] = $value;
                }
            }
        }
        foreach ($_FILES as $key=>$value){
            list($FieldName , $FieldType) = explode('--', $key);
            if ($FieldType == 'Uploadfields' ){
                if ($value['name'][0] != ''){
                    $ProccessUploadFiles    = $this->model->SaveMultiFile($value);
                    $Parameters[$FieldName] = $ProccessUploadFiles ;
                }
            }
            else if(isset($value['name']) && !empty($value['name']) && $value['name'] != ''){
                $ProccessUploadFile     = $this->model->SaveFile($value);
                $Parameters[$FieldName] = $ProccessUploadFile;
            }
        }

        $Parameters = json_encode($Parameters);
        $Prossecc['Module'] = $ModulName;
        $Prossecc['Params'] = $Parameters;
        return $Prossecc;
    }
}
$T = new Create();