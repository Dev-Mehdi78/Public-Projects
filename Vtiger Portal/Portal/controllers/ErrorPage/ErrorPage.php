<?php

class ErrorPage extends Controller{

    public function __construct()
    {
        parent::__construct();
        $this->view->RenderUniq('ErrorPage/index' , array() , array());
    }

}
$t = new ErrorPage();