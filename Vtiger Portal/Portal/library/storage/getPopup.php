<?php

include_once "modules/ParsVT/V2/Webservices/FileRetrieve.php";
include_once "modules/ParsVT/V2/Webservices/Mobile.php";
function vtws_parsvt_getpopup($elementType, $params, $user)
{
    global $current_user;
    $current_user = $user;
    $types = vtws_listtypes(null, $user);
    if (!in_array($elementType, $types['types'])) {
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "Permission to perform the operation is denied");
    }

    $REQUEST = array(
        'module' => $elementType,
    );
    /*
    $params = array(
        'src_module' => 'Invoice',
        'multi_select' => true,
        'parent_id' => null,
        'currency_id' => 3,
        'search_params' => '[[["productname","c","کالای تست"]]]'
    );
    */

    if (!isset($params['src_module'])) {
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "Missing src_module params");
    } else if (!in_array($params['src_module'], $types['types'])) {
        throw new WebServiceException(WebServiceErrorCode::$ACCESSDENIED, "Permission to perform the operation is denied");
    }
    foreach ($params as $key => $value) {
        $REQUEST[$key] = $value;
    }
    foreach ($REQUEST as $key => &$item) {
        if (is_array($item)) {
            $item = json_encode($item);
        }

    }
    $request = new Vtiger_Request($REQUEST, $REQUEST);
    $MobileApp_Popup = new MobileApp_Popup;
    $results = $MobileApp_Popup->process($request);
    return $results;
}


class MobileApp_Popup extends Inventory_ProductsPopup_View
{


    function checkPermission(Vtiger_Request $request)
    {
    }

    function postProcess(Vtiger_Request $request)
    {
    }

    function preProcess(Vtiger_Request $request, $display = true)
    {

    }

    function getModule(Vtiger_request $request)
    {
        $moduleName = $request->getModule();
        return $moduleName;
    }


    function process(Vtiger_Request $request)
    {
        $moduleName = $request->getModule();
        if ($moduleName == 'Products' || $moduleName == 'Services') {
            $response = $this->initializeProductListViewContents($request);
        } elseif ($moduleName == 'PriceBooks') {
            $response = $this->initializePriceBookListViewContents($request);
        } else {
            $response = $this->initializeVtigerListViewContents($request);
        }
        return $response;
    }


