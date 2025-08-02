<?php

include 'models/ChangePassword/changePassword_model.php';

class Profile extends Controller{
    public function __construct()
    {
        parent::__construct();
        $view = $this->model->get_request('view');
        $Data  = $this->Operation_CustomerDetail();
        if ($view == 'Detail') {
            if (isset($_POST['Data_Change_Password'])){
                $ChangePasswordClass     = new changePassword_model;
                $ResultChangPassword     = $ChangePasswordClass -> Process_ChangePassword();
                if ($ResultChangPassword === 'ChangePasswordSuccess') {
                    session_destroy();
                    $_SESSION['Is_Login'] = false;
                    header("location: index.php?page=Login&Message=S Chang Password Successfully");
                }
                elseif($ResultChangPassword === 'Password Mismatch'){
                    header("location: index.php?page=Profile&view=Detail&Message=E The New Passwords Do Not Match");
                }
                else if($ResultChangPassword === 'Incorrect OldPassword'){
                    header("location: index.php?page=Profile&view=Detail&Message=E Your Current password is incorrect");
                }
            }
            $this->view->RenderPage('Profile/Detail' , array('data' => $Data) , array());
        }
        if ($view == 'Edit'){
            if (isset($_REQUEST['EditRecord'])) {
                $ParameterSaveRecord =parent::ProccessSaveRecord();
                $ModuleName = ($_REQUEST['type'] == 'User') ? 'Contacts' : 'Accounts' ;
                $Edit = $this->model->WS_SaveRecord($ModuleName , $ParameterSaveRecord['Params'], $ParameterSaveRecord['recordId']);
                if ($Edit['success'] === true){
                    header('Location: index.php?page=Profile&view=Detail&Message=S OperationSuccess');
                }else{
                    header('Location: index.php?page=Profile&view=Detail&Message=E OperationError');
                }
            }else{
                $this->view->RenderPage('Profile/Edit' , array('data' => $Data) , array());
            }

        }
    }

    public function Operation_CustomerDetail(){
        $ResultContactsDetail  = $this->model->WS_DescribeModule('Contacts');
        $ResultAccountsDetail  = $this->model->WS_DescribeModule('Accounts');
        $ResultDataProfile     = $this->model->WS_FetchProfile();

        if ($ResultDataProfile['success']    == true) {
            $ResultDataProfile = json_decode($ResultDataProfile , true);
        }else{
            $ResultDataProfile = null ;
        }

        if ($ResultContactsDetail['success'] == true ){
            $ResultContactsDetail  = json_decode($ResultContactsDetail , true);
            $AccessBlocksContacts  = $ResultContactsDetail['result']['describe']['blocks'];
            $AccessFieldContacts   = $ResultContactsDetail['result']['describe']['fields'];
            $PermissionsContacts   = $ResultContactsDetail['result']['describe']['permissions'];
            if ($ResultDataProfile   != null){
                $ValueDataContacts    = $ResultDataProfile['result']['customer_details'];
            }
            foreach ($AccessFieldContacts as $Field){
                $FieldName                             = $Field['name'];
                $Field                                 = $ValueDataContacts[$FieldName];
                $ResultAccessFieldContacts[$FieldName] = $Field;
            }
        }

        if ($ResultAccountsDetail['success'] == true) {
            $ResultAccountsDetail = json_decode($ResultAccountsDetail , true);
            $AccessBlocksAccounts = $ResultAccountsDetail['result']['describe']['blocks'];
            $AccessFieldAccounts  = $ResultAccountsDetail['result']['describe']['fields'];
            $PermissionsAccounts  = $ResultAccountsDetail['result']['describe']['permissions'];
            if ($ResultDataProfile   != null){
                $ValueDataAccounts    = $ResultDataProfile['result']['company_details'];
            }
            foreach ($AccessFieldAccounts as $Field){
                $FieldName                             = $Field['name'];
                $Field                                 = $ValueDataAccounts[$FieldName];
                $ResultAccessFieldAccounts[$FieldName] = $Field;
            }

        }

        $ResProfileInfo['AccessFieldContacts'] = $AccessFieldContacts;
        $ResProfileInfo['FieldValueContacts']  = $ResultAccessFieldContacts;
        $ResProfileInfo['BlocksContacts']      = $AccessBlocksContacts;
        $ResProfileInfo['ContactsID']          = $ResultDataProfile['result']['customer_details']['id'];
        $ResProfileInfo['PermissionsContacts'] = $PermissionsContacts;
        $ResProfileInfo['AccessFieldAccounts'] = $AccessFieldAccounts;
        $ResProfileInfo['FieldValueAccounts']  = $ResultAccessFieldAccounts;
        $ResProfileInfo['BlocksAccounts']      = $AccessBlocksAccounts;
        $ResProfileInfo['AccountsID']          = $ResultDataProfile['result']['company_details']['id'];;
        $ResProfileInfo['PermissionsAccounts'] = $PermissionsAccounts;

        return $ResProfileInfo;
    }

}

$t = new Profile();