<?php

class GetURL extends Controller{

    public function __construct()
    {
        parent::__construct();
        if (isset($_POST['SubmitSelectedLanguage'])){

            $Language = $_POST['Language_Portal'];
            $_SESSION['Type_Language'] = $Language;
        }
        if (isset($_POST['SubmitCRMLink'])){
            $Link = $_POST['CRMLink'];
            $CheckedURL = $this->model->WS_FetchCompanyDetails($Link);
            if ($CheckedURL['success'] === true){

                header('location: index.php?page=GetCrmUrl&message=SuccessURL');
            }else{
                header('location: index.php?page=GetCrmUrl&message=ErrorURL');
            }
        }
        $this->view->RenderPage('SettingsURL/SettingsURL' , array() , array());
    }


}

$T = new GetURL();