    public function initializeProductListViewContents(Vtiger_Request $request)
    {
        $user = VTWS_PreserveGlobal::getGlobal('current_user');
        $response = array();
        //src_module value is added to just to stop showing inactive products
        $request->set('src_module2', $request->get('src_module'));
        $request->set('src_module', $request->getModule());

        $moduleName = $this->getModule($request);
        $cvId = $request->get('cvid');
        $pageNumber = $request->get('page');
        $orderBy = $request->get('orderby');
        $sortOrder = $request->get('sortorder');
        $sourceModule = $request->get('src_module');
        $sourceField = $request->get('src_field');
        $sourceRecord = $request->get('src_record');
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
        $currencyId = $request->get('currency_id');
        $searchParams = $request->get('search_params');
        //To handle special operation when selecting record from Popup
        $getUrl = $request->get('get_url');
        $relationId = $request->get('relationId');
        $fieldList = vtws_parsvt_describe($moduleName, $user);




        $requestParams = array(
            'cvid' => $request->get('cvid'),
            'page' => $request->get('page'),
            'orderby' => $request->get('orderby'),
            'sortorder' => $request->get('sortorder'),
            'src_module' => $request->get('src_module2'),
            'src_field' => $request->get('src_field'),
            'src_record' => $request->get('src_record'),
            'search_key' => $request->get('search_key'),
            'search_value' => $request->get('search_value'),
            'currency_id' => $request->get('currency_id'),
            'search_params' => $request->get('search_params'),
            'get_url' => $request->get('get_url'),
            'relationId' => $request->get('relationId'),
        );
        //Check whether the request is in multi select mode
        $multiSelectMode = $request->get('multi_select');
        if (empty($multiSelectMode)) {
            $multiSelectMode = false;
        }

        if (empty($cvId)) {
            $cvId = '0';
        }
        if (empty ($pageNumber)) {
            $pageNumber = '1';
        }

        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);

        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $listViewModel = Vtiger_ListView_Model::getInstanceForPopup($moduleName);
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel);

        if (!empty($orderBy)) {
            $listViewModel->set('orderby', $orderBy);
            $listViewModel->set('sortorder', $sortOrder);
        }
        if (!empty($sourceModule)) {
            $listViewModel->set('src_module', $sourceModule);
            $listViewModel->set('src_field', $sourceField);
            $listViewModel->set('src_record', $sourceRecord);
        }
        
        $listViewModel->set('relationId', $relationId);


        if (!$this->listViewHeaders) {
            $this->listViewHeaders = $listViewModel->getListViewHeaders();
        }

        $fields2 = array();
        foreach ($this->listViewHeaders as $LISTVIEW_HEADER) {
            switch ($LISTVIEW_HEADER->getFieldDataType()) {
                case 'date':
                case 'datetime':
                    $searchOperator = 'bw';
                    break;
                case 'percentage':
                case 'double':
                case 'integer':
                case 'currency':
                case 'number':
                case 'boolean':
                    $searchOperator = 'e';
                    break;
                default:
                    $searchOperator = 'c';
            }
            $fields2[$fieldName] = $searchOperator;
        }



        if (!empty($searchKey) && !empty($searchValue)) {
            if (!is_array($searchKey) && !is_array($searchValue)) {
                $listViewModel->set('search_key', $searchKey);
                $listViewModel->set('search_value', $searchValue);
                $listViewModel->set('operator', (isset($fields2[$searchKey]) ? $fields2[$searchKey] : 'c'));
            } else if (is_array($searchKey) && is_array($searchValue)) {
                $searchParams = array();
                for ($x = 0; $x < count($searchKey); $x++) {
                    if (isset($searchValue[$x])) {
                        $searchParams[] = array(
                            $searchKey[$x],
                            (isset($fields2[$searchKey[$x]]) ? $fields2[$searchKey[$x]] : 'c'),
                            $searchValue[$x],
                        );
                    }
                }
            }
            if(!empty($searchParams)){
                $searchParams = array($searchParams);
                $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $listViewModel->getModule());
                $listViewModel->set('search_params', $transformedSearchParams);
            }
    
        }



        if (!$this->listViewEntries && $moduleModel->isActive()) {
            $this->listViewEntries = $listViewModel->getListViewEntries($pagingModel);
        } else {
            $this->listViewEntries = array();
            $response['IS_MODULE_DISABLED'] = true;
        }

        foreach ($this->listViewEntries as $key => $listViewEntry) {
            $productId = $listViewEntry->getId();
            $subProducts = $listViewModel->getSubProducts($productId);
            if ($subProducts) {
                $listViewEntry->set('subProducts', $subProducts);
            }
        }

        $noOfEntries = ParsVT_Module_Model::php7_count($this->listViewEntries);

        if (empty($sortOrder)) {
            $sortOrder = "ASC";
        }
        if (empty($searchParams)) {
            $searchParams = array();
        }
        //To make smarty to get the details easily accesible
        foreach ($searchParams as $fieldListGroup) {
            foreach ($fieldListGroup as $fieldSearchInfo) {
                $fieldSearchInfo['searchValue'] = $fieldSearchInfo[2];
                $fieldSearchInfo['fieldName'] = $fieldName = $fieldSearchInfo[0];
                $fieldSearchInfo['comparator'] = $fieldSearchInfo[1];
                $searchParams[$fieldName] = $fieldSearchInfo;
            }
        }

        $fieldsInfo = $fieldList['fields'];
