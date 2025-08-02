<?php

class Controller
{
    public function __construct()
    {
        $this->view = new View();
        $this->model = new Model();
    }

    public function addMessage($message) {
        $this->model->addMessage($message);
    }

    public function ProccessSaveRecord(){
        $ProccessParams = $_REQUEST;
        if (!isset($ProccessParams['module']) && $ProccessParams['module'] == ''){
            $ModulName  = (isset($ProccessParams['type']) && $ProccessParams['type'] == 'User')? 'Contacts' : 'Accounts' ;
        }else{
            $ModulName = $ProccessParams['module'];
        }
        $RecordID  = $ProccessParams['record'];
        foreach ($ProccessParams as $key=>$value) {
            if ($key != 'page' && $key != 'module' && $key != 'view' && $key != 'EditRecord' && $key != 'record'  && $key != 'type'){
                list($FieldName , $FieldType) = explode('--', $key);
                if ($FieldType == 'string' || $FieldType == 'phone' || $FieldType == 'email' || $FieldType == 'url' || $FieldType == 'text' ){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ($FieldType == 'double7' || $FieldType == 'double9' || $FieldType == 'currency'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ( $FieldType == 'integer' || $FieldType == 'time' || $FieldType == 'gregoriandate' || $FieldType == 'IPAddressField'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ($FieldType == 'picklist'){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ($FieldType == 'multipicklist' ){
                    if ($value != ''){
                        $Parameters[$FieldName] = $value;
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ($FieldType == 'date' ){
                    if ($value != ''){
                        if ($_SESSION['Type_Date'] == 'jalali'){
                            $Parameters[$FieldName] = $this->model->ToMiladi($value);
                        }else{
                            $Parameters[$FieldName] = $value;
                        }
                    }else{
                        $Parameters[$FieldName] = "";
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
                    }else{
                        $Parameters[$FieldName] = "";
                    }
                }
                else if ($FieldType == 'PlaqueField'){
                    if ($value[0] != '' || $value[1] != '' || $value[3] != '' ){
                        $Plaque =  $value[3] . '-' . $value[2] . '-' . $value[1] . '-' . $value[0];
                        $Parameters[$FieldName] = $Plaque;
                    }else{
                        $Parameters[$FieldName] = "";
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
                $ProccessUploadFiles    = $this->model->SaveMultiFile($value);
                if ($ProccessUploadFiles != 'no'){
                    $Parameters[$FieldName] = $ProccessUploadFiles;
                }else{
                    continue;
                }
            }
            else if(isset($value['name']) && !empty($value['name']) && $value['name'] != ''){
                $ProccessUploadFile     = $this->model->SaveFile($value);
                $Parameters[$FieldName] = $ProccessUploadFile;
            }
        }
        $Parameters = json_encode($Parameters);
        $Prossecc['Module']   = $ModulName;
        $Prossecc['Params']   = $Parameters;
        $Prossecc['recordId'] = $RecordID;
        return $Prossecc;
    }

}
