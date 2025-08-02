<?php

class View
{
    public function __construct() {
        $this->model = new Model();
    }

    public function showMessages($Message , $Location = null) {
        $messages = $this->model->getMessages($Message);
        if (is_array($messages)){
            $ResMessage = array();
            foreach ($messages as $message) {
                array_push($ResMessage , $message);
            }
            return $ResMessage;
        }
        return $messages;
    }

    public function RenderPage($Content , $Params = array() , $Message = array()){

        if (isset($_SESSION['Is_Login']) && $_SESSION['Is_Login'] === true){
            require 'template/Header.php';
            require 'template/RightSidebarSettings.php';
            require 'template/Sidebar.php';
            //$this->showMessages();
            include $Message;
            $Parameters = $Params;
            include $Parameters;
            require 'views/'.$Content.'.php';

            require 'template/Footer.php';
        }else{
            include $Message;
            $Parameters = $Params;
            include $Parameters;
            require 'views/'.$Content.'.php';
        }
    }

    public function RenderUniq($Content , $Params = array() , $Message = array()){

        include $Message;
        $Parameters = $Params;
        include $Parameters;
        require 'views/'.$Content.'.php';

    }

}