//        $fieldList = $moduleModel->getFields();
//        $fieldsInfo = array();
//        foreach ($fieldList as $name => $model) {
//            $fieldsInfo[] = $model->getFieldInfo();
//        }
        $response['Module'] = $moduleName;
        $response['RelatedModule'] = $moduleName;
        $response['SourceModule'] = $sourceModule;
        $response['SourceField'] = $sourceField;
        $response['SourceRecord'] = $sourceRecord;
        $response['SearchKey'] = $searchKey;
        $response['SearchValue'] = $searchValue;
        $response['OrderBy'] = $orderBy;
        $response['SortOrder'] = $sortOrder;
        $response['GetURL'] = $getUrl;
        $response['CurrencyID'] = $currencyId;
        $response['PageNumber'] = $pageNumber;
        $response['Count'] = $noOfEntries;
        $response['RelationID'] = $relationId;
        $response['SearchDetails'] = $searchParams;
        $response['PageLimit'] = $pagingModel->getPageLimit();
        $response['PageStartRange'] = $pagingModel->getRecordStartRange();
        $response['PageEndRange'] = $pagingModel->getRecordEndRange();
        $response['PreviousPageExist'] = $pagingModel->isPrevPageExists();
        $response['NextPageExist'] = $pagingModel->isNextPageExists();

        $LISTVIEW_HEADERS = $this->listViewHeaders;
        $headers = array();
        foreach ($LISTVIEW_HEADERS as $LISTVIEW_HEADER) {
            $LISTVIEW_HEADERNAME = $LISTVIEW_HEADER->get('name');
            $headers[] = array(
                'name' => $LISTVIEW_HEADERNAME,
                'column' => $LISTVIEW_HEADER->get('column'),
                'uitype' => $LISTVIEW_HEADER->get('uitype'),
                'datatype' => $LISTVIEW_HEADER->getFieldDataType(),
            );
        }
        $response['Headers'] = $headers;

        $LISTVIEW_ENTRIES = $this->listViewEntries;
        $wsmodule = ParsVT_WebService_Model::getEntityModuleWSId($moduleName) . 'x';
        $entries = $IDs = array();
        foreach ($LISTVIEW_ENTRIES as $LISTVIEW_ENTRY) {
            $raw = $LISTVIEW_ENTRY->getRawData();
            foreach ($raw as $key => $value) {
                if (is_numeric($key)) unset($raw[$key]);
            }
            $id = $LISTVIEW_ENTRY->getId();
            $IDs[] = $id;
            $user = VTWS_PreserveGlobal::getGlobal('current_user');
            $image = vtws_retrieve_image($wsmodule . $id, $user, false);
            $entry = array(
                'id' => $id,
                'wsid' => $wsmodule . $id,
                'name' => $LISTVIEW_ENTRY->getName(),
                'image' => $image,
                //'data' => $LISTVIEW_ENTRY->get('body'),
                //'taxurl' => $LISTVIEW_ENTRY->getTaxesURL(),
            );
            foreach ($raw as $key => $value) {
                $entry[$key] = $value;
            }
            $params = array(
                "module" => "PriceBooks",
                "src_module" => $sourceModule,
                "src_field" => ($sourceModule == "Products" ? "productid" : "serviceid"),
                "src_record" => $id,
                "get_url" => "getProductListPriceURL",
                "currency_id" => $currencyId,
                "view" => "Popup",
            );
            $entry['pricebook'] = $this->getPricebook($params);
            $entries[] = $entry;
        }
        $response['Records'] = empty($entries) || !is_array($entries) ? [] : $entries;
        $response['Taxes'] = $this->getTaxes($IDs, $currencyId);

        $response['Fields'] = $fieldsInfo;


        if (PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false)) {
            if (!$this->listViewCount) {
                $this->listViewCount = $listViewModel->getListViewCount();
            }
            $totalCount = $this->listViewCount;
            $pageLimit = $pagingModel->getPageLimit();
            $pageCount = ceil((int)$totalCount / (int)$pageLimit);

            if ($pageCount == 0) {
                $pageCount = 1;
            }
            $response['PageCount'] = $pageCount;
            $response['TotalCount'] = $totalCount;

        }

        //$response['requestParams'] = json_encode($requestParams,JSON_PRETTY_PRINT );
        $response['requestParams'] = $requestParams;
        return $response;
    }

    public function initializeVtigerListViewContents(Vtiger_Request $request)
    {
        $user = VTWS_PreserveGlobal::getGlobal('current_user');
        $moduleName = $this->getModule($request);
        $cvId = $request->get('cvid');
        $pageNumber = $request->get('page');
        $orderBy = $request->get('orderby');
        $sortOrder = $request->get('sortorder');
        $sourceModule = $request->get('src_module');

        $sourceField = $request->get('src_field');
        $sourceRecord = $request->get('src_record');
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
        $currencyId = $request->get('currency_id');
        $relatedParentModule = $request->get('related_parent_module');
        $relatedParentId = $request->get('related_parent_id');
        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $searchParams = $request->get('search_params');

        $relationId = $request->get('relationId');

        //To handle special operation when selecting record from Popup
        $getUrl = $request->get('get_url');

        $requestParams = array(
            'cvid' => $request->get('cvid'),
            'page' => $request->get('page'),
            'orderby' => $request->get('orderby'),
            'sortorder' => $request->get('sortorder'),
            'src_module' => $request->get('src_module'),
            'src_field' => $request->get('src_field'),
            'src_record' => $request->get('src_record'),
            'search_key' => $request->get('search_key'),
            'search_value' => $request->get('search_value'),
            'currency_id' => $request->get('currency_id'),
            'search_params' => $request->get('search_params'),
            'get_url' => $request->get('get_url'),
            'relationId' => $request->get('relationId'),
        );

        $fieldList = vtws_parsvt_describe($moduleName, $user);

        $autoFillModule = $moduleModel->getAutoFillModule($moduleName);

        //Check whether the request is in multi select mode
        $multiSelectMode = $request->get('multi_select');
        if (empty($multiSelectMode)) {
            $multiSelectMode = false;
        }

        if (empty($getUrl) && !empty($sourceField) && !empty($autoFillModule) && !$multiSelectMode) {
            $getUrl = 'getParentPopupContentsUrl';
        }

        if (empty($cvId)) {
            $cvId = '0';
        }
        if (empty ($pageNumber)) {
            $pageNumber = '1';
        }

        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);

        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel);

        $isRecordExists = Vtiger_Util_Helper::checkRecordExistance($relatedParentId);

        if ($isRecordExists) {
            $relatedParentModule = '';
            $relatedParentId = '';
        } else if ($isRecordExists === NULL) {
            $relatedParentModule = '';
            $relatedParentId = '';
        }

        if (!empty($relatedParentModule) && !empty($relatedParentId)) {
            $parentRecordModel = Vtiger_Record_Model::getInstanceById($relatedParentId, $relatedParentModule);
            $listViewModel = Vtiger_RelationListView_Model::getInstance($parentRecordModel, $moduleName, $label, $relationId);
            $searchModuleModel = $listViewModel->getRelatedModuleModel();
        } else {
            $listViewModel = Vtiger_ListView_Model::getInstanceForPopup($moduleName);
            $searchModuleModel = $listViewModel->getModule();
        }

        if ($moduleName == 'Documents' && $sourceModule == 'Emails') {
            $listViewModel->extendPopupFields(array('filename' => 'filename'));
        }
        if (!empty($orderBy)) {
            $listViewModel->set('orderby', $orderBy);
            $listViewModel->set('sortorder', $sortOrder);
        }
        if (!empty($sourceModule)) {
            $listViewModel->set('src_module', $sourceModule);
            $listViewModel->set('src_field', $sourceField);
            $listViewModel->set('src_record', $sourceRecord);
        }

        if (!empty($searchKey) && !empty($searchValue)) {
            if (!is_array($searchKey) && !is_array($searchValue)) {
                $listViewModel->set('search_key', $searchKey);
                $listViewModel->set('search_value', $searchValue);
                $listViewModel->set('operator', (isset($fields2[$searchKey]) ? $fields2[$searchKey] : 'c'));
            } else if (is_array($searchKey) && is_array($searchValue)) {
                $searchParams = array();
                for ($x = 0; $x < count($searchKey); $x++) {
                    if (isset($searchValue[$x])) {
                        $searchParams[] = array(
                            $searchKey[$x],
                            (isset($fields2[$searchKey[$x]]) ? $fields2[$searchKey[$x]] : 'c'),
                            $searchValue[$x],
                        );
                    }
                }
            }
            if(!empty($searchParams)){
                $searchParams = array($searchParams);
                $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $listViewModel->getModule());
                $listViewModel->set('search_params', $transformedSearchParams);
            }

        }


