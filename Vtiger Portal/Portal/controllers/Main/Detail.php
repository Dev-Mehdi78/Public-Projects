<?php

class Detail extends Controller{
    public function __construct()
    {
        parent::__construct();
        $ModuleName = $_REQUEST['module'];
        $IDRecord   = $_REQUEST['record'];
        $DetailRecord = $this->model->WS_Custom_ParsFetchRecord($ModuleName , $IDRecord);
        if ($DetailRecord['success'] === true){
            $DetailRecord = $DetailRecord['result'];
            if (isset($_REQUEST['AddedComments'])){
                $ParamsComments = array(
                    "commentcontent" => $_REQUEST['CommentDescription'],
                    "related_to"     => $_REQUEST['record'],
                );
                $JsonParamsComments  =  json_encode($ParamsComments);
                if (isset($_FILES['UploadedFileComment']) && $_FILES['UploadedFileComment']['name'][0] != '' ){
                    $AttachmentFile  = $_FILES['UploadedFileComment'];
                }else{
                    $AttachmentFile  = null;
                }
                $AddedComments       = $this->model->WS_Custom_ModComments($JsonParamsComments , $AttachmentFile);

                if ($AddedComments->success === true){
                    header('Location: index.php?page=Main&module='.$ModuleName.'&view=Detail&record='.$IDRecord.'&Message=S OperationSuccess');
                }else{
                    header('Location: index.php?page=Main&module='.$ModuleName.'&view=Detail&record='.$IDRecord.'&Message=E OperationError');
                }
            }else {
                $this->view->RenderPage('Main/Detail', array('DetailRecord' => $DetailRecord),array());
            }
        }else{
            header("location: index.php?page=Main&module=".$ModuleName."&view=List&Message=E An Error Was Detected On The webservice Side");
        }
    }
}
$t = new Detail();