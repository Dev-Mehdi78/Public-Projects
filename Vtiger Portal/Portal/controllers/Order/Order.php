<?php

class Order extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $AccessModule = $_SESSION['modules']['types'];
        if (in_array('Products' , $AccessModule) && in_array('Quotes' , $AccessModule)){
            $DataProducts = $this->model->WS_ParsFetchRecords("Products" , "Products" , null , 9 , null , null , null);
            if ($DataProducts['success'] === true){
                $this->view->RenderPage("Order/Order" , array('Data' => $DataProducts['result']) , array());
            }
            else{
                $ErrorCode    = $DataProducts['error']['code'];
                $ErrorMessage = $DataProducts['error']['message'];
                $this->view->RenderPage("Order/Order" , array('ErrorModuleWebSide'=>'ERROR WEBSERVICE' , "ErrorCode"=> $ErrorCode , "ErrorMessage" => $ErrorMessage) , array());
            }
        }else{
            header("location: index.php?page=Dashboard");
        }

    }
}
$t = new Order();