//        if ((!empty($searchKey)) && (!empty($searchValue))) {
//            $listViewModel->set('search_key', $searchKey);
//            $listViewModel->set('search_value', $searchValue);
//        }
        $listViewModel->set('relationId', $relationId);

        if (!empty($searchParams)) {
            $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $searchModuleModel);
            $listViewModel->set('search_params', $transformedSearchParams);
        }
        if (!empty($relatedParentModule) && !empty($relatedParentId)) {
            $this->listViewHeaders = $listViewModel->getHeaders();

            $models = $listViewModel->getEntries($pagingModel);
            $noOfEntries = ParsVT_Module_Model::php7_count($models);
            foreach ($models as $recordId => $recordModel) {
                foreach ($this->listViewHeaders as $fieldName => $fieldModel) {
                    $recordModel->set($fieldName, $recordModel->getDisplayValue($fieldName));
                }
                $models[$recordId] = $recordModel;
            }
            $this->listViewEntries = $models;
            if (ParsVT_Module_Model::php7_count($this->listViewEntries) > 0) {
                $parent_related_records = true;
            }
        } else {
            $this->listViewHeaders = $listViewModel->getListViewHeaders();
            $this->listViewEntries = $listViewModel->getListViewEntries($pagingModel);
        }

        // If there are no related records with parent module then, we should show all the records
        if (!$parent_related_records && !empty($relatedParentModule) && !empty($relatedParentId)) {
            $relatedParentModule = null;
            $relatedParentId = null;
            $listViewModel = Vtiger_ListView_Model::getInstanceForPopup($moduleName);

            if (!empty($orderBy)) {
                $listViewModel->set('orderby', $orderBy);
                $listViewModel->set('sortorder', $sortOrder);
            }
            if (!empty($sourceModule)) {
                $listViewModel->set('src_module', $sourceModule);
                $listViewModel->set('src_field', $sourceField);
                $listViewModel->set('src_record', $sourceRecord);
            }
            if ((!empty($searchKey)) && (!empty($searchValue))) {
                $listViewModel->set('search_key', $searchKey);
                $listViewModel->set('search_value', $searchValue);
            }

            if (!empty($searchParams)) {
                $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $searchModuleModel);
                $listViewModel->set('search_params', $transformedSearchParams);
            }
            $this->listViewHeaders = $listViewModel->getListViewHeaders();
            $this->listViewEntries = $listViewModel->getListViewEntries($pagingModel);
        }
        // End
        if (empty($searchParams)) {
            $searchParams = array();
        }
        //To make smarty to get the details easily accesible
        foreach ($searchParams as $fieldListGroup) {
            foreach ($fieldListGroup as $fieldSearchInfo) {
                $fieldSearchInfo['searchValue'] = $fieldSearchInfo[2];
                $fieldSearchInfo['fieldName'] = $fieldName = $fieldSearchInfo[0];
                $fieldSearchInfo['comparator'] = $fieldSearchInfo[1];
                $searchParams[$fieldName] = $fieldSearchInfo;
            }
        }

        $noOfEntries = ParsVT_Module_Model::php7_count($this->listViewEntries);

        if (empty($sortOrder)) {
            $sortOrder = "ASC";
        }

        $fieldsInfo = $fieldList['fields'];
