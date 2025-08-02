<?php
require __DIR__."/config.php";
include __DIR__."/library/jdf.php";

function Hash_Authorisation($User , $Pass) : string
{
    $HashedUserPass = $User.':'.$Pass;
    $Res_Base = base64_encode($HashedUserPass);
    return $Res_Base;
}

function WS_AttachFile($Username , $Password , $FilePath){
    $Auth =  Hash_Authorisation($Username , $Password );
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation='.CUSTOM_METHOD_ATTACHFILE.'&file_path='.$FilePath,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '. $Auth
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response , true);
    if ($response['success'] === true ){
        $CallBackData     = $response['result'];
        $CallBackDataIMG  = $response['result'][0]['filecontents'];
       /* echo "<pre>";
        print_r($CallBackData);
        echo "</pre>";*/
        echo json_encode(array('status' => 'Success', 'return' => 'true' , 'CallBack' => $CallBackData[0] , 'BaseEnData' => $CallBackDataIMG));
    }else{
        echo json_encode(array('status' => 'Error', 'return' => 'False' , 'CallBack' => "Error In Webservice"));
    }


}


function Get_Status_Support($Username , $Password , $TypeDate){
    $Token =  Hash_Authorisation($Username , $Password);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchSupportNotification',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic '.$Token
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response , true);
    if ($response['success'] === true ){
        $CallBackData     = $response['result'];
        $CalBackEndDate   = $response['result']['support_end_date'];

        $Data['support_notification_days'] = $response['result']['support_notification_days'];
        $Data['support_remaining_days']    = $response['result']['support_remaining_days'];
        $Data['support_notify']            = $response['result']['support_notify'];

        if ($TypeDate == 'jalali'){
            $Data['support_end_date'] = jdate('Y/m/d', strtotime($CalBackEndDate));
        }else{
            $Data['support_end_date'] = $CalBackEndDate;
        }
        echo json_encode(array('status' => 'Success', 'return' => 'true' , 'CallBack' => $Data ));
    }else{
        echo json_encode(array('status' => 'Error', 'return' => 'False' , 'CallBack' => "Error In Webservice"));
    }
}

function SettingsURL($GetURL){

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $GetURL.'/modules/ParsVT/ws/Portal/?operation=FetchCompanyDetails&language='.$_SESSION['Type_Language'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $response = json_decode($response , true);

    if ($response['success'] === true){
        update_place_config($GetURL);
        echo json_encode(array('status' => 'Success', 'return' => 'true' ));
    }
    else{
        echo json_encode(array('status' => 'Error', 'return' => 'False' , 'CallBack' => "Error In Webservice"));
    }
}

function ResetSettingsURL($GetURL)
{
    update_place_config($GetURL);
    echo json_encode(array('status' => 'Success', 'return' => 'true'));
}

function update_place_config($Link)
{
    $Contents = file_get_contents('config.php');
    $content = preg_replace("/('CRM_URL' =>) '[^']+'/", "$1 '{$Link}'", $Contents);
    $place_config = file_put_contents('config.php', $content);
    return $place_config; //if you want to get the new config
}

if (isset($_POST['SendType']) && $_POST['SendType'] === "GetStatusSupport"){
    $UserAuth = $_POST['UsernameAuth'] ;
    $PassAuth = $_POST['PasswordAuth'] ;
    $TypeDate = $_POST['TypeDate'] ;
    Get_Status_Support($UserAuth , $PassAuth , $TypeDate);
}

if (isset($_POST['SendType']) && $_POST['SendType'] === "SettingsURL"){
    $CRM_URL = $_POST['CrmURL'] ;
    SettingsURL($CRM_URL);
}

if (isset($_POST['SendType']) && $_POST['SendType'] === "ResetSettingsURL"){
    $CRM_URL = $_POST['ResetURL'] ;
    ResetSettingsURL($CRM_URL);
}

if (isset($_POST['SendType']) && $_POST['SendType'] === "DownloadImage"){
    $UserName = $_POST['UName'] ;
    $Password = $_POST['Pass'] ;
    $Data     = $_POST['DataImage'] ;
    WS_AttachFile($UserName , $Password , $Data);
}




