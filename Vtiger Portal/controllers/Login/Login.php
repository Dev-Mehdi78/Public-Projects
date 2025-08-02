<?php

require 'models/Login/login_model.php';

class Login extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $ResultDetailCompany = $this->model->WS_FetchCompanyDetails();
        $AccessLoginModelMethod = new login_model();
        $Res = $AccessLoginModelMethod->ProcessAuthenticate();
        if ($_SESSION['Is_Login'] === true){
            if ($Res === true){
                header("location: index.php?page=Dashboard&Message=S Login Successfully");
            }
        }
        else{
            if ($Res === false){
                header("location: index.php?page=Login&Message=E The Username Or Password Is Incorrect");
            }
            elseif ($Res === 'UserPassNull'){
                header("location: index.php?page=Login&Message=E UserName Or Password Is Empty");
            }
            elseif (isset($_REQUEST['page']) && $_REQUEST['page'] !== 'Login'){
                header("location: index.php?page=Login&Message=E Unauthorized Request: Please Login First");
            }
            else{
                $this->view->RenderPage('Login/index' , array('CompanyDetail' => $ResultDetailCompany));
            }
        }
    }
}
$t = new Login();
//$t->LoginChecked();