//        $fieldList = $moduleModel->getFields();
//        foreach ($fieldList as $name => $model) {
//            $fieldsInfo[] = $model->getFieldInfo();
//        }
        $response['Module'] = $moduleName;
        $response['RelatedModule'] = $moduleName;
        $response['SourceModule'] = $sourceModule;
        $response['SourceField'] = $sourceField;
        $response['SourceRecord'] = $sourceRecord;
        $response['SearchKey'] = $searchKey;
        $response['SearchValue'] = $searchValue;
        $response['OrderBy'] = $orderBy;
        $response['SortOrder'] = $sortOrder;
        $response['GetURL'] = $getUrl;
        $response['CurrencyID'] = $currencyId;
        $response['PageNumber'] = $pageNumber;
        $response['Count'] = $noOfEntries;
        $response['RelationID'] = $relationId;
        $response['SearchDetails'] = $searchParams;
        $response['PageLimit'] = $pagingModel->getPageLimit();
        $response['PageStartRange'] = $pagingModel->getRecordStartRange();
        $response['PageEndRange'] = $pagingModel->getRecordEndRange();
        $response['PreviousPageExist'] = $pagingModel->isPrevPageExists();
        $response['NextPageExist'] = $pagingModel->isNextPageExists();

        $LISTVIEW_HEADERS = $this->listViewHeaders;
        $headers = array();
        foreach ($LISTVIEW_HEADERS as $LISTVIEW_HEADER) {
            $LISTVIEW_HEADERNAME = $LISTVIEW_HEADER->get('name');
            $headers[] = array(
                'name' => $LISTVIEW_HEADERNAME,
                'column' => $LISTVIEW_HEADER->get('column'),
                'uitype' => $LISTVIEW_HEADER->get('uitype'),
                'datatype' => $LISTVIEW_HEADER->getFieldDataType(),
            );
        }
        $response['Headers'] = $headers;

        $LISTVIEW_ENTRIES = $this->listViewEntries;
        $wsmodule = ParsVT_WebService_Model::getEntityModuleWSId($moduleName) . 'x';
        $entries = array();
        foreach ($LISTVIEW_ENTRIES as $LISTVIEW_ENTRY) {
            $raw = $LISTVIEW_ENTRY->getRawData();
            foreach ($raw as $key => $value) {
                if (is_numeric($key)) unset($raw[$key]);
            }
            $id = $LISTVIEW_ENTRY->getId();
            $entry = array(
                'id' => $id,
                'wsid' => $wsmodule . $id,
                'name' => $LISTVIEW_ENTRY->getName(),
                //'data' => $LISTVIEW_ENTRY->get('body'),
                //'taxurl' => $LISTVIEW_ENTRY->getTaxesURL(),
            );
            foreach ($raw as $key => $value) {
                $entry[$key] = $value;
            }
            $entries[] = $entry;
        }
        $response['Records'] = $entries;
        $response['Taxes'] = array();
        $response['Fields'] = $fieldsInfo;

        if (PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false)) {
            if (!$this->listViewCount) {
                $this->listViewCount = $listViewModel->getListViewCount();
            }
            $totalCount = $this->listViewCount;
            $pageLimit = $pagingModel->getPageLimit();
            $pageCount = ceil((int)$totalCount / (int)$pageLimit);

            if ($pageCount == 0) {
                $pageCount = 1;
            }
            $response['PageCount'] = $pageCount;
            $response['TotalCount'] = $totalCount;
        }

        $response['requestParams'] = $requestParams;
        return $response;
    }


    public function initializePriceBookListViewContents(Vtiger_Request $request, $product = false)
    {
        $user = VTWS_PreserveGlobal::getGlobal('current_user');
        $moduleName = $this->getModule($request);
        $cvId = $request->get('cvid');
        $pageNumber = $request->get('page');
        $orderBy = $request->get('orderby');
        $sortOrder = $request->get('sortorder');
        $sourceModule = $request->get('src_module');
        $sourceField = $request->get('src_field');
        $sourceRecord = $request->get('src_record');
        $searchKey = $request->get('search_key');
        $searchValue = $request->get('search_value');
        $currencyId = $request->get('currency_id');
        $searchParams = $request->get('search_params');

        $fieldList = vtws_parsvt_describe($moduleName, $user);
        //To handle special operation when selecting record from Popup
        $getUrl = $request->get('get_url');
        $relationId = $request->get('relationId');

        $requestParams = array(
            'cvid' => $request->get('cvid'),
            'page' => $request->get('page'),
            'orderby' => $request->get('orderby'),
            'sortorder' => $request->get('sortorder'),
            'src_module' => $request->get('src_module'),
            'src_field' => $request->get('src_field'),
            'src_record' => $request->get('src_record'),
            'search_key' => $request->get('search_key'),
            'search_value' => $request->get('search_value'),
            'currency_id' => $request->get('currency_id'),
            'search_params' => $request->get('search_params'),
            'get_url' => $request->get('get_url'),
            'relationId' => $request->get('relationId'),
        );
        //Check whether the request is in multi select mode
        $multiSelectMode = $request->get('multi_select');
        if (empty($multiSelectMode)) {
            $multiSelectMode = false;
        }

        if (empty($getUrl) && !empty($sourceField) && !$multiSelectMode) {
            $getUrl = 'getProductListPriceURL';
        }

        if (empty($cvId)) {
            $cvId = '0';
        }
        if (empty ($pageNumber)) {
            $pageNumber = '1';
        }

        $pagingModel = new Vtiger_Paging_Model();
        $pagingModel->set('page', $pageNumber);

        $moduleModel = Vtiger_Module_Model::getInstance($moduleName);
        $listViewModel = Vtiger_ListView_Model::getInstanceForPopup($moduleName);
        $recordStructureInstance = Vtiger_RecordStructure_Model::getInstanceForModule($moduleModel);

        if (!empty($orderBy)) {
            $listViewModel->set('orderby', $orderBy);
            $listViewModel->set('sortorder', $sortOrder);
        }
        if (!empty($sourceModule)) {
            $listViewModel->set('src_module', $sourceModule);
            $listViewModel->set('src_field', $sourceField);
            $listViewModel->set('src_record', $sourceRecord);
        }



        if (!empty($searchKey) && !empty($searchValue)) {
            if (!is_array($searchKey) && !is_array($searchValue)) {
                $listViewModel->set('search_key', $searchKey);
                $listViewModel->set('search_value', $searchValue);
                $listViewModel->set('operator', (isset($fields2[$searchKey]) ? $fields2[$searchKey] : 'c'));
            } else if (is_array($searchKey) && is_array($searchValue)) {
                $searchParams = array();
                for ($x = 0; $x < count($searchKey); $x++) {
                    if (isset($searchValue[$x])) {
                        $searchParams[] = array(
                            $searchKey[$x],
                            (isset($fields2[$searchKey[$x]]) ? $fields2[$searchKey[$x]] : 'c'),
                            $searchValue[$x],
                        );
                    }
                }
            }
            if(!empty($searchParams)){
                $searchParams = array($searchParams);
                $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $listViewModel->getModule());
                $listViewModel->set('search_params', $transformedSearchParams);
            }

        }


