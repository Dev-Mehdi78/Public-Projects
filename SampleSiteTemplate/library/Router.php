<?php

class Router{

    public function __construct()
    {
        if (!isset($_REQUEST['page'])) {
            $url = 'MainPage';
        } else {
            $url = $_REQUEST['page'];
        }
        //die($url);
        if (!file_exists("controllers/" . $url . ".php")) {
            echo "Not  Found";
        }else{
            //die("controllers/" . $url . ".php");
            require ("controllers/" . $url . ".php");
        }

    }

}