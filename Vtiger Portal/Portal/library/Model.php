<?php

class Model{

    private $messages = array();

    public function addMessage($message) {
        $this->messages[] = $message;
    }

    public function getMessages($message) {
        return $message;
    }

    public function base64_encode($User , $Pass){
        $HashedUserPass = $User.':'.$Pass;
        $ResBase = base64_encode($HashedUserPass);
        return $ResBase;
    }

    public function get_request($Key)
    {
        return $_REQUEST[$Key];
    }

    public function WS_Ping($User , $Pass){
        $SetBasicAuthenticate = $this->base64_encode($User , $Pass);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=ParsLogin&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        //echo "<pre>"; die(print_r($response));
        return $response;
    }

    public function WS_ParsLogin($User , $Pass){
        $SetBasicAuthenticate = $this->base64_encode($User , $Pass);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=ParsLogin&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        //echo "<pre>"; die(print_r($response));
        return $response;
    }

    public function WS_FetchCompanyDetails($Url = null){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $MainURL = ($Url == null) ? CRM_URL : $Url ;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $MainURL.'/modules/ParsVT/ws/Portal/?operation=FetchCompanyDetails&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        //echo '<pre>';die(print_r($response));
        $response = (array)$response;
        //echo "<pre>"; die(print_r($response));
        return $response;
    }

    public function WS_DescribeModule($module){
        //print_r($_SESSION['password']); die;
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=DescribeModule&module='.$module .'&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '. $SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function WS_FetchProfile(){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchProfile',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function WS_ChangePassword($OldPassword , $NewPassword){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=ChangePassword&password='.$OldPassword.'&newPassword='.$NewPassword,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '. $SetBasicAuthenticate
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        return $response;
    }

    public function WS_FetchAnnouncement (){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchAnnouncement',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        return $response;
    }

    public function WS_FetchSettings  (){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchSettings',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        return $response;
    }

    public function WS_FetchCharts (){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchCharts&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        return $response;
    }

    public function WS_ParsFetchRecords ($Module , $ModuleLabel , $Page = null , $PageLimit = null , $Fields = null , $OrderBy = null , $Order = null){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=ParsFetchRecords&module='.$Module.'&moduleLabel='.$ModuleLabel.'&page='.$Page.'&pageLimit='.$PageLimit.'&fields='.$Fields.'&orderBy='.$OrderBy.'&order='.$Order.'&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response , true);
        //$response = (array)$response;
        return $response;
    }

    public function WS_FetchHistory ($Module , $Record , $Page = null , $PageLimit = null , $SelectedMode  = null){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://demopackage4.a-web.ir/MahdiSH/modules/ParsVT/ws/Portal/?operation=FetchHistory&module='.$Module.'&record='.$Record.'&page='.$Page.'&pageLimit='.$PageLimit.'&selectedMode='.$SelectedMode,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = (array)$response;
        return $response;
    }

    public function WS_FetchRelatedModules ($Module){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=FetchRelatedModules&module='.$Module,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '. $SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = (array)$response;
        return $response;
    }

    public function WS_SaveRecord ($Module , $params , $recordId = null){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
//        echo "<pre>";
//        print_r($Module);
//        print_r($params);
//        print_r($recordId);
//        echo "\n" ;
//        die('done');
        $curl = curl_init();
//die(CRM_URL.'/modules/ParsVT/ws/Portal/?operation=SaveRecord&module='.$Module.'&values='.$params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=SaveRecord&module='.$Module.'&values='.urlencode($params).'&recordId='.$recordId,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response , true);
    }

    public function ToMiladi($Date){
        $date = str_replace( '/', '-', $Date);
        $dateG = explode( '-', $date );
        $gregorian_ex   = jalali_to_gregorian($dateG[0], $dateG[1], $dateG[2] );
        $gregorian_date = implode( '-', $gregorian_ex );
        return $gregorian_date;
        //die($gregorian_date);
    }

    public function WS_FetchRecord($Module , $ID){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?module='.$Module.'&operation=FetchRecord&recordId='.$ID.'',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $response = (array)$response;
        return $response;
    }