//        if ((!empty($searchKey)) && (!empty($searchValue))) {
//            $listViewModel->set('search_key', $searchKey);
//            $listViewModel->set('search_value', $searchValue);
//        }
        $listViewModel->set('relationId', $relationId);

        if (!empty($currencyId)) {
            $listViewModel->set('currency_id', $currencyId);
        }

        if (!empty($searchParams)) {
            $transformedSearchParams = $this->transferListSearchParamsToFilterCondition($searchParams, $listViewModel->getModule());
            $listViewModel->set('search_params', $transformedSearchParams);
        }

        if (!$this->listViewHeaders) {
            $this->listViewHeaders = $listViewModel->getListViewHeaders();
        }
        //Added to support List Price
        $field = new Vtiger_Field_Model();
        $field->set('name', 'listprice');
        $field->set('column', 'listprice');
        $field->set('label', 'List Price');

        $this->listViewHeaders['listprice'] = $field;

        if (!$this->listViewEntries) {
            $this->listViewEntries = $listViewModel->getListViewEntries($pagingModel);
        }

        foreach ($this->listViewEntries as $recordId => $recordModel) {
            $recordModel->set('listprice', $recordModel->getProductsListPrice($sourceRecord));
        }

        $noOfEntries = ParsVT_Module_Model::php7_count($this->listViewEntries);
        if (empty($searchParams)) {
            $searchParams = array();
        }
        //To make smarty to get the details easily accesible
        foreach ($searchParams as $fieldListGroup) {
            foreach ($fieldListGroup as $fieldSearchInfo) {
                $fieldSearchInfo['searchValue'] = $fieldSearchInfo[2];
                $fieldSearchInfo['fieldName'] = $fieldName = $fieldSearchInfo[0];
                $fieldSearchInfo['comparator'] = $fieldSearchInfo[1];
                $searchParams[$fieldName] = $fieldSearchInfo;
            }
        }
        if (empty($sortOrder)) {
            $sortOrder = "ASC";
        }


        $fieldsInfo = $fieldList['fields'];
