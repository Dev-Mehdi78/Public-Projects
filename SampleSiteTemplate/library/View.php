<?php

class View {

    public function RenderPage($Content){
        require "template/Header.php";
        require "template/Sidebar.php";
        require 'views/'.$Content.'.php';
        require "template/Footer.php";
    }

}