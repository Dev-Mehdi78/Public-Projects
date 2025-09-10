<?php

class MainPage extends Controller{

    public function __construct()
    {
        parent::__construct();
        $this->view->RenderPage('MainPage/MainPage');
    }

}
$test = new MainPage();