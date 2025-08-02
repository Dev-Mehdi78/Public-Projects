<?php

/* +**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * Managed development for the customer portal By Mahdi
 * ********************************************************************************** */
include_once "modules/ParsVTPortal/api/Custom_uploadbase64file.php";
require_once('modules/ModComments/ModComments.php');
require_once 'data/CRMEntity.php';
include_once "modules/Mobile/api/ws/Utils.php";

class ParsVTPortal_Custom_ModComments extends ParsVTPortal_API_Abstract {

    function process(ParsVTPortal_API_Request $request) {
        global $adb, $log;
        if (!vtlib_isModuleActive('ModComments')) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,
                "ModComments is not active!");
        }
        $types = vtws_listtypes(null, $user);
        if(!in_array('ModComments',$types['types'])){
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to ModComments is denied");
        }

        if (!isset($entityvalues['related_to'])) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Missing related_to field");
        }
        if (!isset($entityvalues['commentcontent'])) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Missing commentcontent field");
        }

        $ownerid = false;
        if (isset($entityvalues['customer'])) {
            $id = $entityvalues['customer'];
            $idComponents = vtws_getIdComponents($id);
            $webserviceObject2 = VtigerWebserviceObject::fromId($adb,$id);
            $handlerPath2 = $webserviceObject2->getHandlerPath();
            $handlerClass2 = $webserviceObject2->getHandlerClass();

            require_once $handlerPath2;

            $handler2 = new $handlerClass2($webserviceObject2,$user,$adb,$log);
            $meta2 = $handler2->getMeta();
            $entityName2 = $meta2->getObjectEntityName($id);
            if(!in_array($entityName2,$types['types'])){
                throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to perform the operation is denied");
            }
            //        if($entityName2 != 'Contacts'){
            //            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Target module must be Contacts");
            //        }

            $ownerid = $idComponents[1];
        }

        $id = $entityvalues['related_to'];
        $idComponents = vtws_getIdComponents($id);
        $webserviceObject = VtigerWebserviceObject::fromId($adb, $id);
        $handlerPath = $webserviceObject->getHandlerPath();
        $handlerClass = $webserviceObject->getHandlerClass();

        require_once $handlerPath;

        $handler = new $handlerClass($webserviceObject, $user, $adb, $log);
        $meta = $handler->getMeta();
        $entityName = $meta->getObjectEntityName($id);
        if (!in_array($entityName, $types['types'])) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "Permission to perform the operation is denied");
        }
        $modCommentsModule = Vtiger_Module::getInstance('ModComments');
        $modCommentsRelatedToField = Vtiger_Field::getInstance('related_to', $modCommentsModule);

        if (!$modCommentsRelatedToField) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "Permission to perform the operation is denied");
        }

        $checkres = $adb->pquery('SELECT * FROM vtiger_fieldmodulerel WHERE fieldid=? AND module=? AND relmodule=?',
            Array($modCommentsRelatedToField->id, 'ModComments', $entityName));

        if(!$adb->num_rows($checkres)) {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "There are no relation between ModComments and ".$entityName);
        }


        $related_to = $idComponents[1];
        $note = $entityvalues['commentcontent'];
        $parent_comments = (isset($entityvalues['parent_comments']) ? $entityvalues['parent_comments'] : 0);
        $from_portal = (isset($entityvalues['from_portal']) && $entityvalues['from_portal'] == 1 ? 1 : 0);

        if ($parent_comments) {
            if ((strpos($parent_comments, "x")) !== false) {
                $parent_comments = substr($parent_comments, strpos($parent_comments, "x") + 1);
            }
            $sql = "SELECT 1 FROM vtiger_modcomments WHERE vtiger_modcomments.modcommentsid= ? AND vtiger_modcomments.related_to =? limit 1";
            $checkres2 = $adb->pquery($sql, array($parent_comments, $related_to));
            if(!$adb->num_rows($checkres)) $parent_comments = 0;
        }
        $attachid = false;
        $uploadresult = false;
        if (!empty($files) && is_array($files)) {
            if (isset($files['name'], $files['content'])) {
                $uploadresult = vtws_uploadbase64file(array($files), 'true', $user);
            } elseif (isset($files[0]['name'], $files[0]['content'])) {
                $uploadresult = vtws_uploadbase64file(array($files[0]), 'true', $user);
            }
        } elseif (!empty($_FILES)) {
            $uploadresult = vtws_uploadfile('true', $user);
        }
        if ($uploadresult) {
            $currentUser = Users_Record_Model::getCurrentUserModel();
            $attachid = $uploadresult[0];
            $fileName = $uploadresult[1];
            $filetype = $uploadresult[4];
            $uploadPath = $uploadresult[5];
            $description = $fileName;
            $date_var = $adb->formatDate(date('YmdHis'), true);
            $usetime = $adb->formatDate($date_var, true);

            $adb->pquery("INSERT INTO vtiger_crmentity(crmid, smcreatorid, smownerid,
                  modifiedby, setype, description, createdtime, modifiedtime, presence, deleted)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",
                Array($attachid, $user->id,  $user->id,  $user->id, "ModComments Attachment", $description, $usetime, $usetime, 1, 0));

            $adb->pquery("INSERT INTO vtiger_attachments SET attachmentsid=?, name=?, description=?, type=?, path=?",
                Array($attachid, $fileName, $description, $filetype, $uploadPath));

        }

        $commentFocus = new ModComments();
        $commentFocus->column_fields['commentcontent'] = $note;
        $commentFocus->column_fields['related_to'] = $related_to;
        $commentFocus->column_fields['parent_comments'] = $parent_comments;
        $commentFocus->column_fields['assigned_user_id'] = $user->id;
        $commentFocus->column_fields['from_portal'] = $from_portal;
        $commentFocus->column_fields['userid'] = $user->id;
        if ($ownerid) {
            $commentFocus->column_fields['customer'] = $ownerid;
        }
        $commentFocus->column_fields['source'] = 'WebService';
        $commentFocus->saveentity('ModComments');
        $commentFocusId = $commentFocus->id;

        if ($attachid) {
            $adb->pquery("INSERT INTO vtiger_seattachmentsrel(crmid, attachmentsid) VALUES(?,?)",
                Array($commentFocusId, $attachid));
        }
        $response = new ParsVTPortal_API_Response();
        $response->setResult('mamad');
        return $response;
    }

    function vtws_add_modcomment($modulename, $user) {
        global $adb, $log;


        if (!Vtiger_Functions::userIsAdministrator($user)) {
            throw new WebServiceException(WebServiceErrorCode::$AUTHFAILURE,"Operation Need Admin Access");
        }

        $types = vtws_listtypes(null, $user);
        if(!in_array($modulename,$types['types'])){
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to perform the operation is denied");
        }
        if (isset($types['information'][$modulename]['isEntity']) && ($types['information'][$modulename]['isEntity'] == true || $types['information'][$modulename]['isEntity'] == 'true')) {
            require_once 'vtlib/Vtiger/Module.php';
            require_once 'modules/ModComments/ModComments.php';
            $moduleinstance = Vtiger_Module::getInstance($modulename);
            require_once 'modules/ModComments/ModComments.php';
            $commentsmodule =  Vtiger_Module::getInstance( 'ModComments' );
            $fieldinstance = Vtiger_Field::getInstance( 'related_to', $commentsmodule );
            $fieldinstance->setRelatedModules( array($modulename) );
            $detailviewblock = ModComments::addWidgetTo( $modulename );
            return true;
        } else {
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, $modulename ."is not entity module!");
        }

    }

    function vtws_retrieve_recentcomments ($record, $limit = 10, $page = 1, $user) {
        global $adb, $log, $current_user, $site_URL;
        $current_user = $user;
        vtws_preserveGlobal('current_user', $user);


        if (!is_numeric($limit) || $limit >= 100) {
            $limit = 10;
        }
        if (!is_numeric($page) || $page >= 100) {
            $page = 1;
        }

        $id = $record;
        $idComponents = vtws_getIdComponents($id);
        $webserviceObject = VtigerWebserviceObject::fromId($adb,$id);
        $handlerPath = $webserviceObject->getHandlerPath();
        $handlerClass = $webserviceObject->getHandlerClass();
        require_once $handlerPath;
        $handler = new $handlerClass($webserviceObject,$user,$adb,$log);
        $meta = $handler->getMeta();
        $moduleName = $meta->getObjectEntityName($id);
        $types = vtws_listtypes(null, $user);
        if(!in_array($moduleName,$types['types'])){
            throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED,"Permission to perform the operation is denied");
        }
        $recordId = $idComponents[1];

        $parentId = $recordId;
        $pageNumber = $page;

        $currentUserModel = Users_Record_Model::getCurrentUserModel();

        if(empty($pageNumber)) {
            $pageNumber = 1;
        }

        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);
        if(!empty($limit)) {
            $pagingModel->set('limit', $limit);
        }


        $rollupsettings = ModComments_Module_Model::getRollupSettingsForUser($currentUserModel, $moduleName);
        if($moduleName != 'HelpDesk' && $rollupsettings['rollup_status']) {
            $pageLimit = ($pageNumber - 1) * $limit;
            $parentRecordModel = Vtiger_Record_Model::getInstanceById($parentId, $moduleName);
            $recentComments = $parentRecordModel->getRollupCommentsForModule($pageLimit, $limit);
        }else {
            $recentComments = ModComments_Record_Model::getRecentComments($parentId, $pagingModel);
        }

        $pagingModel->calculatePageRange($recentComments);
        if ($pagingModel->get('limit') < ParsVT_Module_Model::php7_count($recentComments)) {
            array_pop($recentComments);
        }

        $modCommentsModel = Vtiger_Module_Model::getInstance('ModComments');
        $fileNameFieldModel = Vtiger_Field::getInstance("filename", $modCommentsModel);
        $fileFieldModel = Vtiger_Field_Model::getInstanceFromFieldObject($fileNameFieldModel);
        $COMMENTS_COUNT = ParsVT_Module_Model::php7_count($recentComments);
        $response = array();
        foreach ($recentComments as $index => $COMMENT) {
            $CREATOR_NAME  = decode_html($COMMENT->getCommentedByName());
            $is_private = $COMMENT->get('is_private');
            $is_customer = $COMMENT->get('customer');
            $PARENT_COMMENT_MODEL =$COMMENT->getParentCommentModel();
            $CHILD_COMMENTS_MODEL  =$COMMENT->getChildComments();
            $commentid = $COMMENT->getId();
            $parent_comments = $COMMENT->get('parent_comments');
            $related_to = $COMMENT->get('related_to');
            $getImagePath = $COMMENT->getImagePath();
            $IMAGE_PATH = ( !empty($getImagePath) ? ParsVT_App_Helper::site_url_fixer($site_URL).$COMMENT->getImagePath() : "");
            $CommentedTime = $COMMENT->getCommentedTime();
            $ModifiedTime = $COMMENT->getModifiedTime();
            $COMMENT_CONTENT  =nl2br($COMMENT->get('commentcontent'));
            $FILE_DETAILS =$COMMENT->getFileNameAndDownloadURL();
            $files = array();
            foreach ($FILE_DETAILS as $key => $FILE_DETAIL){
                $fileid = $FILE_DETAIL['attachmentId'];
                $filename = $FILE_DETAIL['rawFileName'];
                $id = ParsVT_App_Helper::getWSEntityId('ModComments') . $COMMENT->getId();
                $files[] = array(
                    'fileid' => ParsVT_WebService_Model::getEntityModuleWSId('ModComments') . 'x' .$commentid,
                    'wsid' => $fileid,
                    'filename' => $filename,
                    'fileurl' => isset($FILE_DETAIL['attachmentId']) ? ParsVT_App_Helper::site_url_fixer($site_URL).'modules/ParsVT/ws/API/V2/Tools/Retrieve/GetFile?file_id='.ParsVT_WebService_Model::encode_id($id) : null,
                );
            }
            $sql = "SELECT setype FROM vtiger_crmentity WHERE vtiger_crmentity.crmid = ?";
            $result = $adb->pquery($sql, array( $related_to));
            if ($result && $adb->num_rows($result)) {
                $setype = $adb->query_result($result, 0, 'setype');
                $related_to = ParsVT_WebService_Model::getEntityModuleWSId($setype) . 'x' .$related_to;
            }
            $response[] = array(
                'id' => ParsVT_WebService_Model::getEntityModuleWSId('ModComments') . 'x' .$commentid,
                'creator_name' => $CREATOR_NAME,
                'is_private' => $is_private,
                'from_customer' => $is_customer,
                'parent' => ($parent_comments != 0 ? ParsVT_WebService_Model::getEntityModuleWSId('ModComments') . 'x' .$parent_comments : 0),
                'related_to' => $related_to,
                'image_path' => $IMAGE_PATH,
                'createdtime' => $CommentedTime,
                'modifiedtime' => $ModifiedTime,
                'content' => $COMMENT_CONTENT,
                'files' => $files,
            );

        }
        return $response;
    }
}
