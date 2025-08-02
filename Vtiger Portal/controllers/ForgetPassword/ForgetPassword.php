<?php

class ForgetPassword extends Controller{
    public function __construct(){
        parent::__construct();
        $ResultDetailCompany = $this->model->WS_FetchCompanyDetails();
        if (isset($_REQUEST['SendForgetPassword'])){
            header("location: index.php?page=ForgetPassword");
        }
        if ($ResultDetailCompany['success'] === true){
            $this->view->RenderPage('ForgetPassword/ForgetPassword' , array('CompanyDetail' => $ResultDetailCompany) , array());
        }

    }
}
$t = new ForgetPassword();