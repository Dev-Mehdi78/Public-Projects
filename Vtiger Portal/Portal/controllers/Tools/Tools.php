<?php

class Tools extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $PageName = $this->model->get_request('name');

        if ($PageName === 'ConvertedDate'){
            $this->view->RenderPage('Calendar/Converted' , array() , array());
        }
        if ($PageName === 'JCalendar'){
            $this->view->RenderPage('Calendar/JDate' , array() , array());
        }
        if ($PageName === 'MCalendar'){
            $this->view->RenderPage('Calendar/MDate' , array() , array());
        }
        if ($PageName === 'AboutAccount'){
            $this->view->RenderPage('About/AboutAccount' , array() , array());
        }

    }
}

$T = new Tools();