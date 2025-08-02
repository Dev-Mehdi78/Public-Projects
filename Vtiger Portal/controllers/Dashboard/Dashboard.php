<?php

class Dashboard extends Controller{

    public function __construct()
    {
        parent::__construct();
        $Announcement  = $this->model->WS_FetchSettings();
        $FetchCharts  = $this->model->WS_FetchCharts();
//        echo "<pre>";
//        print_r($FetchCharts);
//        echo "\n" ;
//        die('done');
        $this->view->RenderPage("Dashboard/index" ,
            array('SettingsPortal'  => $Announcement, 'FetchCharts'  => $FetchCharts), array());
    }

}

$t = new Dashboard();
