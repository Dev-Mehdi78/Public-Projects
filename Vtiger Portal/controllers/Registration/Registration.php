<?php

class Registration extends Controller{

    public function __construct()
    {
        parent::__construct();

        $ResultDetailCompany = $this->model->WS_FetchCompanyDetails();
        if ($ResultDetailCompany['success'] === true){
            if ($ResultDetailCompany['result']->registration === true){
                if (isset($_REQUEST['SubmiRegistration'])){
                    $ParameterSaveRegistration = $this->ProccessRegistration();
                    $CreateNewContacts = $this->model->WS_Register($ParameterSaveRegistration);
                    if ($CreateNewContacts['success'] === true){
                        $DataRegistration['id']       = $CreateNewContacts['result']['id'];
                        $DataRegistration['username'] = $CreateNewContacts['result']['username'];
                        $DataRegistration['password'] = $CreateNewContacts['result']['password'];

                        $this->view->RenderPage('Registration/index' , array('DetailSuccess' => $DataRegistration) , array('Success' => 'Your registration was successful'));

                    }else{
                        $this->view->RenderPage('Registration/index' , array('CompanyDetail' => $ResultDetailCompany) , array('Error' => 'An Error Was Detected On The webservice Side'));
                    }
                }else{
                    $this->view->RenderPage('Registration/index' , array('CompanyDetail' => $ResultDetailCompany) , array());
                }
            }else{
                $this->view->RenderPage('Login/index' , array('CompanyDetail' => $ResultDetailCompany) , array('Error'=>'Error: Access Denied'));
            }
        }

    }

    public function ProccessRegistration(){
        $DataRequestRegistration = $_REQUEST;
        $Params = array();
        foreach ($DataRequestRegistration as $key=>$value){
            if ($key != 'page' && $key != 'SubmiRegistration'){

                list($FieldName , $FieldType) = explode('--', $key);

                if ($FieldType === 'string' || $FieldType == 'phone' || $FieldType == 'email' || $FieldType == 'text' || $FieldType == 'float' || $FieldType == 'MILDate' || $FieldType == 'color'|| $FieldType == 'ip'){
                    if ($value != ''){
                        $ValuParameters = $FieldName . '=' . $value;
                        array_push($Params , $ValuParameters);
                    }
                }

                elseif ($FieldType === 'date' ){
                    if ($value != ''){
                        if ($_SESSION['Type_Date'] == 'jalali'){
                            $value = $this->model->ToMiladi($value);
                            $ValuParameters = $FieldName . '=' . $value;
                            array_push($Params , $ValuParameters);

                        }else{
                            $ValuParameters = $FieldName . '=' . $value;
                            array_push($Params , $ValuParameters);
                        }
                    }
                }

                elseif ($FieldType === 'boolean' ){
                   if ($value == 'on'){
                       $ValuParameters = $FieldName . '=1';
                       array_push($Params , $ValuParameters);
                   }else{
                       $ValuParameters = $FieldName . '=0';
                       array_push($Params , $ValuParameters);
                   }
                }

            }

        }

        foreach ($_FILES as $key=>$value){
            list($FieldName , $FieldType) = explode('--', $key);
            if ($FieldType == 'Uploadfields' ){
                if ($value['name'][0] != ''){
                    $ProccessUploadFiles    = $this->model->SaveMultiFileRegistration($value);
                    $ValuParameters = $FieldName . '=' . $ProccessUploadFiles;
                    array_push($Params , $ValuParameters);
                }
            }
            else if(isset($value['name']) && !empty($value['name']) && $value['name'] != ''){
                $ProccessUploadFile     = $this->model->SaveFileRegistration($value);
                $ValuParameters = $FieldName . '=' . $ProccessUploadFile;
                array_push($Params , $ValuParameters);
            }
        }

        $Parameters = implode('&' , $Params);
//        echo "<pre>";print_r($Parameters);
//        die;
        return $Parameters;
    }

}



$T = new Registration();