<?php

class Logout extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //session_destroy();
        $_SESSION['Is_Login'] = false;
        $ResultDetailCompany = $this->model->WS_FetchCompanyDetails();
        header("location: index.php?page=Login&Message=S Logout Successfully");
    }
}

$t = new Logout();