    public function WS_AddComment($Params){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=AddComment&values='.urlencode($Params).'&parentId=',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = (array)$response;
        $response = json_decode($response[0]);
        return $response;
    }

    public function WS_FetchRelatedRecords($Relation , $ModuleName , $IdRecord){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation=FetchRelatedRecords&relatedModule='.$Relation.'&relatedModuleLabel=&page=1&pageLimit=99&module='.$ModuleName.'&recordId='.$IdRecord,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        $response = (array)$response;
        $response = json_decode($response[0]);
        return $response;
    }

    public function WS_ParsFetchRecord($ModuleName , $RecordId){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?operation=ParsFetchRecord&module='.$ModuleName.'&recordId='.$RecordId.'&parentId=&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));
        $response = curl_exec($curl);
        $response = (array)$response;
        $response = json_decode($response[0]);
        return $response;
    }

    function SaveFile($files)
    {
        if (isset($files)) {
            $data = $files['tmp_name'];
            $file_name = $files['name'];
            if (!file_exists(dirname(__FILE__).'/storage')) {
                mkdir(dirname(__FILE__).'/storage', 0777, true);
            } else {
                move_uploaded_file("$data", dirname(__FILE__).'/storage/' . $file_name);
            }

            $bin_string = file_get_contents(dirname(__FILE__).'/storage/' . $file_name);
            $base64 = base64_encode($bin_string);
        }
        $post = array(array(
            'name' => $file_name,
            'content' => urlencode($base64)
        ));
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation='.CUSTOM_METHOD_UPLOAD_FILE_BA64.'&files='.json_encode($post).'&format=0',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response= str_replace('bool(true)' , '' , $response);
        $response= str_replace('bool(false)' , '' , $response);
        $resultFile = json_decode($response, true);
        $file = $resultFile['result'][0];
        //echo "<pre>";die(print_r($file));
        return $file;
    }

    function SaveFileRegistration($files)
    {
        if (isset($files)) {
            $data = $files['tmp_name'];
            $file_name = $files['name'];
            if (!file_exists(dirname(__FILE__).'/storage')) {
                mkdir(dirname(__FILE__).'/storage', 0777, true);
            } else {
                move_uploaded_file("$data", dirname(__FILE__).'/storage/' . $file_name);
            }

            $bin_string = file_get_contents(dirname(__FILE__).'/storage/' . $file_name);
            $base64 = base64_encode($bin_string);
        }
        $post = array(array(
            'name' => $file_name,
            'content' => urlencode($base64)
        ));
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation='.CUSTOM_METHOD_UPLOAD_FILE_REGISTRATION.'&files='.json_encode($post).'&format=0',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $response= str_replace('bool(true)' , '' , $response);
        $response= str_replace('bool(false)' , '' , $response);
        $resultFile = json_decode($response, true);
        $file = $resultFile['result'][0];
        //echo "<pre>";die(print_r($file));
        return $file;
    }

    function SaveMultiFile($files)
    {
        if (isset($files)) {
            $i = 0;
            $ArrayInfo = array();
            foreach ($files['name'] as $file) {
                if (!empty($file)) {
                    $info['name'] = $file;
                    $info['type'] = $files['type'][$i];
                    $info['tmp_name'] = $files['tmp_name'][$i];
                    $info['error'] = $files['error'][$i];
                    $info['size'] = $files['size'][$i];
                    array_push($ArrayInfo, $info);
                }
                $i++;
            }
            //echo "<pre>";die(print_r($ArrayInfo));
            $MainParams = array();
            foreach ($ArrayInfo as $arr) {
                $data = $arr['tmp_name'];
                $file_name = $arr['name'];
                move_uploaded_file("$data", dirname(__FILE__) . '/storage/' . $file_name);
                $bin_string = file_get_contents(dirname(__FILE__) . '/storage/' . $file_name);
                $base64 = base64_encode($bin_string);

                $Param = array(
                    'name' => $file_name,
                    'content' => urlencode($base64)
                );
                $Param = json_encode($Param);
                array_push($MainParams, $Param);
            }
            $Param = implode(",", $MainParams);
        }
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation='.CUSTOM_METHOD_UPLOAD_FILE_BA64.'&files=[' . $Param . ']&format=0',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo "<pre>";print_r($response);
        $response= str_replace('bool(true)' , '' , $response);
        $response= str_replace('bool(false)' , '' , $response);
        $resultFile = json_decode($response);
        $file = $resultFile->result;
        $file = implode('||' , $file);
        if ($file){
            $file = '||' . $file;
        }else{
            $file = 'no';
        }
        return $file;
    }

    function SaveMultiFileRegistration($files)
    {
        if (isset($files)) {
            $i = 0;
            $ArrayInfo = array();
            foreach ($files['name'] as $file) {
                if (!empty($file)) {
                    $info['name'] = $file;
                    $info['type'] = $files['type'][$i];
                    $info['tmp_name'] = $files['tmp_name'][$i];
                    $info['error'] = $files['error'][$i];
                    $info['size'] = $files['size'][$i];
                    array_push($ArrayInfo, $info);
                }
                $i++;
            }
            $MainParams = array();
            foreach ($ArrayInfo as $arr) {
                $data = $arr['tmp_name'];
                $file_name = $arr['name'];
                move_uploaded_file("$data", dirname(__FILE__) . '/storage/' . $file_name);
                $bin_string = file_get_contents(dirname(__FILE__) . '/storage/' . $file_name);
                $base64 = base64_encode($bin_string);

                $Param = array(
                    'name' => $file_name,
                    'content' => urlencode($base64)
                );
                $Param = json_encode($Param);
                array_push($MainParams, $Param);
            }
            $Param = implode(",", $MainParams);
        }
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation='.CUSTOM_METHOD_UPLOAD_FILE_REGISTRATION.'&files=[' . $Param . ']&format=0',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response= str_replace('bool(true)' , '' , $response);
        $response= str_replace('bool(false)' , '' , $response);
        $resultFile = json_decode($response);
        $file = $resultFile->result;
        $file = implode('||' , $file);
        if ($file){
            $file = '||' . $file;
        }else{
            $file = 'no';
        }
        return $file;
    }

    public function WS_Custom_ModComments($Value , $files){
        if (isset($files) && $files != null) {
            $i = 0;
            $ArrayInfo = array();
            foreach ($files['name'] as $file) {
                if (!empty($file)) {
                    $info['name'] = $file;
                    $info['type'] = $files['type'][$i];
                    $info['tmp_name'] = $files['tmp_name'][$i];
                    $info['error'] = $files['error'][$i];
                    $info['size'] = $files['size'][$i];
                    array_push($ArrayInfo, $info);
                }
                $i++;
            }
            $MainParams = array();
            foreach ($ArrayInfo as $arr) {
                $data = $arr['tmp_name'];
                $file_name = $arr['name'];
                move_uploaded_file("$data", dirname(__FILE__) . '/storage/' . $file_name);
                $bin_string = file_get_contents(dirname(__FILE__) . '/storage/' . $file_name);
                $base64 = base64_encode($bin_string);

                $Param = array(
                    'name' => $file_name,
                    'content' => urlencode($base64)
                );
                $Param = json_encode($Param);
                array_push($MainParams, $Param);
            }
            $Param = implode(",", $MainParams);
        }
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation='.CUSTOM_METHOD_ADD_COMMENT_BA64.'&values='.$Value.'&files=['.$Param.']',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate,
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = (array)$response;
        $response = json_decode($response[0]);
        return $response;
    }

    public function WS_Custom_ParsFetchRecord($Module , $ID){
        $SetBasicAuthenticate = $this->base64_encode($_SESSION['username']  , $_SESSION['password']);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/?module='.$Module.'&operation='.CUSTOM_METHOD_PARS_FETCH_RECORD.'&recordId='.$ID.'&language='.$_SESSION['Type_Language'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic '.$SetBasicAuthenticate
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response , true);
        return $response;
    }

    public function WS_Register($Params){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => CRM_URL.'/modules/ParsVT/ws/Portal/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'operation=Register&'.$Params,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response , true);

        return $response;
    }
}