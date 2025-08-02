<?php
ini_set('display_errors','off'); error_reporting(0);

$place_config = array(
    'CRM_URL' => 'http://demopackage4.a-web.ir/MahdiSH'
);

//Get Address URL CRM
define("CRM_URL" , $place_config['CRM_URL']);

//Get Current Page
define('CURRENT_PAGE_URL' , (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

//Get Portal URL
define('PORTAL_URL' , (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]");

//Max FileSize Uploaded
$maxFileSize = '100 MB';

//Default Language
$defaultUiLanguage = array("label"=>'فارسی',"value"=>'fa_ir');
define('DEFAULT_LANGUAGE' , $defaultUiLanguage);

//Languages List Portal
$availableLanguages = array(
    array("label"=>'US English',"value"=>'en_us'),
    array("label"=>'فارسی',"value"=>'fa_ir'),
    array("label"=>'DE Deutsch',"value"=>'de_de'),
    array("label"=>'PT Brasil',"value"=>'pt_br'),
    array("label"=>'Francais',"value"=>'fr_fr'),
    array("label"=>'Turkce Dil Paketi',"value"=>'tr_tr'),
    array("label"=>'ES Spanish',"value"=>'es_es'),
    array("label"=>'简体中文',"value"=>'zh_cn'),
    array("label"=>'繁體中文',"value"=>'zh_tw'),
    array("label"=>'عربى',"value"=>'ar_ae'),
    array("label" => 'NL Dutch', "value" => 'nl_nl'),
    array("label"=>'PT Portuguese',"value"=>'pt_pt')
);
define('LANGUAGE_LIST' , $availableLanguages);

//Default Date Type
$defaultUiCalendar  = 'jalali';
define('DEFAULT_DATE_TYPE' , $defaultUiCalendar);

//Date Type List
$availableCalendars = array(
    array("label"=>($defaultUiLanguage['value'] == 'fa_ir' ? 'Gregorian' : 'Gregorian') ,"value"=>'gregorian'),
    array("label"=>($defaultUiLanguage['value'] == 'fa_ir' ? 'Jalali' : 'Jalali'),"value"=>'jalali'),
);


define('DATE_TYPE_LIST' , $availableCalendars);

define('CUSTOM_METHOD_UPLOAD_FILE_BA64' , 'Custom_uploadbase64file');
define('CUSTOM_METHOD_UPLOAD_FILE_REGISTRATION' , 'Custom_uploadbase64fileRegistration');
define('CUSTOM_METHOD_ADD_COMMENT_BA64' , 'Custom_ModComments');
define('CUSTOM_METHOD_PARS_FETCH_RECORD' , 'Custom_ParsFetchRecord');
define('CUSTOM_METHOD_ATTACHFILE' , 'Custom_DownloadAttach');