//        $fieldList = $moduleModel->getFields();
//        $fieldsInfo = array();
//        foreach ($fieldList as $name => $model) {
//            $fieldsInfo[] = $model->getFieldInfo();
//        }
        if (!$product) {
            $response['Module'] = $moduleName;
            $response['RelatedModule'] = $moduleName;
            $response['SourceModule'] = $sourceModule;
            $response['SourceField'] = $sourceField;
            $response['SourceRecord'] = $sourceRecord;
            $response['SearchKey'] = $searchKey;
            $response['SearchValue'] = $searchValue;
            $response['OrderBy'] = $orderBy;
            $response['SortOrder'] = $sortOrder;
            $response['GetURL'] = $getUrl;
            $response['CurrencyID'] = $currencyId;
            $response['PageNumber'] = $pageNumber;
            $response['Count'] = $noOfEntries;
            $response['RelationID'] = $relationId;
            $response['SearchDetails'] = $searchParams;
            $response['PageLimit'] = $pagingModel->getPageLimit();
            $response['PageStartRange'] = $pagingModel->getRecordStartRange();
            $response['PageEndRange'] = $pagingModel->getRecordEndRange();
            $response['PreviousPageExist'] = $pagingModel->isPrevPageExists();
            $response['NextPageExist'] = $pagingModel->isNextPageExists();

            $LISTVIEW_HEADERS = $this->listViewHeaders;
            $headers = array();
            foreach ($LISTVIEW_HEADERS as $LISTVIEW_HEADER) {
                $LISTVIEW_HEADERNAME = $LISTVIEW_HEADER->get('name');
                $headers[] = array(
                    'name' => $LISTVIEW_HEADERNAME,
                    'column' => $LISTVIEW_HEADER->get('column'),
                    'uitype' => $LISTVIEW_HEADER->get('uitype'),
                    'datatype' => $LISTVIEW_HEADER->getFieldDataType(),
                );
            }
            $response['Headers'] = $headers;
        }
        $LISTVIEW_ENTRIES = $this->listViewEntries;
        $wsmodule = ParsVT_WebService_Model::getEntityModuleWSId($moduleName) . 'x';
        $entries = array();
        foreach ($LISTVIEW_ENTRIES as $LISTVIEW_ENTRY) {
            $raw = $LISTVIEW_ENTRY->getRawData();
            foreach ($raw as $key => $value) {
                if (is_numeric($key)) unset($raw[$key]);
            }
            $id = $LISTVIEW_ENTRY->getId();
            $entry = array(
                'id' => $id,
                'wsid' => $wsmodule . $id,
                'name' => $LISTVIEW_ENTRY->getName(),
                //'data' => $LISTVIEW_ENTRY->get('body'),
                //'taxurl' => $LISTVIEW_ENTRY->getTaxesURL(),
            );
            foreach ($raw as $key => $value) {
                $entry[$key] = $value;
            }
            $entries[] = $entry;
        }
        $response['Records'] = $entries;
        if (!$product) {
            $response['Taxes'] = array();
            $response['Fields'] = $fieldsInfo;


            if (PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false)) {
                if (!$this->listViewCount) {
                    $this->listViewCount = $listViewModel->getListViewCount();
                }
                $totalCount = $this->listViewCount;
                $pageLimit = $pagingModel->getPageLimit();
                $pageCount = ceil((int)$totalCount / (int)$pageLimit);

                if ($pageCount == 0) {
                    $pageCount = 1;
                }
                $response['PageCount'] = $pageCount;
                $response['TotalCount'] = $totalCount;
            }

            $response['requestParams'] = $requestParams;
        }
        return $response;
    }


    public function getTaxes($idList = array(), $currencyId = false)
    {
        $decimalPlace = getCurrencyDecimalPlaces();
        $currencies = Inventory_Module_Model::getAllCurrencies();
        $conversionRate = $conversionRateForPurchaseCost = 1;
        $namesList = $purchaseCostsList = $taxesList = $listPricesList = $listPriceValuesList = array();
        $descriptionsList = $quantitiesList = $imageSourcesList = $productIdsList = $baseCurrencyIdsList = array();

        foreach ($idList as $id) {
            $recordModel = Vtiger_Record_Model::getInstanceById($id);
            $taxes = $recordModel->getTaxes();
            foreach ($taxes as $key => $taxInfo) {
                foreach ($taxInfo as $key2 => $value2) {
                    if (is_numeric($key2)) unset($taxInfo[$key2]);
                }
                //$taxInfo['compoundOn'] = Zend_Json::decode(html_entity_decode($taxInfo['compoundOn']));
                unset($taxInfo['compoundon']);
                $taxInfo['regionsList'] = Zend_Json::decode(decode_html($taxInfo['regionsList']));
                $taxes[$key] = $taxInfo;
            }

            $taxesList[$id] = $taxes;
            $namesList[$id] = decode_html($recordModel->getName());
            $quantitiesList[$id] = $recordModel->get('qtyinstock');
            $descriptionsList[$id] = decode_html($recordModel->get('description'));
            $listPriceValuesList[$id] = $recordModel->getListPriceValues($recordModel->getId());

            $priceDetails = $recordModel->getPriceDetails();
            foreach ($priceDetails as $currencyDetails) {
                if ($currencyId == $currencyDetails['curid']) {
                    $conversionRate = $currencyDetails['conversionrate'];
                }
            }
            $listPricesList[$id] = (float)$recordModel->get('unit_price') * (float)$conversionRate;

            foreach ($currencies as $currencyInfo) {
                if ($currencyId == $currencyInfo['curid']) {
                    $conversionRateForPurchaseCost = $currencyInfo['conversionrate'];
                    break;
                }
            }
            $purchaseCostsList[$id] = round((float)$recordModel->get('purchase_cost') * (float)$conversionRateForPurchaseCost, $decimalPlace);
            $baseCurrencyIdsList[$id] = getProductBaseCurrency($id, $recordModel->getModuleName());

            if ($recordModel->getModuleName() == 'Products') {
                $productIdsList[] = $id;
            }
        }

        if ($productIdsList) {
            $imageDetailsList = Products_Record_Model::getProductsImageDetails($productIdsList);
            foreach ($imageDetailsList as $productId => $imageDetails) {
                $imageSourcesList[$productId] = $imageDetails[0]['path'] . '_' . $imageDetails[0]['orgname'];
            }
        }
        $info = array();
        foreach ($idList as $id) {
            $resultData = array(
                'id' => $id,
                'name' => $namesList[$id],
                'taxes' => $taxesList[$id],
                'listprice' => $listPricesList[$id],
                'listpricevalues' => $listPriceValuesList[$id],
                'purchaseCost' => $purchaseCostsList[$id],
                'description' => $descriptionsList[$id],
                'baseCurrencyId' => $baseCurrencyIdsList[$id],
                'quantityInStock' => $quantitiesList[$id],
                'imageSource' => $imageSourcesList[$id]
            );

            $info[] = array($id => $resultData);
        }
        return $info;
    }

    public function getPricebook($params) {
        global $adb;
        $request2 = new Vtiger_Request($params, $params);
        $MobileApp_Popup = new MobileApp_Popup;
        $Records = $MobileApp_Popup->initializePriceBookListViewContents($request2, true)['Records'];
        $query = "SELECT * FROM vtiger_pricebookproductrel WHERE pricebookid = ? AND productid = ? AND usedcurrency = ?";
        foreach ($Records as &$record) {
            $result = $adb->pquery($query, array($record['id'], $record['src_record'], $record['currency_id']));
            if($adb->num_rows($result) > 0) {
                $listprice = $adb->query_result($result, 0, 'listprice');
                $record['unit_price'] = $listprice;
            }
        }
        return $Records;
    }


}