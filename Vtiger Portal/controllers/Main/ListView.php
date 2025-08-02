<?php

class ListView extends Controller{
    public function __construct()
    {
        parent::__construct();
        $ParamsListView = $this->ListView();
        if ($_REQUEST['view'] === 'List'){
            if ($ParamsListView['DescribeFetchRecord']['success'] === true){
                $this->view->RenderPage('Main/List' , array('ParamsListView' => $ParamsListView), array());
            }else{
                if (isset($ParamsListView['error'])){
                    $ErrorCode    = $ParamsListView['error']['code'];
                    $ErrorMessage = $ParamsListView['error']['message'];
                    $this->view->RenderPage('Main/List' , array('ErrorModuleWebSide'=>'ERROR WEBSERVICE' , "ErrorCode"=> $ErrorCode , "ErrorMessage" => $ErrorMessage),array());
                }else{
                    $this->view->RenderPage('Main/List' , array('ErrorModuleWebSide'=>'ERROR WEBSERVICE'),array());
                }
            }
        }
    }
    public function ListView (){
        $Modules = $_REQUEST['module'];
        $ParsVTDescribeFetchRecords = $this->model->WS_ParsFetchRecords($Modules , $Modules);
        if ($ParsVTDescribeFetchRecords['success'] === true){
            $ListViewParamsResults = array(
                'DescribeFetchRecord' => $ParsVTDescribeFetchRecords
            );
            $Res = $ListViewParamsResults;
        }else{
            if (isset($ParsVTDescribeFetchRecords['error'])){
                $Res = $ParsVTDescribeFetchRecords;
            }else{
                $Res = false;
            }

        }
        return $Res;
    }
}

$T = new ListView();