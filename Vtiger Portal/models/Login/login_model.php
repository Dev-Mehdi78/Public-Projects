<?php

class login_model extends Model
{

    public function ProcessAuthenticate()
    {
        if (isset($_POST['SubmiLogin']) && $_REQUEST ) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $UserName         = $_POST['UserName'];
                $Password         = $_POST['Password'];
                $Type_Date_Portal = $_POST['Type_Date_Portal'];
                $Language_Portal  = $_POST['Language_Portal'];
                if (isset($Language_Portal) && $Language_Portal != null){
                     $Language =  $Language_Portal;
                }else{
                     $Language =  DEFAULT_LANGUAGE['value'];
                }
                if (isset($Type_Date_Portal) && $Type_Date_Portal != null){
                    $Date = $Type_Date_Portal;
                }else{
                    $Date = DEFAULT_DATE_TYPE ;
                }
                $_SESSION['Type_Date']              = $Date;
                $_SESSION['Type_Language']          = $Language;
                if ($UserName == null || $Password == null){
                    $_SESSION['Is_Login'] = false;
                    $Result = 'UserPassNull';
                }
                if (isset($UserName) && $UserName != null && isset($Password) && $Password != null ){
                    $Result_Login                           = parent::WS_ParsLogin($UserName ,  $Password);
                    $ResultMainCompany                      = parent::WS_FetchCompanyDetails();
                    if ($Result_Login['success'] === true){

                        $_SESSION['Is_Login']               = true;
                        $_SESSION['CustomerDetails']        = (array)$Result_Login['result']->customerDetails;
                        $_SESSION['CompanyDetails']         = (array)$Result_Login['result']->companyDetails;
                        $_SESSION['MainCompany']            = (array)$ResultMainCompany['result'];
                        $_SESSION['contactId']              = (array)$Result_Login['result']->contactId;
                        $_SESSION['accountId']              = (array)$Result_Login['result']->accountId;
                        $UName                              = (array)$Result_Login['result']->username;
                        $_SESSION['username']               = $UName[0];
                        $Pass                               = (array)$Result_Login['result']->password;
                        $_SESSION['password']               = $Pass[0];
                        $_SESSION['language']               = (array)$Result_Login['result']->language;
                        $_SESSION['greetingType']           = (array)$Result_Login['result']->greetingType;
                        $_SESSION['greetingType']           = (array)$Result_Login['result']->greetingType;
                        $_SESSION['scopeFilter']            = (array)$Result_Login['result']->scopeFilter;
                        $_SESSION['portalThemeUrl']         = (array)$Result_Login['result']->portalThemeUrl;
                        $_SESSION['charts']                 = (array)$Result_Login['result']->charts;
                        $_SESSION['shortcuts']              = (array)$Result_Login['result']->shortcuts;
                        $_SESSION['recentRecords']          = (array)$Result_Login['result']->recentRecords;
                        $_SESSION['modules']                = (array)$Result_Login['result']->modules;
                        $_SESSION['profileModules']         = (array)$Result_Login['result']->profileModules;
                        $_SESSION['supportNotification']    = (array)$Result_Login['result']->supportNotification;
                        $_SESSION['accountRepresentatives'] = (array)$Result_Login['result']->accountRepresentatives;
                        //echo "<pre>";die(print_r($_SESSION));
                        header('location:index.php?page=Dashboard');
                        $Result = true;
                    }else{
                        $_SESSION['Is_Login'] = false;
                        $Result = false;
                    }
                }
            }
        }
        return $Result;
    }

}
