<?php

class Router
{
    public function __construct()
    {
        session_start();
        if (isset($_SESSION['Is_Login']) && $_SESSION['Is_Login'] === true ){
            if (!isset($_REQUEST['page'])) {
                $url = 'Dashboard';
            } else {
                $url = $_REQUEST['page'];
            }
            if ($url === 'Profile' && $_REQUEST['view'] == 'Edit'){
                if ($_REQUEST['type'] != 'User' && $_REQUEST['type'] != 'Account'){
                    header("location: index.php?page=Profile&view=Detail");
                }else{
                    require ("controllers/" . $url . "/" . $url . ".php");
                }
            }
            if ($url === 'Main'){
                $View = $_REQUEST['view'];
                if ($View === 'List'){
                    require ("controllers/Main/ListView.php");
                }
                else if ($View !== 'List'){
                    require ("controllers/Main/" . $View . ".php");
                }
                else {
                    require ("controllers/ErrorPage/ErrorPage.php");
                }
            }
            else{
                if (!file_exists("controllers/" . $url . "/" . $url . ".php")) {
                    require ("controllers/ErrorPage/ErrorPage.php");
                }
                else if(strtolower($url) == 'registration'  || strtolower($url) == 'forgetpassword' || strtolower($url) == 'login'){
                    require ("controllers/ErrorPage/ErrorPage.php");
                }
                else{
                    require ("controllers/" . $url . "/" . $url . ".php");
                }
            }
        }else{
            if (CRM_URL == 'http://example.com'){
                require ("controllers/GetCrmUrl/GetURL.php");
            }
            else{
                if ($_REQUEST['page'] == 'registration'){
                    require ("controllers/Registration/Registration.php");
                }
                else if($_REQUEST['page'] == 'ForgetPassword'){
                    require ("controllers/ForgetPassword/ForgetPassword.php");
                }
                else{
                    require ("controllers/Login/Login.php");
                }
            }
        }
    }
}
