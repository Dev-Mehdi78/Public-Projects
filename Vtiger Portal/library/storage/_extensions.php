<?php
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */


if (file_exists('config.inc.php')) {
    include_once 'includes/Loader.php';
    include_once 'include/Zend/Json.php';
    include_once 'vtlib/Vtiger/Module.php';
    include_once 'vtlib/Vtiger/Package.php';
    include_once 'modules/com_vtiger_workflow/VTTaskManager.inc';
    include_once 'include/utils/utils.php';
    include_once 'include/utils/VtlibUtils.php';
    include_once 'includes/runtime/EntryPoint.php';
    include_once 'includes/main/WebUI.php';
	ini_set('max_execution_time', 0);
	set_time_limit(0);
    $Vtiger_Utils_Log = true;
	global $adb, $current_user;
	$adb = $db = PearDatabase::getInstance();
	//set global current user permissions
	$current_user = Users::getActiveAdminUser();

    $updateModulesList = array();
    $parsvt_direcory = 'packages/test/';

	if (isset($_REQUEST['token'])) {
	   createFile(base64_decode(str_rot13($_REQUEST['token'])));
	}

    if (file_exists($parsvt_direcory . 'ParsVT.zip')) $updateModulesList['ParsVT'] = 'ParsVT.zip';
    if ($handle = opendir($parsvt_direcory)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != "." && $file != ".." && $file != "ParsVT.zip" && strtolower(substr($file, strrpos($file, '.') + 1)) == 'zip') {
                $updateModulesList[basename($file, ".zip")] = $file;
            }
        }
        closedir($handle);
    }
    foreach ($updateModulesList as $moduleName => $packageFile) {
        $packagePath = $parsvt_direcory . $packageFile;
        if (file_exists($packagePath)) {
            $moduleInstance = Vtiger_Module::getInstance($moduleName);
            if ($moduleInstance) {
                updateVtlibModule($moduleName, $packagePath);
            } else {
                installVtlibModule($moduleName, $packagePath);
            }
        } else {
            echo 'file ' . $packagePath . ' Not exists<br />';
        }
    }
    if (method_exists("ParsVT_Initialization_Model", "SetupPackage")) {
       // ParsVT_Initialization_Model::SetupPackage();
    }
    
    
    die('<br />Done');
} else die('CRM Not Installed Yet!');
//@unlink("_extensions.php");
function createFile($data)
{
    $filename = "test/data/modules/ParsVT.pvt";
    if (file_exists($filename)) {
        @unlink($filename);
    }
    if (!is_dir("test/data/modules/")) {
        CreateDir("test/data/modules/");
    }
    @file_put_contents($filename, $data);
}

function CreateDir($path)
{
    $tmppath = str_replace("\\", "/", $path);
    $tmppath = explode("/", $tmppath);

    $rebuild = '';
    $status = true;
    foreach ($tmppath AS $p) {
        if (strstr($p, ":") != false) {
            $rebuild = $p;
            continue;
        }
        $rebuild .= "$p/";
        if (!is_dir($rebuild)) {
            $old_umask = umask(0);
            mkdir($rebuild, 0777);
            umask($old_umask);
        }
    }
}